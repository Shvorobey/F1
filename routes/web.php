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
Route::post('/post/add_comment', 'PagesController@add_comment')->middleware('check_role:auth')->name('add_comment');
Route::get('/post/del_comment/{id}', 'PagesController@delete_comment')->middleware('check_role:admin')->name('delete_comment');
Route::get('/races', 'PagesController@races')->name('races_user');
Route::get('/single_race/{id}', 'PagesController@single_race')->name('single_race_user');

// USER CABINET
Route::group([
    'middleware' => 'check_role:auth',
    'prefix' => 'user_cabinet'
], function () {
    Route::get('/', 'UserCabinetController@user_cabinet')->name('user_cabinet');
    Route::match(['get', 'post'], '/edit', 'UserCabinetController@user_edit')->name('user_edit');
});

//CASINO
Route::prefix('competition')->group(function () {
    Route::prefix('casino')->group(function () {
        Route::get('/', 'CasinoController@index')->name('casino');
        Route::post('/', 'CasinoController@bet_save')->name('bet_save');
        Route::get('/results', 'CasinoController@results')->name('casino_results');
    });

    Route::get('/champions_league', 'ChampionsLeagueController@index')->name('champions_league');
    Route::get('/forecaster', 'ForecasterController@index')->name('forecaster');
});

//////////// ADMIN PANEL ////////////
Route::group([
    'middleware' => 'check_role:admin',
    'prefix' => 'F1_AdmiN'
], function () {

//PILOTS
    Route::prefix('pilot')->group(function () {
        Route::match(['get', 'post', 'delete'], '/', 'PilotsController@pilots')->name('pilots');
        Route::post('/edit', 'PilotsController@edit')->name('pilot_edit');
    });

//SOCIAL NETWORKS
    Route::prefix('social_networks')->group(function () {
        Route::match(['get', 'post', 'delete'], '/', 'SocialNetworksController@social_networks')->name('social_networks');
        Route::match(['get', 'post'], '/edit/{socialNetwork}', 'SocialNetworksController@edit')->name('social_network_edit');
    });

//BLOG
    Route::prefix('post')->group(function () {
        Route::match(['get', 'delete'], '/', 'PostsController@all')->name('posts_all');
        Route::match(['get', 'post'], '/add', 'PostsController@add')->name('post_add');
        Route::match(['get', 'post'], '/edit/{post}', 'PostsController@edit')->name('post_edit');
        Route::match(['get', 'post'], '/post_set/{id}', 'PostsController@post_set')->name('post_set');
    });

//RACE
    Route::prefix('race')->group(function () {
        Route::match(['get', 'post', 'delete'], '/', 'RacesController@races')->name('races');
        Route::match(['get', 'post'], '/edit/{race}', 'RacesController@edit')->name('race_edit');
        Route::get('/activate/{id}', 'RacesController@race_activate')->name('race_activate');
    });

//USERS
    Route::prefix('user')->group(function () {
        Route::match(['get', 'post', 'delete'], '/', 'UsersController@users')->name('users');
    });

//PARTNERS
    Route::prefix('partner')->group(function () {
        Route::match(['get', 'delete'], '/', 'PartnersController@partners')->name('partners');
        Route::match(['get', 'post'], '/add', 'PartnersController@add')->name('partners_add');
        Route::match(['get', 'post'], '/edit/{id}', 'PartnersController@edit')->name('partner_edit');
    });

//COMPETITIONS
    Route::prefix('competitions')->group(function () {
        Route::match(['get', 'delete'], '/', 'CompetitionsController@competitions')->name('competitions');
        Route::match(['get', 'post'], '/edit/{id}', 'CompetitionsController@edit')->name('competition_edit');
    });

// RACE RESULT
    Route::prefix('race_result')->group(function () {
        Route::match(['get', 'post'], '/', 'RaceResultController@race_result')->name('race_result');
        Route::match(['get', 'post'], '/{id}', 'RaceResultController@single')->name('race_result_single');
    });

//CASINO COUNTING
    Route::prefix('casino_counting')->group(function () {
        Route::get('/{id}', 'CasinoController@count')->name('casino_counting');
    });

// SLIDERS
    Route::prefix('sliders')->group(function () {
        Route::match(['get', 'delete'], '/', 'SlidersController@sliders')->name('sliders');
        Route::get('/deactivate/{id}', 'SlidersController@deactivate')->name('slider_deactivate');
        Route::match(['get', 'post'], '/add', 'SlidersController@add')->name('slider_add');
        Route::match(['get', 'post'], '/edit/{id}', 'SlidersController@edit')->name('slider_edit');
        Route::get('/up/{id}', 'SlidersController@up')->name('slider_up');
        Route::get('/down/{id}', 'SlidersController@down')->name('slider_down');
    });

// RULES
    Route::prefix('rule')->group(function () {
        Route::match(['get', 'post', 'delete'], '/', 'RulesController@rules')->name('rules_all');
        Route::post('/edit', 'RulesController@edit')->name('pilot_edit');
    });});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
