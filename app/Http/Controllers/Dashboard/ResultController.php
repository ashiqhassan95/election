<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Candidate;
use App\Models\Election;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class ResultController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showResult(Request $request, Election $election)
    {
        if ($election['type'] == 0) {
            return $this->showPresidentialResult($election);
        } else if ($election['type'] == 1) {
            $standard = $request->get('standard');
            return $this->showParliamentaryResult($election, $standard);
        }
    }

    private function showPresidentialResult(Election $election)
    {
        $result = new Collection();
        $superQuery = Candidate::query()
            ->with(['voter', 'standard', 'position', 'election'])
            ->where('election_id', $election->getKey())
            ->get();

        $positions = $superQuery->pluck('position')->unique()->values()->toArray();

        foreach ($positions as $position)
        {
            $totalVotes =
            $candidates = $superQuery->where('position_id', $position['id'])->values()->toArray();
            $position['candidates'] = $candidates;
            $result->push($position);
        }
        return $result;
    }

    private function showParliamentaryResult(Election $election, $standard)
    {

    }

    private function getTotalVotes($election_id, $position_id)
    {

    }
}
