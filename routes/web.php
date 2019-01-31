<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::get('/', 'FrontEnd\HomeController@index')->name('frontend.home');

Route::get('/debug', function () {
//    return $pageName;
    return view('dashboard.layouts.master');
});

Route::get('/shards/{pageName}', function ($pageName) {
//    return $pageName;
    return view('shards.' . $pageName);
});

Route::get('/dashboard/users/invite', 'InviteController@invite')->name('invite.show');
Route::post('/dashboard/users/invite', 'InviteController@process')->name('invite.process');
Route::get('/invite/{token}', 'InviteController@accept')->name('invite.accept');
Route::post('/invite', 'InviteController@register')->name('invite.register');

Route::get('/dashboard/standards/export', 'Dashboard\ClassController@export')->name('dashboard.standards.export');
Route::get('/dashboard/positions/export', 'Dashboard\PositionController@export')->name('dashboard.positions.export');
Route::get('/dashboard/voters/export', 'Dashboard\VoterController@export')->name('dashboard.voters.export');
Route::get('/dashboard/candidates/export', 'Dashboard\CandidateController@export')->name('dashboard.candidates.export');

Route::post('/dashboard/standards/import/{format}', 'Dashboard\ClassController@import')->name('dashboard.standards.import');
Route::post('/dashboard/positions/import/{format}', 'Dashboard\PositionController@import')->name('dashboard.positions.import');
Route::post('/dashboard/voters/import/{format}', 'Dashboard\VoterController@import')->name('dashboard.voters.import');
Route::post('/dashboard/candidates/import/{format}', 'Dashboard\CandidateController@import')->name('dashboard.candidates.import');
Route::get('/dashboard/elections/{election}/launch', 'Dashboard\ElectionController@launch')->name('dashboard.elections.launch');
Route::post('/dashboard/elections/launch', 'Dashboard\ElectionController@launchElection')->name('dashboard.elections.launch.push');
//Route::post('/dashboard/candidate/{voter}/create', 'Dashboard\CandidateController@createCandidate')->name('dashboard.candidate.create');

Route::prefix('dashboard')->namespace('Dashboard')
    ->name('dashboard.')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        /**
         * url ->  /dashboard
         */
        Route::get('/', 'DashboardController@index')->name('index');
        /**
         * url -> /dashboard/candidates
         * controller -> Dashboard/CandidateController
         * name -> dashboard.candidates.method
         */
        Route::resource('candidates', 'CandidateController');
        /**
         * url -> /dashboard/voters
         * controller -> Dashboard/VoterController
         * name -> dashboard.voters.method
         */
        Route::resource('voters', 'VoterController');
        /**
         * url -> /dashboard/standards
         * controller -> Dashboard/StandardController
         * name -> dashboard.standards.method
         */
        Route::resource('standards', 'StandardController');
        /**
         * url -> /dashboard/elections
         * controller -> Dashboard/ElectionController
         * name -> dashboard.elections.method
         */
        Route::resource('elections', 'ElectionController');
        /**
         * url -> /dashboard/positions
         * controller -> Dashboard/PositionController
         * name -> dashboard.positions.method
         */
        Route::resource('positions', 'PositionController');
        /**
         * url -> /dashboard/institutes
         * controller -> Dashboard/InstituteController
         * name -> dashboard.institutes.method
         */
        Route::resource('institutes', 'InstituteController');
        /**
         * url -> /dashboard/users
         * controller -> Dashboard/UserController
         * name -> dashboard.users.method
         */
        Route::resource('users', 'UserController');
        /**
         * url -> /dashboard/users
         * controller -> Dashboard/UserController
         * name -> dashboard.users.method
         */
        Route::any('/settings/general', 'SettingController@general')->name('settings.general');
        Route::any('/settings/institute', 'SettingController@institute')->name('settings.institute');
        Route::any('/settings/appearance', 'SettingController@appearance')->name('settings.appearance');
//        Route::resource('settings', 'SettingController');
    });


Route::get('/home', 'HomeController@index')->name('home');
