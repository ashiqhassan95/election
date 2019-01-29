<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\StandardsExport;
use App\Helper\SessionHelper;
use App\Helper\StoreHelper;
use App\Models\Standard;
use App\Repository\Interfaces\IStandardRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class StandardController extends Controller
{
    /**
     * @var IStandardRepository
     */
    private $standardRepository;

    /**
     * @var string
     */
    private $className = 'Standard';

    public function __construct(IStandardRepository $standardRepository)
    {
        $this->middleware('auth')->except('show', 'index');
        $this->standardRepository = $standardRepository;
    }

    public function index()
    {
        $standards = $this->standardRepository->allByInstitute(SessionHelper::getInstitute());
        return view('dashboard.standards.index', compact('standards'));
    }

    public function create()
    {
        return view('dashboard.standards.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:200'
        ]);

        $entry_data = $request->only(['name']);
        $entry_data = StoreHelper::AssignUserAndInstitute($entry_data);

        $class = $this->standardRepository->create($entry_data);

        return redirect()->back()->with('message', __('dashboard-success.save', ['entity' => $this->className]));
    }

    public function show(Standard $standard)
    {
        return view('dashboard.standards.show', compact('standard'));
    }

    public function edit(Standard $standard)
    {
        return view('dashboard.standards.edit', compact('standard'));
    }

    public function update(Request $request, Standard $standard)
    {
        $this->validate($request, [
            'name' => 'required|max:200'
        ]);

        $this->standardRepository->update($standard->getKey(), $request->only(['name']));
        return redirect()->back()->with('message', __('dashboard-success.update', ['entity' => $this->className]));
    }

    public function destroy(Standard $standard)
    {
        $this->standardRepository->delete($standard->getKey());
        return redirect()->back()->with('message', __('dashboard-success.delete', ['entity' => $this->className]));
    }

    public function export($format)
    {
        $extension = 'csv';
        if($format == 'excel') $extension = 'xlsx';
        else if($format == 'csv') $extension = 'csv';

        return Excel::download(new StandardsExport(), 'standards.' . $extension);
    }

    public function import()
    {
        return Excel::download(new StandardsExport(), 'standards.xlsx');
    }
}
