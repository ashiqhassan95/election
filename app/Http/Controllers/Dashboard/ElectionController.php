<?php

namespace App\Http\Controllers\Dashboard;

use App\Helper\SessionHelper;
use App\Helper\StoreHelper;
use App\Models\Election;
use App\Repository\Interfaces\IElectionRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class ElectionController extends Controller
{
    /**
     * @var IElectionRepository
     */
    private $electionRepository;

    /**
     * @var string
     */
    private $className = 'Election';

    public function __construct(IElectionRepository $electionRepository)
    {
        $this->middleware('auth')->except('show', 'index');
        $this->electionRepository = $electionRepository;
    }

    public function index()
    {
        $elections = $this->electionRepository->allByInstitute(SessionHelper::getInstitute());
        return view('dashboard.elections.index', compact('elections'));
    }

    public function create()
    {
        $users = User::all();
        return view('dashboard.elections.create', compact('users'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:200',
            'poll_start_at' => 'required',
            'poll_end_at' => 'required',
            'type' => 'required|in:0,1'
        ]);

        $entry_data = $request->only(['title', 'poll_start_at', 'poll_end_at', 'type']);
        $entry_data = StoreHelper::AssignUserAndInstitute($entry_data);
        $entry_data['status'] = '0';
        $this->electionRepository->create($entry_data);

        return redirect()->back()->with('message', __('dashboard-success.save', ['entity' => $this->className]));
    }

    public function show(Election $election)
    {
        return view('dashboard.elections.show', compact('election'));
    }

    public function edit(Election $election)
    {
        return view('dashboard.elections.edit', compact('election'));
    }

    public function update(Request $request, Election $election)
    {
        $this->validate($request, [
            'title' => 'required|max:200',
            'poll_start_at' => 'required',
            'poll_end_at' => 'required',
            'type' => 'required|in:0,1'
        ]);

        $this->electionRepository->update($election->getKey(), $request->only([
            'title', 'poll_start_at', 'poll_end_at', 'type'
        ]));

        return redirect()->back()->with('message', __('dashboard-success.update', ['entity' => $this->className]));
    }

    public function destroy(Election $election)
    {
        $this->electionRepository->delete($election->getKey());
        return redirect()->back()->with('message', __('dashboard-success.delete', ['entity' => $this->className]));
    }

    public function launch(Election $election)
    {
        if(is_null($election->slug))
            return view('dashboard.elections.launch', compact('election'));
        else
            return view('dashboard.elections.launched', compact('election'));
    }

    public function launchElection(Request $request)
    {
        $election = $this->electionRepository->find($request->get('election_id'));
        if(Is_null($election->slug)){
            $slug =  Str::random(10);

            while(Election::query()->where('slug', $slug)->exists()) {
                $slug =  Str::uuid();
                $slug = $slug->toString();
            }

            $this->electionRepository->update($election->getKey(), [
                'slug'=> $slug,
                'status' => '1'
            ]);

            $election = $this->electionRepository->find($election->getKey());
        }
        return view('dashboard.elections.launched', compact('election'));
    }

}
