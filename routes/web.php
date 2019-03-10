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


/**
 * Generate a CSV of all the routes
 */
Route::get('/debug/r', function()
{
    header('Content-Type: application/excel');
    header('Content-Disposition: attachment; filename="routes.csv"');

    $routes = Route::getRoutes();
    $fp = fopen('php://output', 'w');
    fputcsv($fp, ['METHOD', 'URI', 'NAME', 'ACTION']);
    foreach ($routes as $route) {
        fputcsv($fp, [head($route->methods()) , $route->uri(), $route->getName(), $route->getActionName()]);
    }
    fclose($fp);
});

Route::get('/dashboard/users/invite', 'InviteController@invite')->name('invite.show');
Route::post('/dashboard/users/invite', 'InviteController@process')->name('invite.process');
Route::get('/invite/{token}', 'InviteController@accept')->name('invite.accept');
Route::post('/invite', 'InviteController@register')->name('invite.register');

Route::get('/dashboard/voters/export', 'Dashboard\VoterController@export')
    ->name('dashboard.voters.export');

Route::get('/dashboard/voters/import', 'Dashboard\VoterController@showImportForm')
    ->name('dashboard.voters.show.import');
Route::post('/dashboard/voters/import', 'Dashboard\VoterController@import')
    ->name('dashboard.voters.import');

Route::post('/dashboard/elections/{election}/launch', 'Dashboard\ElectionController@launchElection')
    ->name('dashboard.elections.launch');
Route::post('/dashboard/elections/{election}/complete', 'Dashboard\ElectionController@completeElection')
    ->name('dashboard.elections.complete');

Route::get('/dashboard/elections/{election}/result', 'Dashboard\ElectionController@showResult')
    ->name('dashboard.elections.show.result');

Route::get('/dashboard/elections/{election}/voters', 'Dashboard\ElectionController@showVoters')
    ->name('dashboard.elections.show.voters');
Route::get('/dashboard/elections/{election}/voters/export', 'Dashboard\ElectionController@exportVoters')
    ->name('dashboard.elections.export.voters');

Route::post('/dashboard/elections/{election}/result', 'Dashboard\ElectionController@processResult')
    ->name('elections.process.result');

Route::get('/elections/{slug}', 'FrontEnd\ElectionController@showCandidates')
    ->name('elections.vote');
Route::get('/elections/{slug}/login', 'Auth\VoterLoginController@showLoginForm')
    ->name('elections.vote.login');
Route::post('/elections/{slug}', 'Auth\VoterLoginController@login');

Route::post('/elections/{slug}/caste', 'FrontEnd\ElectionController@casteVote')->name('frontend.elections.vote.caste');
Route::get('/elections/{slug}/thanks', 'FrontEnd\ElectionController@thanks')->name('frontend.elections.vote.thanks');

Route::prefix('dashboard')->namespace('Dashboard')
    ->name('dashboard.')
    ->middleware(['auth'])
    ->group(function () {
        /**
         * url ->  /dashboard
         */
//        Route::get('/', 'DashboardController@index')->name('index');
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
    });

Route::get('/home', 'HomeController@index')->name('home');
