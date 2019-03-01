<?php

namespace App\Imports;

use App\Helper\SessionHelper;
use App\Models\Standard;
use App\Models\Voter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VotersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Voter([
            'name' => $row['name'],
            'admission_number' => $row['admission'],
            'roll_number' => $row['roll'],
            'birth_date' => $this->getBirthDate($row['date_of_birth']),
            'gender' => $this->getGender($row['gender']),
            'uid' => $this->generateUID(),
            'standard_id' =>  $this->getStandard($row['standard']),
            'institute_id' => SessionHelper::getInstitute(),
            'user_id' => Auth::id()
        ]);
    }

    public function getStandard($keyword)
    {
        if(!$keyword)
            return null;

        $standard = Standard::query()->firstOrCreate(
            [
                'name' => $keyword
            ],
            [
                'user_id' => Auth::id(),
                'institute_id' => SessionHelper::getInstitute()
            ]);
        return $standard->getKey();
    }

    public function generateUID()
    {
        $uid = mt_rand(1111111111, 9999999999);
        while(Voter::query()->where('uid', $uid)->exists()) {
            $uid = mt_rand(1111111111, 9999999999);
        }
        return $uid;
    }

    public function getGender($gender)
    {
        if(strtolower($gender) == 'male')
            return 0;
        else if(strtolower($gender) == 'female')
            return 1;
    }

    public function getBirthDate($date)
    {
        return date_create_from_format('d/m/Y', $date);
    }
}
