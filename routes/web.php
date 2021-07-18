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
Route::get('/user_cabinet', 'UserCabinetController@user_cabinet')->name('user_cabinet');
Route::get('/user/edit', 'UserCabinetController@user_edit')->name('user_edit');
Route::post('/user/edit', 'UserCabinetController@user_save_edit')->name('user_save_edit');


Route::get('/competition/casino', 'CasinoController@index')->name('casino');
Route::get('/competition/champions_league', 'ChampionsLeagueController@index')->name('champions_league');
Route::get('/competition/forecaster', 'ForecasterController@index')->name('forecaster');

//////////// ADMIN PANEL ////////////
//PILOTS
Route::get('/F1_admin/pilots', 'PilotsController@pilots')->name('pilots');
Route::post('/F1_admin/pilot/add', 'PilotsController@pilot_add')->name('pilot_add');
Route::post('/F1_admin/pilot/edit', 'PilotsController@pilot_edit')->name('pilot_edit');
Route::delete('/F1_admin/pilot/delete', 'PilotsController@delete')->name('pilot_delete');
//SOCIAL NETWORKS
Route::get('/F1_admin/social_networks', 'SocialNetworksController@social_networks')->name('social_networks');
Route::post('/F1_admin/social_networks/add', 'SocialNetworksController@add')->name('social_network_add');
Route::get('/F1_admin/social_networks/edit/{id}', 'SocialNetworksController@edit')->name('social_network_edit');
Route::post('/F1_admin/social_networks/edit_save', 'SocialNetworksController@save_edit')->name('social_network_save_edit');
Route::delete('/F1_admin/social_networks/delete', 'SocialNetworksController@delete')->name('social_network_delete');
//BLOG
Route::get('/F1_admin/posts', 'PostsController@all')->name('posts_all');
Route::get('/F1_admin/post/add', 'PostsController@add')->name('post_add');
Route::post('/F1_admin/post/add', 'PostsController@save_new')->name('post_save_new');
Route::get('/F1_admin/post/edit/{id}', 'PostsController@edit')->name('post_edit');
Route::post('/F1_admin/post/edit/{id}', 'PostsController@save_edit')->name('post_save_edit');
Route::delete('/F1_admin/post/delete', 'PostsController@delete')->name('post_delete');
Route::post('/F1_admin/post/post_set', 'PostsController@post_set')->name('post_set');
Route::get('/F1_admin/post/post_best/{id}', 'PostsController@post_best')->name('post_best');
//RACE
Route::get('/F1_admin/races', 'RacesController@all')->name('races');
Route::post('/F1_admin/races/add', 'RacesController@add')->name('race_add');
Route::get('/F1_admin/race/edit/{id}', 'RacesController@edit')->name('race_edit');
Route::post('/F1_admin/race/edit', 'RacesController@save_edit')->name('race_save_edit');
Route::get('/F1_admin/race/activate/{id}', 'RacesController@race_activate')->name('race_activate');
Route::delete('/F1_admin/race', 'RacesController@delete')->name('race_delete');
//USERS
Route::get('/F1_admin/users', 'UsersController@all')->name('users');
Route::post('/F1_admin/user/activate', 'UsersController@admin_activate')->name('admin_activate');
//Route::post('/F1_admin/races/add', 'UsersController@add')->name('race_add');
//Route::get('/F1_admin/race/edit/{id}', 'UsersController@edit')->name('race_edit');
//Route::post('/F1_admin/race/edit', 'UsersController@save_edit')->name('race_save_edit');
//Route::get('/F1_admin/race/delete/{id}', 'UsersController@race_activate')->name('race_activate');
Route::delete('/F1_admin/user/delete', 'UsersController@delete')->name('user_delete');
//PARTNERS
Route::get('/F1_admin/partners', 'PartnersController@partners')->name('partners');
Route::get('/F1_admin/partners/add', 'PartnersController@add')->name('partners_add');
Route::post('/F1_admin/partners/add', 'PartnersController@save_new')->name('partner_save_new');
Route::delete('/F1_admin/partners/delete', 'PartnersController@delete')->name('partner_delete');
Route::get('/F1_admin/partners/edit/{id}', 'PartnersController@edit')->name('partner_edit');
Route::post('/F1_admin/post/edit', 'PartnersController@save_edit')->name('partner_save_edit');
//COMPETITIONS
Route::get('/F1_admin/competitions', 'CompetitionsController@competitions')->name('competitions');
Route::delete('/F1_admin/competitions/delete', 'CompetitionsController@delete')->name('competition_delete');
Route::get('/F1_admin/competitions/edit/{id}', 'CompetitionsController@edit')->name('competition_edit');
Route::post('/F1_admin/competitions/edit', 'CompetitionsController@save_edit')->name('competition_save_edit');

Route::get('/404', function (){return view('Errors.404');})->name('404');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
