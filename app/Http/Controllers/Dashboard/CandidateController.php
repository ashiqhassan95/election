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
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

    public function __construct(ICandidateRepository $candidateRepository, IPositionRepository $positionRepository,
                                IStandardRepository $standardRepository, IElectionRepository $electionRepository)
    {
        $this->middleware('auth')->except('show', 'index');
        $this->candidateRepository = $candidateRepository;
        $this->positionRepository = $positionRepository;
        $this->standardRepository = $standardRepository;
        $this->electionRepository = $electionRepository;
    }

    public function index()
    {
        $candidates = $this->candidateRepository->allByInstitute(SessionHelper::getInstitute());
        return view('dashboard.candidates.index', compact('candidates'));
    }

    public function create()
    {
        $data = [
            'positions' => $this->positionRepository->all(),
            'standards' => $this->standardRepository->all(),
            'elections' => $this->electionRepository->all(),
        ];
        return view('dashboard.candidates.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'admission_number' => 'required',
            'roll_number' => 'required',
            'birth_date' => 'required',
            'gender' => 'required|in:0,1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'standard_id' => 'required|exists:standards,id',
            'position_id' => 'required|exists:positions,id',
            'election_id' => 'required|exists:elections,id'
        ]);

        $entry_data = $request->only([
            'name', 'admission_number', 'roll_number', 'birth_date', 'gender',
            'standard_id', 'position_id', 'election_id'
        ]);

        if ($request->hasFile('image')) {
            $image_file = $request->file('image');
            $image_name = sprintf('%s.%s', time(), $image_file->getClientOriginalExtension());
            $image_file->move(public_path($this->canidateImageDirectory), $image_name);
            $entry_data['image'] = $this->canidateImageDirectory . $image_name;
        }

        $entry_data = StoreHelper::AssignUserAndInstitute($entry_data);

        $candidate = $this->candidateRepository->create($entry_data);

        return redirect()->back()->with('message', __('dashboard-success.save', ['entity' => $this->className]));
    }

    public function show(Candidate $candidate)
    {
        return view('dashboard.candidates.show', compact('candidate'));
    }

    public function edit(Candidate $candidate)
    {
        $data = [
            'candidate' => $candidate,
            'positions' => $this->positionRepository->all(),
            'standards' => $this->standardRepository->all(),
            'elections' => $this->electionRepository->all(),
        ];
        return view('dashboard.candidates.edit', $data);
    }

    public function update(Request $request, Candidate $candidate)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'admission_number' => 'required',
            'roll_number' => 'required',
            'birth_date' => 'required',
            'gender' => 'required',
            'standard_id' => 'required|exists:standards,id',
            'position_id' => 'required|exists:positions,id',
            'election_id' => 'required|exists:elections,id'
        ]);

        $this->candidateRepository->update($candidate->getKey(), $request->only([
            'name', 'admission_number', 'roll_number', 'birth_date', 'gender',
            'standard_id', 'position_id', 'election_id'
        ]));

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
