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



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
	
	Route::get('/', 'PagesController@home')->name('home');

	Route::get('search', 'PagesController@search')->name('search');

	Route::get('movie/{id}', 'MovieController@show')->name('movie.show');

	Route::get('movie/{id}/cast', 'MovieController@cast')->name('movie.cast');

	Route::get('movie/{id}/similar', 'MovieController@similar')->name('movie.similar');

	Route::put('movie/plan', 'MovieController@plan')->name('movie.plan');

	Route::put('movie/seen', 'MovieController@seen')->name('movie.seen');

	Route::get('tv/{id}', 'TvController@show')->name('tv.show');

	Route::get('tv/{id}/cast', 'TvController@cast')->name('tv.cast');

	Route::get('tv/{id}/similar', 'TvController@similar')->name('tv.similar');

	Route::get('tv/{id}/seasons', 'TvController@seasons')->name('tv.seasons');

	Route::get('tv/{id}/seasons/{seasonId}', 'TvController@season')->name('tv.season');

	Route::put('tv/plan', 'TvController@plan')->name('tv.plan');

	Route::put('tv/seen', 'TvController@seen')->name('tv.seen');

	Route::get('people/{id}', 'PeopleController@show')->name('people.show');

	Route::get('my/movies', 'PagesController@movies')->name('my.movies');

	Route::get('my/tv', 'PagesController@tv')->name('my.tv');

});


