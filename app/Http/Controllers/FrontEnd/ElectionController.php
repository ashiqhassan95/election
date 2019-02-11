<?php

namespace App\Http\Controllers\FrontEnd;

use App\Helper\SessionHelper;
use App\Http\Middleware\CheckForVoterLogin;
use App\Models\Candidate;
use App\Models\Election;
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
        $this->middleware('voter.auth');
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

        if (is_null($election)) {
            return 'Sorry no election';
        }

        $data = '';

        if ($election['type'] == 0) {
            $data = $this->getCandidatesForPresidential($election->getKey());
//            $data = $this->getCandidatesForPresidential($election->getKey())->groupBy('position.title');
        } else if ($election['type'] == 1) {
            $data = $this->getCandidatesForParliamentary($election->getKey(), $voter['standard_id'])->groupBy('position_id');
//            $data = $this->getCandidatesForParliamentary($election->getKey(), $voter['standard_id'])->groupBy('position.name');
        }

        if($request->has('raw')) {
            return $data;
        }
        return view('frontend.vote-candidates', compact('data'));
    }

    public function getCandidatesForPresidential($electionId)
    {
        $candidatesCollection = new Collection();
        $positionIds = Candidate::query()
            ->select('position_id')
            ->where('election_id', $electionId)
            ->distinct()
            ->pluck('position_id');

        foreach ($positionIds as $positionId)
        {
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

    public function bakgetCandidatesForPresidential($electionId)
    {
        $candidatesCollection = Candidate::query()
            ->where('election_id', $electionId)
            ->with(['voter', 'standard', 'position'])
            ->get();

        $positionIds = $candidatesCollection->unique('position_id')->pluck('position_id');

        $positions = new Collection();
        foreach ($positionIds as $positionId) {
            $pos = $positions->put('position', $candidatesCollection->where('position_id', $positionId)->pluck('position')->first());
            $candidatesOfPosition = $candidatesCollection->where('position_id', $positionId);
            foreach ($candidatesOfPosition as $candidate) {
                $pos->put('candidates', $candidate);
            }
            //$candidates = Candidate::query()->where('position_id');
        }
        return $positions;

        $candidates = Candidate::query()
            ->with(['position', 'voter', 'standard'])
            ->where('election_id', $electionId)
            ->get();

        $groupedCandidates = $candidates->groupBy('position_id');
        $candidatePosition = [];
        foreach ($groupedCandidates as $key => $candidates)
        {
            $candidatePosition['position'] = Position::query()->find($key);
            $candidateList['position'][] = [];
            foreach ($candidates as $candidate)
            {
                $candidateList['position'][] = $candidate;
            }
        }
        return $candidatePosition;
    }

    public function getCandidatesForParliamentary($electionId, $standardId)
    {
        return Candidate::query()
            ->with(['position', 'voter', 'standard'])
            ->where('election_id', $electionId)
            ->where('standard_id', $standardId)
            ->get();
    }

    public function voterLogin(Request $request, $slug)
    {
        $this->validate($request, [
            'uid' => 'required',
            'birth_date' => 'required'
        ]);

        $voter = Voter::query()
            ->where('uid', $request->get('uid'))
            ->where('birth_date', $request->get('birth_date'))
            ->first();
        if (!$voter) {
            return 'Not Great';
        } else {
            $election = Election::query()->where('slug', $slug)->first();
            session()->put('voter', $voter->getKey());
            $standard = $voter['standard_id'];
            return Candidate::query()
                ->with(['position'])
                ->where('standard_id', $voter['standard_id'])
                ->where('election_id', $election->getKey())
                ->orderBy('position_id')
                ->get();
        }
    }
}
