<?php
/**
 * Created by PhpStorm.
 * User: ashiqhassan95
 * Date: 30/12/2018
 * Time: 10:55 PM
 */

namespace App\Helper;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class StoreHelper
{
    /**
     * @param array $data
     * @return array|mixed
     */
    public static function AssignUserAndInstitute(array $data) : array
    {
//        $data['institute_id'] = Request::session()->get('institute') ?? Auth::user()->institute_id;
        $data['institute_id'] = SessionHelper::getInstitute();
        $data['user_id'] = Auth::id();
        return $data;
    }


}