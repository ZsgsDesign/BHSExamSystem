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

Route::redirect('/home', '/', 301);

Route::get('/', 'MainController@home')->middleware('auth')->name('home');

Route::group(['prefix' => 'exam'], function () {
    Route::redirect('/', '/', 301);
    Route::get('/{cid}', 'ExamController@detail')->middleware('auth')->name('exam_detail');
});

Route::group(['prefix' => 'test'], function () {
    Route::redirect('/', '/', 301);
    Route::get('/{tid}', 'TestController@detail')->middleware('auth')->name('test_detail');
});

Auth::routes();
