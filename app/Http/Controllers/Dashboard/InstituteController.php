<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Institute;
use App\Repository\Interfaces\IInstituteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InstituteController extends Controller
{
    /**
     * @var IInstituteRepository
     */
    private $instituteRepository;

    /**
     * @var string
     */
    private $className = 'Institute';

    public function __construct(IInstituteRepository $instituteRepository)
    {
        $this->middleware('auth')->except('show', 'index');
        $this->instituteRepository = $instituteRepository;
    }

    public function index()
    {
        $institutes = $this->instituteRepository->allByUser(Auth::id());
        return view('dashboard.institutes.index', compact('institutes'));
    }

    public function create()
    {
        return view('dashboard.institutes.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'description' => 'nullable',
            'country' => 'required',
        ]);

        $entry_data = $request->only(['name', 'description', 'country']);
        $entry_data['user_id'] = Auth::id();
        $entry_data['admin_id'] = Auth::id();

        $institute = $this->instituteRepository->create($entry_data);

        return redirect()->back()->with('message', __('dashboard-success.save', ['entity' => $this->className]));
    }

    public function show(Institute $institute)
    {
        return view('dashboard.institutes.show', compact('institute'));
    }

    public function edit(Institute $institute)
    {
        return view('dashboard.institutes.edit', compact('institute'));
    }

    public function update(Request $request, Institute $institute)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'description' => 'nullable',
            'address' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'country' => 'nullable',
        ]);

       $this->instituteRepository->update($institute->getKey(), $request->only([
            'name', 'description', 'address', 'city', 'state', 'country', 'admin_id'
        ]));

        return redirect()->back()->with('message', __('dashboard-success.update', ['entity' => $this->className]));
    }

    public function destroy(Institute $institute)
    {
        $this->instituteRepository->delete($institute->getKey());
        return redirect()->back()->with('message', __('dashboard-success.delete', ['entity' => $this->className]));
    }
}
