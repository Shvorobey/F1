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

//////////// PAGES ////////////
Route::get('/', 'PagesController@index')->name('index');
Route::get('/rules/{key}', 'PagesController@rule')->name('rule');
Route::get('/posts', 'PagesController@posts')->name('posts');
Route::get('/post/{id}', 'PagesController@single_post')->name('single_post');
Route::post('/post/add_comment', 'PagesController@add_comment')->name('add_comment');
Route::get('/post/del_comment/{id}', 'PagesController@delete_comment')->name('delete_comment');
Route::get('/races', 'PagesController@races')->name('races_user');
Route::get('/single_race/{id}', 'PagesController@single_race')->name('single_race_user');
Route::get('/user_cabinet', 'UserCabinetController@user_cabinet')->name('user_cabinet');
Route::get('/user/edit', 'UserCabinetController@user_edit')->name('user_edit');
Route::post('/user/edit', 'UserCabinetController@user_save_edit')->name('user_save_edit');

//CASINO
Route::prefix('competition')->group(function () {
    Route::prefix('casino')->group(function (){
        Route::get('/', 'CasinoController@index')->name('casino');
        Route::post('/', 'CasinoController@bet_save')->name('bet_save');
        Route::get('/results', 'CasinoController@results')->name('casino_results');
    });



    Route::get('/champions_league', 'ChampionsLeagueController@index')->name('champions_league');
    Route::get('/forecaster', 'ForecasterController@index')->name('forecaster');
});

//////////// ADMIN PANEL ////////////
Route::prefix('F1_AdmiN')->group(function () {
//PILOTS
    Route::prefix('pilot')->group(function () {
        Route::get('/', 'PilotsController@pilots')->name('pilots');
        Route::post('/add', 'PilotsController@add')->name('pilot_add');
        Route::post('/edit', 'PilotsController@edit')->name('pilot_edit');
        Route::delete('/delete', 'PilotsController@delete')->name('pilot_delete');
    });
//SOCIAL NETWORKS
    Route::prefix('social_networks')->group(function () {
        Route::get('/', 'SocialNetworksController@social_networks')->name('social_networks');
        Route::post('add', 'SocialNetworksController@add')->name('social_network_add');
        Route::get('/edit/{id}', 'SocialNetworksController@edit')->name('social_network_edit');
        Route::post('/edit_save', 'SocialNetworksController@update')->name('social_network_save_edit');
        Route::delete('/delete', 'SocialNetworksController@delete')->name('social_network_delete');
    });
//BLOG
    Route::prefix('post')->group(function () {
        Route::get('/', 'PostsController@all')->name('posts_all');
        Route::get('/add', 'PostsController@add')->name('post_add');
        Route::post('/add', 'PostsController@save')->name('post_save_new');
        Route::get('/edit/{id}', 'PostsController@edit')->name('post_edit');
        Route::post('/edit/{id}', 'PostsController@update')->name('post_save_edit');
        Route::delete('/delete', 'PostsController@delete')->name('post_delete');
        Route::post('/post_set', 'PostsController@post_set')->name('post_set');
        Route::get('/post_best/{id}', 'PostsController@post_best')->name('post_best');
    });
//RACE
    Route::prefix('race')->group(function () {
        Route::get('/', 'RacesController@all')->name('races');
        Route::post('/add', 'RacesController@add')->name('race_add');
        Route::get('/edit/{id}', 'RacesController@edit')->name('race_edit');
        Route::post('/edit', 'RacesController@update')->name('race_save_edit');
        Route::get('/activate/{id}', 'RacesController@race_activate')->name('race_activate');
        Route::delete('/', 'RacesController@delete')->name('race_delete');
    });
//USERS
    Route::prefix('user')->group(function () {
        Route::get('/', 'UsersController@all')->name('users');
        Route::post('/activate', 'UsersController@admin_activate')->name('admin_activate');
        Route::delete('/delete', 'UsersController@delete')->name('user_delete');
    });
//PARTNERS
    Route::prefix('partner')->group(function () {
        Route::get('/', 'PartnersController@partners')->name('partners');
        Route::get('/add', 'PartnersController@add')->name('partners_add');
        Route::post('/add', 'PartnersController@save')->name('partner_save_new');
        Route::delete('/delete', 'PartnersController@delete')->name('partner_delete');
        Route::get('/edit/{id}', 'PartnersController@edit')->name('partner_edit');
        Route::post('/edit', 'PartnersController@update')->name('partner_save_edit');
    });
//COMPETITIONS
    Route::prefix('competitions')->group(function () {
        Route::get('/', 'CompetitionsController@competitions')->name('competitions');
        Route::delete('/delete', 'CompetitionsController@delete')->name('competition_delete');
        Route::get('/edit/{id}', 'CompetitionsController@edit')->name('competition_edit');
        Route::post('/edit', 'CompetitionsController@update')->name('competition_save_edit');
    });
// RACE RESULT
    Route::prefix('race_result')->group(function () {
        Route::get('/', 'RaceResultController@race_result')->name('race_result');
        Route::post('/', 'RaceResultController@save')->name('race_result_save');
        Route::get('/{id}', 'RaceResultController@single')->name('race_result_single');
        Route::post('/{id}', 'RaceResultController@update')->name('race_result_update');
    });
//CASINO COUNTING
    Route::prefix('casino_counting')->group(function () {
        Route::get('/{id}', 'CasinoController@count')->name('casino_counting');
    });
// SLIDERS
    Route::prefix('sliders')->group(function () {
        Route::get('/', 'SlidersController@sliders')->name('sliders');
        Route::get('/deactivate/{id}', 'SlidersController@deactivate')->name('slider_deactivate');
        Route::delete('/delete', 'SlidersController@delete')->name('slider_delete');
        Route::get('/add', 'SlidersController@add')->name('slider_add');
        Route::post('/add', 'SlidersController@save')->name('slider_save');
        Route::get('/edit/{id}', 'SlidersController@edit')->name('slider_edit');
        Route::post('/edit/{id}', 'SlidersController@update')->name('slider_edit_save');
    });
});

Route::get('/404', function () {
    return view('Errors.404');
})->name('404');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
