<?php

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


use App\Episode;

Auth::routes();

Route::get('/', array(
    'as' => 'home',
    'uses' => 'HomeController@index'
));


//Videos controller routes

Route::get('/create-episode', array(
    'as' => 'createEpisode',
    'middleware' => 'auth',
    'uses' => 'EpisodeController@createEpisode'
));

Route::post('/save-episode', array(
    'as' => 'saveEpisode',
    'middleware' => 'auth',
    'uses' => 'EpisodeController@store'
));

Route::get('/episode/{episode_id}',array(
    'as'=>'detailEpisode',
    'uses' =>'EpisodeController@getEpisodeDetail'
));


Route::get('/edit-episode/{episode_id}', array(
    'as' => 'episodeEdit',
    'middleware' => 'auth',
    'uses' => 'EpisodeController@edit'

));

Route::post('/update-episode/{episode_id}', array(
    'as' => 'updateEpisode',
    'middleware' => 'auth',
    'uses' => 'EpisodeController@update'

));

Route::get('/delete-episode/{episode_id}', array(
    'as' => 'episodeDelete',
    'middleware' => 'auth',
    'uses' => 'EpisodeController@delete'
));

//Cache

Route::get('/clear-cache', function(){
    $code = Artisan::call('cache:clear');
});