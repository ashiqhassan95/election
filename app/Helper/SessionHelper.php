<?php
/**
 * Created by PhpStorm.
 * User: ashiqhassan95
 * Date: 30/12/2018
 * Time: 11:00 PM
 */

namespace App\Helper;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class SessionHelper
{
    /**
     * @return int
     */
    public static function getInstitute(): int
    {
        return Request::session()->get('institute');
    }

    public static function storeInstitute($instituteId)
    {
        Session::put('institute', $instituteId);
    }
}