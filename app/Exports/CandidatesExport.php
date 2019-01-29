<?php

namespace App\Exports;

use App\Models\Candidate;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CandidatesExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Candidate::all();
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
            'Gender',
            'Birth date',
            'Standard',
            'Position',
            'Is active',
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
            $row->gender,
            $row->birth_date,
            $row->standard->name,
            $row->position->title,
            $row->is_active == 1 ? 'true' : 'false'
        ];
    }
}
