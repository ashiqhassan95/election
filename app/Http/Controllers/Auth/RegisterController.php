<?php

namespace App\Http\Controllers\Auth;

use App\Repository\Interfaces\IInstituteRepository;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard/elections';

    /**
     * @var IInstituteRepository
     */
    private $instituteRepository;

    /**
     * Create a new controller instance.
     *
     * @param IInstituteRepository $instituteRepository
     */
    public function __construct(IInstituteRepository $instituteRepository)
    {
        $this->middleware('guest');
        $this->instituteRepository = $instituteRepository;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $countries = DB::table('countries')->orderBy('name')->get();
        return view('auth.register', compact('countries'));
    }

    /**
     * @param Request $request
     * @param mixed $user
     * @return mixed
     */
    protected function registered(Request $request, User $user)
    {
        $institute = $this->instituteRepository->create([
            'name' => $request->get('institute'),
            'country' => $request->get('country'),
            'user_id' => $user->getKey(),
            'admin_id' => $user->getKey(),
        ]);

        $user->institute_id = $institute->getKey();
        $user->is_active = true;
        $user->role = 0;
        $user->save();

        $request->session()->put('institute', $institute->getKey());

        return redirect($this->redirectPath());
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'institute' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'exists:countries,code']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
