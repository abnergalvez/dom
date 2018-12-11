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
    return redirect()->route('first_map');
});

Auth::routes();
Route::get('/buscar_prc','PublicController@firstMap')->name('first_map');
Route::post('/buscar_prc','PublicController@searchMap')->name('seachmap');
Route::post('/rating_comment','PublicController@ratingComment')->name('rating_comment');
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function () {
        Route::resource('/poligons','PoligonController');
        Route::resource('/areas','AreaController');
        Route::resource('/comments','CommentController');
        Route::get('/account', 'HomeController@index')->name('home');
});


