<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Institute;
use App\Repository\Interfaces\IInstituteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    /**
     * @var IInstituteRepository
     */
    private $instituteRepository;

    public function __construct(IInstituteRepository $instituteRepository)
    {
        $this->instituteRepository = $instituteRepository;
    }

    public function general(Request $request)
    {
        if(!$request->isMethod('post')) {
            return view('dashboard.settings.general');
        }


    }

    public function institute(Request $request)
    {
        if(!$request->isMethod('post')) {
            $institute = $this->instituteRepository->find(Auth::user()->institute_id);
            $countries = DB::table('countries')->orderBy('name')->get();
            return view('dashboard.settings.institute', compact('institute', 'countries'));
        }

        $this->validate($request, [
            'name' => 'required|max:255',
            'country' => 'required',
        ]);
    }

    public function appearance(Request $request)
    {
        if(!$request->isMethod('post')) {
            return view('dashboard.settings.appearance');
        }
    }
}
