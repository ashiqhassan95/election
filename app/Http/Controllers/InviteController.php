<?php

namespace App\Http\Controllers;

use App\Mail\InviteCreated;
use App\Models\Invite;
use App\Repository\Interfaces\IUserRepository;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class InviteController extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard/elections';

    /**
     * @var IUserRepository
     */
    private $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->middleware('guest')->only('accept');
        $this->middleware('auth')->only('invite', 'process');
        $this->userRepository = $userRepository;
    }

    public function invite()
    {
        // show the user a form with an email field to invite a new user
        return view('dashboard.users.invite');
    }

    public function process(Request $request)
    {
        // process the form submission and send the invite by email
        // validate the incoming request data

        $this->validate($request, [
            'email' => 'required|max:255',
            'role' => 'required|in:0,1,2'
        ]);

        do {
            //generate a random string using Laravel's str_random helper
            $token = str_random();
        } //check if the token already exists and if it does, try again
        while (Invite::query()->where('token', $token)->first());

        //create a new invite record
        $invite = Invite::query()->create([
            'email' => $request->get('email'),
            'token' => $token,
            'user_id' => Auth::id(),
            'role' => $request->get('role'),
            'created_at' => now()
        ]);

        // send the email
        Mail::to($request->get('email'))->send(new InviteCreated($invite));

        // redirect back where we came from
        return redirect()->back()->with('message', 'Invitation link has been send successfully');
    }

    public function accept($token)
    {
        // Look up the invite
        if (!$invite = Invite::query()->where('token', $token)->first()) {
            //if the invite doesn't exist do something more graceful than this
            abort(404);
        }

        return view('auth.invite-accept', compact('invite'));
    }

    public function register(Request $request)
    {
        $invite = Invite::query()->where('token', $request->get('token'))->first();
        if ($invite == null) {
            // if the invite doesn't exist do something more graceful than this
            return 'You are not authorized to join as your token either deleted or not found';
        }

        $this->validate($request, [
            'token' => 'required',
            'name' => 'required|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $invited_by_user = $this->userRepository->find($invite->user_id);

        $user = $this->userRepository->create([
            'name' => $request->get('name'),
            'email' => $invite->email,
            'password' => Hash::make($request->get('password')),
            'is_active' => true,
            'role' => $invite->role,
            'institute_id' => $invited_by_user->institute_id
        ]);

        // delete the invite so it can't be used again
        $invite->delete();

        Auth::guard()->login($user);
        $request->session()->put('institute', $user->institute_id);
        return redirect($this->redirectTo);
    }
}
