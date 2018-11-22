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

/** Roles: 1 = admin, 2 = author, 3 = user */

Route::get('/', ['uses' => 'NewsController@index'])->name('home');

Route::group(['prefix' => 'news'], function () {

    // GET
    Route::get('/create', ['uses' => 'NewsController@create'])->name('news.create');
    Route::get('/manage', ['uses' => 'NewsController@manage'])->name('news.manage');
    Route::get('/delete/{id}', ['uses' => 'NewsController@destroy'])->name('news.destroy');
    Route::get('/edit/{id}', ['uses' => 'NewsController@edit'])->name('news.edit');

    // POST
    Route::post('/', ['uses' => 'NewsController@store'])->name('news.store');
    Route::post('/{id}', ['uses' => 'NewsController@update'])->name('news.update');


});

Route::group(['prefix' => 'vue'], function () {
    Route::group(['prefix' => 'news'], function () {
        Route::get('/', function () {
            return view('news_vue.index');
        })->name('vue.news.create');
    });
});

Auth::routes();
// Route::get('/login', ['uses' => 'Auth\LoginController@showLoginForm'])->name('login');
Route::get('/home', 'HomeController@index')->name('home');
