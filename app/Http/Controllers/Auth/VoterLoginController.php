<?php

namespace App\Http\Controllers\Auth;

use App\Models\Election;
use App\Models\Institute;
use App\Models\Voter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VoterLoginController extends Controller
{

    public function showLoginForm($electionSlug)
    {
        $election = Election::query()->where('slug', $electionSlug)->first();
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

        $redirectPath = '/election/' . $electionSlug;

        if($voter) {
            return $this->authenticated($request, $voter, $redirectPath);
        }
        else {
            return "incorrect UID abd birth date";
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
