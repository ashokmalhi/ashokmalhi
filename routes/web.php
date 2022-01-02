<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('/login');
});

Route::get('login', 'LoginController@login')->name('login');
Route::post('login', 'LoginController@doLogin');
Route::get('logout', 'LoginController@logout');

Route::get('heatmap',function(){
    return view('heatmap');
});

Route::get('heatmapimage',function(){
    return view('heatmapimage');
});

Route::get('password_reset', 'LoginController@passwordReset');
Route::post('password_reset', 'LoginController@updatePassword')->name('reset-password');

$router->group(['middleware' => ['auth']], function () use ($router) {

    Route::get('dashboard', 'DashboardController@dashboard');
    Route::get('dashboard1', 'DashboardController@dashboard1');
    Route::get('dashoboardStats','DashboardController@getStats')->name('stats');

    Route::resource('/teams', 'TeamController');
    Route::post('team/member/delete', 'TeamController@removeTeamMember')->name('teamPlayer.delete');
    Route::post('teams/update','TeamController@update');
    Route::post('all_teams','TeamController@allTeams');

    Route::get('/players/upload', 'PlayerController@uploadPlayers');
    Route::post('/players/upload', 'PlayerController@uploadPlayers')->name('players-upload');
    Route::resource('/players', 'PlayerController');
    Route::post('all_players','PlayerController@allPlayers');

    Route::get('chart', 'LoginController@chart');

    Route::resource('/coaches', 'CoachController');
    Route::post('all_coaches','CoachController@allCoaches');

    $router->group(['prefix' => 'statistics'], function () use ($router) {

        $router->get('/calculate_final_stats_player/{matchId}/{teamId}', 'StatsController@calculateFinalStats');

        $router->get('/', 'StatsController@index');
        $router->post('/all', 'StatsController@allStats');
        $router->get('/create', 'StatsController@create');
        $router->post('upload', 'StatsController@upload')->name('stats-upload');
        $router->get('team/{id}', 'StatsController@showTeamStats');
        $router->get('player/{id}', 'StatsController@showPlayerStats');
        $router->get('stats', 'StatsController@show');
        $router->post('all_team_stats', 'StatsController@allTeamStats');
        $router->get('player_stats', 'StatsController@getPlayerStats')->name('team_stats');

    });

    Route::resource('/matches', 'MatchController');
    Route::post('all_matches','MatchController@allMatches');
    Route::get('upload_match_stats/{matchId}','MatchController@uploadMatchStats');
    Route::post('upload_match_stats','MatchController@submitMatchStats')->name('team_player_stats');

    Route::post('/matches/get_team_player_details', 'MatchController@getIndividualTeamMemberDetails');

    Route::get('/matches/{matchId}/{teamId}', 'MatchController@getTeamDetails');
    Route::get('intensityTimeStat','MatchController@getIntensityStats')->name('intensity-stats');
    Route::get('heatMapStats','MatchController@heatMapStats')->name('heat-map');
    //Route::get('/matches/{matchId}/{teamId}/{playerId}', 'MatchController@getIndividualTeamMemberDetails');

    Route::get('/matchesz/{matchId}/{teamId}',function (){
        return \App\Models\MatchStatDetail::getIntervalByMinute();
    });


    Route::get('delete_whole_match/{matchId}','MatchController@deleteWholeMatch')->name('delete_whole_match');

    Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
        Route::get('/', 'RoleController@index')->name('index');
        Route::get('create', 'RoleController@create')->name('create');
        Route::post('create', 'RoleController@store')->name('store');
        Route::get('{id}', 'RoleController@show')->name('show');
        Route::get('{id}/edit', 'RoleController@edit')->name('edit');
        Route::patch('{id}', 'RoleController@update')->name('update');
        Route::delete('{id}', 'RoleController@destroy')->name('destroy');
        Route::get('destroy/{id}', 'RoleController@destroy')->name('destroy');
    });
});

Route::prefix('/player')->namespace('PlayerAdmin')->group(function(){

    //All the player routes will be defined here...
    //Auth::routes();


    Route::get('/', function () {
        return redirect('player/login');
        //return view('player_admin.chart');
    });

    Route::get('login', 'LoginController@showLoginForm')->name('playerLogin');
    Route::post('login', 'LoginController@login')->name('doPlayerLogin');;
    Route::post('logout', 'LoginController@logout')->name('doPlayerLogout');

    Route::group(['middleware' => ['auth:player_admin']], function () {

        Route::get('/dashboard', 'DashboardController@dashboard');
        Route::get('/dashboard/distanceInterval', 'DashboardController@getDistanceInterval');


        Route::get('/match/{matchId}', 'MatchController@index');

        Route::get('/match/{matchId}/getMinByInterval','MatchController@getMinByInterval');
        Route::get('/match/{matchId}/getHeatMapData','MatchController@getHeatMapData');
        Route::get('/match/{matchId}/intensityTimeStat','MatchController@getIntensityStats');


    });





});


//Auth::routes();
/***
GET|HEAD  | password/confirm                                           | password.confirm   | App\Http\Controllers\Auth\ConfirmPasswordController@showConfirmForm    | web        |
|        |           |                                                            |                    |                                                                        | auth       |
|        | POST      | password/confirm                                           |                    | App\Http\Controllers\Auth\ConfirmPasswordController@confirm            | web        |
|        |           |                                                            |                    |                                                                        | auth       |
|        | POST      | password/email                                             | password.email     | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web        |
|        | POST      | password/reset                                             | password.update    | App\Http\Controllers\Auth\ResetPasswordController@reset                | web        |
|        | GET|HEAD  | password/reset                                             | password.request   | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web        |
|        | GET|HEAD  | password/reset/{token}                                     | password.reset     | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web        |
|        | GET|HEAD  | password_reset                                             |                    | App\Http\Controllers\LoginController@passwordReset                     | web        |
|        | POST      | password_reset                                             | reset-password     | App\Http\Controllers\LoginController@updatePassword                    | web
 *
 *
 *////
