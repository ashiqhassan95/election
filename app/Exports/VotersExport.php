<?php

namespace App\Exports;

use App\Helper\SessionHelper;
use App\Models\Voter;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VotersExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Voter::query()
            ->with(['standard'])
            ->where('institute_id', SessionHelper::getInstitute())
            ->get();
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
        ];
    }
}
