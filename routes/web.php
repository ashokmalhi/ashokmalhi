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

$router->group(['middleware' => ['auth']], function () use ($router) {
    
    Route::get('dashboard', 'DashboardController@dashboard');
    Route::get('dashboard1', 'DashboardController@dashboard1');
    Route::get('dashoboardStats','DashboardController@getStats')->name('stats');

    Route::resource('/teams', 'TeamController');
    Route::post('teams/update','TeamController@update');
    Route::post('all_teams','TeamController@allTeams');
    
    Route::get('/players/upload', 'PlayerController@uploadPlayers');
    Route::post('/players/upload', 'PlayerController@uploadPlayers')->name('players-upload');
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