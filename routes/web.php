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

Route::get('orders-panel', ['as' => 'orders.panel', 'uses' => 'OrdersController@getPage']);
//$router->resource('orders', 'OrdersController');


$router->resource('types', 'TypesController');

/**orders**/
Route::get('orders', ['as' => 'orders.get', 'uses' => 'OrdersController@index']);
Route::post('orders', ['as' => 'orders.store', 'uses' => 'OrdersController@store']);
Route::post('orders/update', ['as' => 'orders.update', 'uses' => 'OrdersController@update']);
Route::get('api/json/getorder/{id}', ['as' => 'order.get', 'uses' => 'OrdersController@getOrder']);

/**other**/
Route::post('getstatuses', ['as' => 'statuses.get', 'uses' => 'StatusesController@getStatuses']);
Route::post('getdevicetypes', ['as' => 'types.get', 'uses' => 'TypesController@getTypes']);
Route::post('getdevicebrends', ['as' => 'brends.get', 'uses' => 'BrendsController@getBrends']);
Route::post('getdevicemodels', ['as' => 'models.get', 'uses' => 'ModelsController@getModels']);
Route::post('getclients', ['as' => 'clients.get', 'uses' => 'ClientsController@getClients']);
Route::post('getparts', ['as' => 'parts.get', 'uses' => 'PartsController@getParts']);
Route::post('getservices', ['as' => 'services.get', 'uses' => 'ServicesController@getServices']);


Route::get('vue-brend', ['as' => 'brends.get', 'uses' => 'BrendsController@manageVue']);
$router->resource('brends', 'BrendsController');
$router->resource('models', 'ModelsController');