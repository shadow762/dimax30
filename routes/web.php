<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

$router->resource('clients', 'ClientsController');
$router->resource('orders', 'OrdersController');
$router->resource('types', 'TypesController');

Route::post('types/gettypes', ['as' => 'types.get', 'uses' => 'TypesController@getType']);
Route::post('brends/getbrend', ['as' => 'brends.get', 'uses' => 'BrendsController@getBrend']);
Route::post('models/getmodel', ['as' => 'models.get', 'uses' => 'ModelsController@getModels']);


Route::get('vue-brend', ['as' => 'brends.get', 'uses' => 'BrendsController@manageVue']);
$router->resource('brends', 'BrendsController');