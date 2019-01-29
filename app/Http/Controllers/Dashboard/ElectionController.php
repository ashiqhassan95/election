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
        return view('dashboard.elections.launch', compact('election'));
    }

}
