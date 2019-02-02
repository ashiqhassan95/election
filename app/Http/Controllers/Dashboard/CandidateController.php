<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\CandidatesExport;
use App\Helper\SessionHelper;
use App\Helper\StoreHelper;
use App\Models\Candidate;
use App\Repository\Interfaces\ICandidateRepository;
use App\Repository\Interfaces\IElectionRepository;
use App\Repository\Interfaces\IPositionRepository;
use App\Repository\Interfaces\IStandardRepository;
use App\Repository\Interfaces\IVoterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class CandidateController extends Controller
{
    /**
     * @var ICandidateRepository
     */
    private $candidateRepository;
    /**
     * @var IPositionRepository
     */
    private $positionRepository;
    /**
     * @var IStandardRepository
     */
    private $standardRepository;
    /**
     * @var IElectionRepository
     */
    private $electionRepository;

    /**
     * @var string
     */
    private $className = 'Candidate';

    /**
     * @var string
     */
    private $canidateImageDirectory = '/storage/images/candidates/';
    /**
     * @var IVoterRepository
     */
    private $voterRepository;

    public function __construct(ICandidateRepository $candidateRepository, IPositionRepository $positionRepository,
                                IStandardRepository $standardRepository, IElectionRepository $electionRepository,
                                IVoterRepository $voterRepository)
    {
        $this->middleware('auth')->except('show', 'index');
        $this->candidateRepository = $candidateRepository;
        $this->positionRepository = $positionRepository;
        $this->standardRepository = $standardRepository;
        $this->electionRepository = $electionRepository;
        $this->voterRepository = $voterRepository;
    }

    public function index()
    {
        $candidates = $this->candidateRepository->allByInstitute(SessionHelper::getInstitute(), ['voter', 'standard', 'position']);
        return view('dashboard.candidates.index', compact('candidates'));
    }

    public function create(Request $request)
    {
        $voter = $this->voterRepository->find($request->get('voter_id'));
        $data = [
            'voter' => $voter,
            'positions' => $this->positionRepository->allByInstitute(SessionHelper::getInstitute()),
            'elections' => $this->electionRepository->allByInstitute(SessionHelper::getInstitute()),
        ];
        return view('dashboard.candidates.create', $data);
    }

    public function store(Request $request)
    {
        if (!$request->has('voter_id'))
            return abort(404);

        $voter = $this->voterRepository->find($request->get('voter_id'));
        if (!$voter['institute_id'] == SessionHelper::getInstitute())
            return abort(405);

        $this->validate($request, [
            'voter_id' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'position_id' => 'required|exists:positions,id',
            'election_id' => 'required|exists:elections,id'
        ]);

        $entry_data = $request->only(['voter_id', 'position_id', 'election_id']);
        $entry_data['standard_id'] = $voter['standard_id'];

        if ($request->hasFile('image')) {
            $image_file = $request->file('image');
            $image_name = sprintf('%s.%s', time(), $image_file->getClientOriginalExtension());
            $image_file->move(public_path($this->canidateImageDirectory), $image_name);
            $entry_data['image'] = $this->canidateImageDirectory . $image_name;
        }

        $entry_data = StoreHelper::AssignUserAndInstitute($entry_data);

        $this->candidateRepository->create($entry_data);

        return redirect()->route('dashboard.candidates.index');
    }

    public function show(Candidate $candidate)
    {
        return view('dashboard.candidates.show', compact('candidate'));
    }

    public function edit(Candidate $candidate)
    {
        $candidate = $this->candidateRepository->find($candidate->getKey(), ['voter', 'standard']);
        $data = [
            'candidate' => $candidate,
            'positions' => $this->positionRepository->allByInstitute(SessionHelper::getInstitute()),
            'elections' => $this->electionRepository->allByInstitute(SessionHelper::getInstitute()),
        ];
        return view('dashboard.candidates.edit', $data);
    }

    public function update(Request $request, Candidate $candidate)
    {
        $this->validate($request, [
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'position_id' => 'required|exists:positions,id',
            'election_id' => 'required|exists:elections,id'
        ]);

        $entry_data = $request->only(['position_id', 'election_id']);

        if ($request->hasFile('image')) {
            $image_file = $request->file('image');
            $image_name = sprintf('%s.%s', time(), $image_file->getClientOriginalExtension());
            $image_file->move(public_path($this->canidateImageDirectory), $image_name);
            $entry_data['image'] = $this->canidateImageDirectory . $image_name;
            if(File::exists(public_path($candidate['image']))) {
                File::delete(public_path($candidate['image']));
            }
        }
        $this->candidateRepository->update($candidate->getKey(), $entry_data);
        return redirect()->back()->with('message', __('dashboard-success.update', ['entity' => $this->className]));
    }

    public function destroy(Candidate $candidate)
    {
        $this->candidateRepository->delete($candidate->getKey());
        return redirect()->back()->with('message', __('dashboard-success.delete', ['entity' => $this->className]));
    }

    public function export($format)
    {
        $extension = 'csv';
        if ($format == 'excel') $extension = 'xlsx';
        else if ($format == 'csv') $extension = 'csv';

        return Excel::download(new CandidatesExport(), 'candidates.' . $extension);
    }
}
