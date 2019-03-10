<?php

namespace App\Http\Controllers\FrontEnd;

use App\Helper\SessionHelper;
use App\Http\Middleware\CheckForVoterLogin;
use App\Models\Candidate;
use App\Models\Election;
use App\Models\Institute;
use App\Models\Position;
use App\Models\Voter;
use App\Repository\Interfaces\IElectionRepository;
use App\Repository\Interfaces\IInstituteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ElectionController extends Controller
{
    /**
     * @var IElectionRepository
     */
    private $electionRepository;
    /**
     * @var IInstituteRepository
     */
    private $instituteRepository;

    public function __construct(IElectionRepository $electionRepository, IInstituteRepository $instituteRepository)
    {
        $this->middleware('voter.auth')->except('thanks');
        $this->electionRepository = $electionRepository;
        $this->instituteRepository = $instituteRepository;
    }

    public function vote($slug)
    {
        if (session()->has('vote_cast')) {
            $election = $this->electionRepository->findBy('slug', $slug);
            return 'authenticated';
        } else {
            $data = [
                'election' => $this->electionRepository->findBy('slug', $slug),
                'institute' => $this->instituteRepository->find(SessionHelper::getInstitute())
            ];
            return view('auth.voter-login', $data);
        }
    }

    public function showCandidates(Request $request, $electionSlug)
    {
        $voter = Voter::query()->where('uid', session()->get('voter_uid'))->first();
        $election = Election::query()->where('slug', $electionSlug)->first();
        $institute = Institute::query()->find($election['institute_id']);

        if (is_null($election)) {
            return 'Sorry no election';
        }

        $data = '';

        if ($election['type'] == 0) {
            $data = $this->getCandidatesForPresidential($election->getKey());
        } else if ($election['type'] == 1) {
            $data = $this->getCandidatesForParliamentary($election->getKey(), $voter['standard_id']);
        }

        if ($request->has('raw')) {
            return $data;
        }
        return view('frontend.vote-candidates', compact('data', 'election', 'voter', 'institute'));
    }

    public function casteVote(Request $request, $slug)
    {
        $election = Election::query()->where('slug', $slug)->first();
        $voter = Voter::query()->where('uid', session()->get('voter_uid'))->first();
        $vote_exist = DB::table('vote_cast')
            ->where('voter_id', $voter->getKey())
            ->where('election_id', $election->getKey())
            ->exists();
        if($vote_exist) {
            return 'You have already voted.';
        }

        $positionKeys = array_keys($request->except('_token'));
        foreach ($positionKeys as $positionKey) {
            $positionId = str_replace('position-', '', $positionKey);
            $candidateId = $request->get($positionKey);
            DB::table('vote_cast')->insert([
                'voter_id' => $voter->getKey(),
                'standard_id' => $voter['standard_id'],
                'candidate_id' => $candidateId,
                'position_id' => $positionId,
                'election_id' => $election->getKey(),
                'institute_id' => $election['institute_id'],
                'voted_at' => now()
            ]);
            if ($candidateId != 0) {
                Candidate::query()->find($candidateId)->increment('vote_count', 1);
            }
        }
        session()->forget('voter_uid');
        return redirect()->route('frontend.elections.vote.thanks', $slug);
    }

    public function casteVoteAsDefaultNOTA(Request $request, $slug)
    {
        if (!session()->has('voter_uid')) {
            return "Not authorized";
        }

        $election = Election::query()->where('slug', $slug)->first();
        $voter = Voter::query()->where('uid', session()->get('voter_uid'))->first();

        $positions = '';

        if ($election->type == 0) {
            $positions = Candidate::query()
                ->distinct()
                ->where('election_id', $election->getKey())
                ->where('standard_id', $voter->standard_id)
                ->pluck('position_id');
        } else if ($election->type == 1) {
            $positions = Candidate::query()
                ->distinct()
                ->where('election_id', $election->getKey())
                ->pluck('position_id');
        }

        $positionKeys = array_keys($request->except('_token'));
        foreach ($positionKeys as $positionKey) {
            $positionId = str_replace('position-', '', $positionKey);
            $candidateId = $request->get($positionKey);
            DB::table('vote_cast')->insert([
                'voter_id' => $voter->getKey(),
                'candidate_id' => $candidateId,
                'position_id' => $positionId,
                'election_id' => $election->getKey(),
                'institute_id' => $election['institute_id'],
                'voted_at' => now()
            ]);
            if ($candidateId != 0) {
                Candidate::query()->find($candidateId)->increment('vote_count', 1);
            }
        }
        session()->forget('voter_uid');
        return redirect()->route('frontend.elections.vote.thanks', $slug);
    }

    public function thanks($slug)
    {
        $election = Election::query()->where('slug', $slug)->first();
        return view('frontend.vote-cast-greeting', compact('election'));
    }

    public function getCandidatesForPresidential($electionId)
    {
        $candidatesCollection = new Collection();
        $positionIds = Candidate::query()
            ->distinct()
            ->where('election_id', $electionId)
            ->pluck('position_id');

        foreach ($positionIds as $positionId) {
            $position = Position::query()->find($positionId);
            $candidates = Candidate::query()
                ->with(['voter', 'standard'])
                ->where('election_id', $electionId)
                ->where('position_id', $positionId)
                ->get();
            $position['candidates'] = $candidates;
            $candidatesCollection->push($position);
        }
        return $candidatesCollection;
    }

    public function getCandidatesForParliamentary($electionId, $standardId)
    {
        $candidatesCollection = new Collection();
        $positionIds = Candidate::query()
            ->distinct()
            ->where('election_id', $electionId)
            ->where('standard_id', $standardId)
            ->pluck('position_id');

        foreach ($positionIds as $positionId) {
            $position = Position::query()->find($positionId);
            $candidates = Candidate::query()
                ->with(['voter', 'standard'])
                ->where('election_id', $electionId)
                ->where('standard_id', $standardId)
                ->where('position_id', $positionId)
                ->get();
            $position['candidates'] = $candidates;
            $candidatesCollection->push($position);
        }
        return $candidatesCollection;
    }
}
