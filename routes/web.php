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
    Route::post('edit/{id}','SliderController@edit')->name('sliders.edit.post');
    Route::get('dataTables','SliderController@dataTable')->name('sliders.dataTable');
});

Route::group(['prefix' => 'investors'], function () {
    Route::get('/','InvestorController@index')->name('investors');
    Route::get('/add','InvestorController@add')->name('investors.add');
    Route::post('/add','InvestorController@add')->name('investors.add.post');
    Route::get('edit/{id}','InvestorController@edit')->name('investors.edit');
    Route::post('edit/{id}','InvestorController@edit')->name('investors.edit.post');
    Route::get('dataTables','InvestorController@dataTable')->name('investors.dataTable');
});


Route::group(['prefix' => 'project-sales'], function () {
    Route::get('/','ProjectSaleController@index')->name('project-sales');
    Route::get('/add','ProjectSaleController@add')->name('project-sales.add');
    Route::post('/add','ProjectSaleController@add')->name('project-sales.add.post');
    Route::get('edit/{id}','ProjectSaleController@edit')->name('project-sales.edit');
    Route::post('edit/{id}','ProjectSaleController@edit')->name('project-sales.edit.post');
    Route::get('dataTables','ProjectSaleController@dataTable')->name('project-sales.dataTable');
    Route::post('getDistrict','ProjectSaleController@getDistrict')->name('project-sales.getDistrict');
});

Route::group(['prefix' => 'properties'], function () {
    Route::get('/','PropertyController@index')->name('properties');
    Route::get('/add','PropertyController@add')->name('properties.add');
    Route::post('/add','PropertyController@add')->name('properties.add.post');
    Route::get('edit/{id}','PropertyController@edit')->name('properties.edit');
    Route::post('edit/{id}','PropertyController@edit')->name('properties.edit.post');
    Route::get('dataTables','PropertyController@dataTable')->name('properties.dataTable');
    Route::post('getDistrict','PropertyController@getDistrict')->name('properties.getDistrict');
});

Route::group(['prefix' => 'cities'], function () {
    Route::get('/','CityController@index')->name('cities');
    Route::get('/add','CityController@add')->name('cities.add');
    Route::post('/add','CityController@add')->name('cities.add.post');
    Route::get('edit/{id}','CityController@edit')->name('cities.edit');
    Route::post('edit/{id}','CityController@edit')->name('cities.edit.post');
    Route::get('dataTables','CityController@dataTable')->name('cities.dataTable');
    Route::get('generate','CityController@generate')->name('cities.generate');
});

Route::get('test',function (){
    return view('test');
});
