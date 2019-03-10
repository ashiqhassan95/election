<?php

namespace App\Exports;

use App\Models\Voter;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VoterCastExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    private $election;

    public function __construct($election)
    {

        $this->election = $election;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return new Collection(Voter::query()
            ->with('standard')
            ->leftJoin('vote_cast', 'voters.id', '=', 'vote_cast.voter_id')
            ->where('vote_cast.election_id', '=', $this->election)
            ->select('voters.*', 'vote_cast.voted_at')
            ->get()
            ->unique('id')
            ->values()
            ->all());
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Name',
            'Admission number',
            'Roll number',
            'UID',
            'Standard',
            'Gender',
            'Date of birth',
            'Voted at',
        ];
    }

    /**
     * @param $row
     * @return array
     */
    public function map($row): array
    {
        return [
            $row->name,
            $row->admission_number,
            $row->roll_number,
            $row->uid,
            $row->standard->name,
            $row->gender == 0 ? 'Male' : 'Female',
            $row->birth_date,
            $row->voted_at
        ];
    }
}
