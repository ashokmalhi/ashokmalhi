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

$router->group(['middleware' => ['webAuth']], function () use ($router) {
    
});