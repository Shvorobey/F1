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

Route::get('/', 'PagesController@index')->name('index');
Route::get('/rules/{key}', 'PagesController@rule')->name('rule');

//////////// ADMIN PANEL ////////////
// PILOTS
Route::get('/F1_admin/pilots', 'PilotsController@pilots')->name('pilots');
Route::get('/F1_admin/pilots', 'PilotsController@pilots')->name('pilots');
Route::post('/F1_admin/add_pilot', 'PilotsController@add_pilot')->name('add_pilot');
Route::post('/F1_admin/edit_pilot', 'PilotsController@edit_pilot')->name('edit_pilot');
Route::delete('/F1_admin/pilots', 'PilotsController@delete')->name('delete_pilot');
// SOCIAL NETWORKS
Route::get('/F1_admin/social_networks', 'SocialNetworksController@social_networks')->name('social_networks');
//Route::get('/F1_admin/social_networks', 'SocialNetworksController@pilots')->name('social_network');
//Route::post('/F1_admin/social_networks', 'SocialNetworksController@add_pilot')->name('add_pilot');
//Route::post('/F1_admin/social_networks', 'SocialNetworksController@edit_pilot')->name('edit_pilot');
//Route::delete('/F1_admin/social_networks', 'SocialNetworksController@delete')->name('delete_pilot');

Route::get('/404', function (){return view('Pages.404');})->name('404');
