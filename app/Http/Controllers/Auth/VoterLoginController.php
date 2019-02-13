<?php

namespace App\Http\Controllers\Auth;

use App\Models\Election;
use App\Models\Institute;
use App\Models\Voter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VoterLoginController extends Controller
{

    public function showLoginForm($electionSlug)
    {
        $election = Election::query()->where('slug', $electionSlug)->first();
        if($election->status == 2) {
            return abort(404, 'This election is no more.');
        }
        $institute = Institute::query()->find($election['institute_id']);
        return view('auth.voter-login', compact('election', 'institute'));
    }

    public function login(Request $request, $electionSlug)
    {
        session()->forget('voter_uid');
        $this->validateLogin($request);

        $voter = Voter::query()->where([
            'uid' => $request->get('uid'),
            'birth_date' => $request->get('birth_date')
        ])->first();
        $election = Election::query()
            ->where('slug', $electionSlug)
            ->first();

        $redirectPath = '/election/' . $electionSlug;

        if ($voter) {
            $vote_exist = DB::table('vote_cast')
                ->where('voter_id', $voter->getKey())
                ->where('election_id', $election->getKey())
                ->exists();
            if ($vote_exist) {
                return redirect()->back()->withErrors(['You have already voted.']);
            } else {
                return $this->authenticated($request, $voter, $redirectPath);
            }
        } else {
            return redirect()->back()->withErrors(['Invalid UID and Birth date. Please try again with correct one']);
        }

    }

    public function validateLogin(Request $request)
    {
        $this->validate($request, [
            'uid' => 'required|string',
            'birth_date' => 'required'
        ]);
    }

    public function authenticated(Request $request, Voter $voter, $redirectPath)
    {
        session()->put('voter_uid', $voter['uid']);
        return redirect($redirectPath);
    }
}
