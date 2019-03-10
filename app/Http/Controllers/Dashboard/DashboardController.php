<?php

namespace App\Http\Controllers\Dashboard;

use App\Helper\SessionHelper;
use App\Models\Candidate;
use App\Models\Election;
use App\Models\Enums\ElectionStatus;
use App\Models\Position;
use App\Models\Standard;
use App\Models\Voter;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'standards_count' => Standard::query()->where('institute_id', SessionHelper::getInstitute())->count(),
            'voters_count' => Voter::query()->where('institute_id', SessionHelper::getInstitute())->count(),
            'positions_count' => Position::query()->where('institute_id', SessionHelper::getInstitute())->count(),
            'elections_count' => Election::query()->where('institute_id', SessionHelper::getInstitute())->count(),
            'candidates_count' => Candidate::query()
                ->where('institute_id', SessionHelper::getInstitute())
                ->whereHas('election', function($query){
                    $query->where('status', '!=',  ElectionStatus::COMPLETED);
                })
                ->count(),
        ];
        return view('dashboard.index', $data);
    }
}
