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
    return view('welcome');
});

Route::get('login', 'LoginController@login');
Route::get('dashboard', 'DashboardController@dashboard');
Route::get('dashboard1', 'DashboardController@dashboard1');
Route::get('dashoboardStats','DashboardController@getStats')->name('stats');

Route::resource('/teams', 'TeamController');
Route::post('all_teams','TeamController@allTeams');
Route::resource('/players', 'PlayerController');
Route::post('all_players','PlayerController@allPlayers');

Route::get('chart', 'LoginController@chart');

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


$router->group(['middleware' => ['webAuth']], function () use ($router) {
    
});