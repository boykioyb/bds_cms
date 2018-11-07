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
Route::get('/docs', function () {
    return view('docs');
});
Route::get('/', function () {
    return view('home.index');
});

Route::group(['prefix' => 'sliders'], function () {
    Route::get('/','SliderController@index')->name('sliders');
    Route::get('/add','SliderController@add')->name('sliders.add');
    Route::post('/add','SliderController@add')->name('sliders.add.post');
    Route::get('edit/{id}','SliderController@edit')->name('sliders.edit');
});
Route::get('abc/add','SliderController@add')->name('abc.add');
