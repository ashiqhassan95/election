<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\PositionsExport;
use App\Helper\SessionHelper;
use App\Helper\StoreHelper;
use App\Models\Position;
use App\Repository\Interfaces\IPositionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class PositionController extends Controller
{

    /**
     * @var IPositionRepository
     */
    private $positionRepository;

    /**
     * @var string
     */
    private $className = 'Position';

    public function __construct(IPositionRepository $positionRepository)
    {
        $this->middleware('auth')->except('show', 'index');
        $this->positionRepository = $positionRepository;
    }

    public function index()
    {
        $positions = $this->positionRepository->allByInstitute(SessionHelper::getInstitute());
        return view('dashboard.positions.index', compact('positions'));
    }

    public function create()
    {
        return view('dashboard.positions.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:200'
        ]);

        $entry_data = $request->only(['title']);
        $entry_data = StoreHelper::AssignUserAndInstitute($entry_data);

        $position = $this->positionRepository->create($entry_data);
        return redirect()->back()->with('message', __('dashboard-success.save', ['entity' => $this->className]));
    }

    public function show(Position $position)
    {
        return view('dashboard.positions.show', compact('position'));
    }

    public function edit(Position $position)
    {
        return view('dashboard.positions.edit', compact('position'));
    }

    public function update(Request $request, Position $position)
    {
        $this->validate($request, [
            'title' => 'required|max:200'
        ]);

        $this->positionRepository->update($position->getKey(), $request->only(['title']));
        return redirect()->back()->with('message', __('dashboard-success.update', ['entity' => $this->className]));
    }

    public function destroy(Position $position)
    {
        $this->positionRepository->delete($position->getKey());
        return redirect()->back()->with('message', __('dashboard-success.delete', ['entity' => $this->className]));
    }

    public function export($format)
    {
        $extension = 'csv';
        if($format == 'excel') $extension = 'xlsx';
        else if($format == 'csv') $extension = 'csv';

        return Excel::download(new PositionsExport(), 'positions.' . $extension);
    }
}
