<?php

namespace App\Http\Controllers\Dashboard;

use App\Helper\SessionHelper;
use App\Helper\StoreHelper;
use App\Repository\Interfaces\IUserRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    /**
     * @var IUserRepository
     */
    private $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->middleware('auth')->except('show', 'index');
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->allByInstitute(SessionHelper::getInstitute());
        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:200'
        ]);

        $entry_data = $request->only(['name']);
        $entry_data = StoreHelper::AssignUserAndInstitute($entry_data);

        $user = $this->userRepository->create($entry_data);
        return redirect()->route('dashboard.users.index');
    }

    public function show(User $user)
    {
        return view('dashboard.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'role' => 'required|in:0,1,2',
            'is_active' => 'nullable'
        ]);

        $this->userRepository->update($user->getKey(),[
            'role' => $request->get('role'),
            'is_active' => $request->get('is_active') == 'on' ? true : false,
        ]);

        return redirect()->route('dashboard.users.index');
    }

    public function destroy(User $user)
    {
        $this->userRepository->delete($user->getKey());
        return redirect()->back();
    }
}
