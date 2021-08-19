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
    Route::prefix('casino')->group(function () {
        Route::get('/', 'CasinoController@index')->name('casino')->middleware('is_auth');
        Route::post('/', 'CasinoController@bet_save')->name('bet_save')->middleware('is_auth');
        Route::get('/results', 'CasinoController@results')->name('casino_results')->middleware('is_auth');
    });

    Route::get('/champions_league', 'ChampionsLeagueController@index')->name('champions_league')->middleware('is_auth');
    Route::get('/forecaster', 'ForecasterController@index')->name('forecaster')->middleware('is_auth');
});

//////////// ADMIN PANEL ////////////
Route::prefix('F1_AdmiN')->group(function () {
//PILOTS
    Route::prefix('pilot')->group(function () {
        Route::match(['get', 'post' , 'delete'], '/', 'PilotsController@pilots')->name('pilots')->middleware('is_auth');
        Route::post('/edit', 'PilotsController@edit')->name('pilot_edit')->middleware('is_auth');
    });
//SOCIAL NETWORKS
    Route::prefix('social_networks')->group(function () {
        Route::match(['get', 'post' , 'delete'], '/', 'SocialNetworksController@social_networks')->name('social_networks')->middleware('is_auth');
        Route::match(['get', 'post'], '/edit/{id}', 'SocialNetworksController@edit')->name('social_network_edit')->middleware('is_auth');
    });
//BLOG
    Route::prefix('post')->group(function () {
        Route::match(['get', 'delete'], '/', 'PostsController@all')->name('posts_all')->middleware('is_auth');
        Route::match(['get', 'post'], '/add', 'PostsController@add')->name('post_add')->middleware('is_auth');
        Route::match(['get', 'post'], '/edit/{id}', 'PostsController@edit')->name('post_edit')->middleware('is_auth');
        Route::match(['get', 'post'], '/post_set/{id}', 'PostsController@post_set')->name('post_set')->middleware('is_auth');
    });
//RACE
    Route::prefix('race')->group(function () {
        Route::match(['get', 'post' , 'delete'], '/', 'RacesController@races')->name('races')->middleware('is_auth');
        Route::match(['get', 'post'], '/edit/{id}', 'RacesController@edit')->name('race_edit')->middleware('is_auth');
        Route::get('/activate/{id}', 'RacesController@race_activate')->name('race_activate')->middleware('is_auth');
    });
//USERS
    Route::prefix('user')->group(function () {
        Route::match(['get', 'post' , 'delete'], '/', 'UsersController@users')->name('users')->middleware('is_auth');
    });
//PARTNERS
    Route::prefix('partner')->group(function () {
        Route::match(['get', 'delete'], '/', 'PartnersController@partners')->name('partners')->middleware('is_auth');
        Route::match(['get', 'post'], '/add', 'PartnersController@add')->name('partners_add')->middleware('is_auth');
        Route::match(['get', 'post'], '/edit/{id}', 'PartnersController@edit')->name('partner_edit')->middleware('is_auth');
    });
//COMPETITIONS
    Route::prefix('competitions')->group(function () {
        Route::match(['get', 'delete'], '/', 'CompetitionsController@competitions')->name('competitions')->middleware('is_auth');
        Route::match(['get', 'post'], '/edit/{id}', 'CompetitionsController@edit')->name('competition_edit')->middleware('is_auth');
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
        Route::get('/up/{id}', 'SlidersController@up')->name('slider_up');
        Route::get('/down/{id}', 'SlidersController@down')->name('slider_down');
    });
});

Route::get('/404', function () {
    return view('Errors.404');
})->name('404');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
