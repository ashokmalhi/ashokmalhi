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
    
//    $router->group(['prefix' => 'matches'], function () use ($router) {
//        
//        $router->get('/create', 'MatchController@create');
//        $router->post('/store', 'MatchController@store')->name('match.store');
//
//    });
    
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