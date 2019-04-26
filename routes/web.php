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

Route::get('/', function () {
    return view('welcome');
});

// Route::post('/subscribe',
// 	'mailchimpController@store')->name('subscribe');

Auth::routes();

Route::get('/home', 'ForumsController@index')->name('home');


Route::get('/discussion/view/{slug}','DiscussionsController@show')->name('discussion.show');

//social login routes
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('social.auth');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
//end social login routes


Route::group(['middleware'=>'auth'],function(){

	Route::resource('channels','ChannelsController');
	Route::get('/discussions','DiscussionsController@index')->name('discussion.index');

	Route::get('/discussion/create','DiscussionsController@create')->name('discussion.create');

	Route::post('/discussion/store','DiscussionsController@store')->name('discussion.store');

	Route::get('/discussion/edit/{slug}','DiscussionsController@edit')->name('discussion.edit');

	Route::post('/discussion/update/{slug}','DiscussionsController@update')->name('discussion.update');

	Route::post('/discussion/{d_id}/reply/store','RepliesController@store')->name('reply.store');

	Route::post('reply/{id}/like','RepliesController@like_unlike')->name('reply.like_unlike');

	Route::get('reply/{id}/delete',
		'RepliesController@delete')->name('reply.delete');

	Route::get('reply/{id}/edit',
		'RepliesController@edit')->name('reply.edit');

	Route::post('reply/{id}/update',
		'RepliesController@update')->name('reply.update');

	Route::get('reply/{id}/mark',
		'RepliesController@mark_as_best')->name('reply.mark');

	Route::get('/discussion/{id}/follow',
		'FollowersController@follow')->name('discussion.follow');

	Route::get('/discussion/{id}/unfollow',
		'FollowersController@unfollow')->name('discussion.unfollow');

















});