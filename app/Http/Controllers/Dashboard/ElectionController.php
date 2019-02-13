<?php

namespace App\Http\Controllers\Dashboard;

use App\Helper\SessionHelper;
use App\Helper\StoreHelper;
use App\Models\Candidate;
use App\Models\Election;
use App\Models\Position;
use App\Repository\Interfaces\IElectionRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Array_;

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
            'type' => 'required|in:0,1'
        ]);

        $entry_data = $request->only(['title', 'type']);
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
            'type' => 'required|in:0,1'
        ]);

        $this->electionRepository->update($election->getKey(), $request->only([
            'title', 'type'
        ]));

        return redirect()->back()->with('message', __('dashboard-success.update', ['entity' => $this->className]));
    }

    public function destroy(Election $election)
    {
        $this->electionRepository->delete($election->getKey());
        return redirect()->route('dashboard.elections.index');
    }

    public function launch(Election $election)
    {
        if (is_null($election->slug))
            return view('dashboard.elections.launch', compact('election'));
        else
            return view('dashboard.elections.launched', compact('election'));
    }

    public function launchElection(Request $request, Election $election)
    {
        if ($election['status'] == 0) {
            $slug = Str::random(10);

            while (Election::query()->where('slug', $slug)->exists()) {
                $slug = Str::uuid();
                $slug = $slug->toString();
            }

            $this->electionRepository->update($election->getKey(), [
                'slug' => $slug,
                'poll_start_at' => now(),
                'status' => '1'
            ]);
        }
        return redirect()->back();//->with('election', $election);
    }

    public function completeElection(Request $request, Election $election)
    {
        $this->electionRepository->update($election->getKey(), [
            'poll_end_at' => now(),
            'status' => 2
        ]);
        return redirect()->back();
    }

    public function processResult(Request $request, Election $election)
    {

    }

    public function showResult(Election $election)
    {
        if ($election['type'] == 0) {
            return $this->showPresidentialResult($election);
        } else if ($election['type'] == 1) {
            return $this->showParliamentaryResult($election);
        }
    }

    public function showPresidentialResult(Election $election)
    {
        $data = new Collection();
        $candidates = Candidate::query()
            ->with(['voter', 'standard', 'position'])
            ->where('election_id', $election->getKey())
            ->get();
        $positionIds = $candidates->pluck('position_id')->unique()->values();

        foreach ($positionIds as $positionId) {
            $staticPosition = $candidates->where('position_id', $positionId)->pluck('position')->first();
            $totalVotes = DB::table('vote_cast')
                ->where('election_id', $election->getKey())
                ->where('position_id', $positionId)
                ->count('candidate_id');
            $position = new Position();
            $position->id = $staticPosition['id'];
            $position->title = $staticPosition['title'];
            $position->total_votes = $totalVotes;
            $candidatesOfThisPosition = $candidates->where('position_id', $position->id)->values();
            $candidatesCollection = new Collection();
            foreach ($candidatesOfThisPosition as $candidate) {
                $candidatesCollection->push([
                    'id' => $candidate->id,
                    'name' => $candidate->voter->name,
                    'standard' => $candidate->standard->name,
                    'position' => $candidate->position->title,
                    'votes' => $candidate->vote_count,
                    'percentage' => ($candidate->vote_count / $totalVotes) * 100,
                ]);
            }
            $notaVoteCount = DB::table('vote_cast')
                ->where('election_id', $election->getKey())
                ->where('position_id', $position->getKey())
                ->where('candidate_id', 0)
                ->count('candidate_id');
            $candidatesCollection->push([
                'id' => 0,
                'name' => 'NOTA',
                'position' => $position->title,
                'votes' => $notaVoteCount,
                'percentage' => ($notaVoteCount / $totalVotes) * 100,
            ]);
            $position['candidates'] = $candidatesCollection->sortByDesc('votes');
            $data->push($position);

        }
        return view('dashboard.elections.result-presidential', compact('data', 'election'));
    }

    public function showPresidentialResultOriginal(Election $election)
    {
        $data = new Collection();
        $positionIds = Candidate::query()
            ->where('election_id', $election->getKey())
            ->distinct()
            ->pluck('position_id');
        foreach ($positionIds as $positionId) {
            $position = Position::query()->find($positionId);
            $candidates = Candidate::query()
                ->with(['voter', 'standard', 'position'])
                ->where('election_id', $election->getKey())
                ->where('position_id', $positionId)
                ->get();
            $totalVotes = DB::table('vote_cast')
                ->where('election_id', $election->getKey())
                ->where('position_id', $position->getKey())
                ->count('candidate_id');
            $position['total_votes'] = $totalVotes;

            $myCandidates = new Collection();
            foreach ($candidates as $candidate) {
                $myCandidates->push([
                    'id' => $candidate->id,
                    'name' => $candidate->voter->name,
                    'standard' => $candidate->standard->name,
                    'position' => $candidate->position->title,
                    'votes' => $candidate->vote_count,
                    'percentage' => ($candidate->vote_count / $totalVotes) * 100,
                ]);
            }
            $notaVoteCount = DB::table('vote_cast')
                ->where('election_id', $election->getKey())
                ->where('position_id', $position->getKey())
                ->where('candidate_id', 0)
                ->count('candidate_id');
            $myCandidates->push([
                'id' => 0,
                'name' => 'NOTA',
                'position' => $position->title,
                'votes' => $notaVoteCount,
                'percentage' => ($notaVoteCount / $totalVotes) * 100,
            ]);
            $position['candidates'] = $myCandidates->sortByDesc('votes');
            $data->push($position);
        }
        return view('dashboard.elections.result-presidential', compact('data', 'election'));
    }

    public function showParliamentaryResult(Election $election)
    {
        return view('dashboard.elections.result-parliamentary');
    }

}
