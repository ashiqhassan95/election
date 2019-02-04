<?php

namespace App\Http\Controllers\FrontEnd;

use App\Helper\SessionHelper;
use App\Models\Candidate;
use App\Models\Election;
use App\Models\Voter;
use App\Repository\Interfaces\IElectionRepository;
use App\Repository\Interfaces\IInstituteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        if(!$voter) {
            return 'Not Great';
        }
        else {
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
