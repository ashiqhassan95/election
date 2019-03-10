<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\VotersExport;
use App\Helper\SessionHelper;
use App\Helper\StoreHelper;
use App\Imports\VotersImport;
use App\Models\Voter;
use App\Repository\Interfaces\IStandardRepository;
use App\Repository\Interfaces\IVoterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class VoterController extends Controller
{
    /**
     * @var IVoterRepository
     */
    private $voterRepository;
    /**
     * @var IStandardRepository
     */
    private $standardRepository;

    /**
     * @var string
     */
    private $className = 'Voter';

    public function __construct(IVoterRepository $voterRepository, IStandardRepository $standardRepository)
    {
        $this->voterRepository = $voterRepository;
        $this->standardRepository = $standardRepository;

        $this->middleware('auth')->except('index', 'show');
    }

    public function index()
    {
        $voters = $this->voterRepository->allByInstitute(SessionHelper::getInstitute(), ['standard']);
        return view('dashboard.voters.index', compact('voters'));
    }

    public function create()
    {
        $standards = $this->standardRepository->all();
        $uid = mt_rand(1111111111, 9999999999);
        while(Voter::query()->where('uid', $uid)->exists()) {
            $uid = mt_rand(1111111111, 9999999999);
        }

        return view('dashboard.voters.create', compact('standards', 'uid'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'admission_number' => 'required',
            'roll_number' => 'required',
            'birth_date' => 'required',
            'gender' => 'required',
            'uid' => 'required|unique:voters,uid',
            'standard_id' => 'required|exists:standards,id'
        ]);

        $entry_data =  $request->only([
            'name', 'admission_number', 'roll_number',
            'birth_date', 'gender', 'uid', 'standard_id'
        ]);

        $entry_data = StoreHelper::AssignUserAndInstitute($entry_data);

        $voter = $this->voterRepository->create($entry_data);

        return redirect()->back()->with('message', __('dashboard-success.save', ['entity' => $this->className]));
    }

    public function show(Voter $voter)
    {
        return view('dashboard.voters.show', compact('voter'));
    }

    public function edit(Voter $voter)
    {
        $data = [
            'voter' => $voter,
            'standards' => $this->standardRepository->all(),
        ];
        return view('dashboard.voters.edit', $data);
    }

    public function update(Request $request, Voter $voter)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'admission_number' => 'required',
            'roll_number' => 'required',
            'birth_date' => 'required',
            'gender' => 'required',
            'standard_id' => 'required'
        ]);

        $this->voterRepository->update($voter->getKey(), $request->only([
            'name', 'admission_number', 'roll_number',
            'birth_date', 'gender', 'standard_id'
        ]));

        return redirect()->back()->with('message', __('dashboard-success.update', ['entity' => $this->className]));
    }

    public function destroy(Voter $voter)
    {
        $this->voterRepository->delete($voter->getKey());
        return redirect()->route('dashboard.voters.index');
    }

    public function export(Request $request)
    {
        $format = $request->get('format');
        $extension = 'csv';

        if($format == 'excel')
            $extension = 'xlsx';
        else if($format == 'csv')
            $extension = 'csv';

        return Excel::download(new VotersExport(), 'voters.' . $extension);
    }

    public function showImportForm()
    {
        return view('dashboard.voters.import');
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file'//|mimes:csv,xlsx,xls'
        ]);

        Excel::import(new VotersImport(), $request->file('file'));
        return redirect()->back()->with('message', __('dashboard-success.import', ['entity' => $this->className]));
    }

    public function importComplicated(Request $request)
    {
        $path = $request->file('file')->getRealPath();
        $data = Excel::load($path)->get();
//
//        if($data->count()){
//            foreach ($data as $key => $value) {
//                $arr[] = ['title' => $value->title, 'description' => $value->description];
//            }
//
//            if(!empty($arr)){
//                Item::insert($arr);
//            }
//        }
//
//        return back()->with('success', 'Insert Record successfully.');
    }
}
