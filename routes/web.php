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

// PAGES
Route::get('/', 'PagesController@index')->name('index');
Route::get('/rules/{key}', 'PagesController@rule')->name('rule');
Route::get('/posts', 'PagesController@posts')->name('posts');
Route::get('/post/{id}', 'PagesController@single_post')->name('single_post');
Route::post('/post/add_comment', 'PagesController@add_comment')->name('add_comment');

//////////// ADMIN PANEL ////////////
// PILOTS
Route::get('/F1_admin/pilots', 'PilotsController@pilots')->name('pilots');
Route::get('/F1_admin/pilots', 'PilotsController@pilots')->name('pilots');
Route::post('/F1_admin/add_pilot', 'PilotsController@add_pilot')->name('add_pilot');
Route::post('/F1_admin/edit_pilot', 'PilotsController@edit_pilot')->name('edit_pilot');
Route::delete('/F1_admin/pilots', 'PilotsController@delete')->name('delete_pilot');
// SOCIAL NETWORKS
Route::get('/F1_admin/social_networks', 'SocialNetworksController@social_networks')->name('social_networks');
Route::get('/F1_admin/social_networks/add', 'SocialNetworksController@add')->name('social_network_add');
Route::post('/F1_admin/social_networks/add', 'SocialNetworksController@save_new')->name('social_network_save_new');
Route::get('/F1_admin/social_networks/edit/{id}', 'SocialNetworksController@edit')->name('social_network_edit');
Route::post('/F1_admin/social_networks/edit_save', 'SocialNetworksController@save_edit')->name('social_network_save_edit');
Route::delete('/F1_admin/social_networks/delete', 'SocialNetworksController@delete')->name('social_network_delete');

Route::get('/404', function (){return view('Pages.404');})->name('404');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
