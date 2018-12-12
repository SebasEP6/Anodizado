<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['middleware' => 'auth'], function () {

	/*
	* Admin...
	*/

	Route::get('cambio-de-proceso/{name}', [
		'uses' => 'AdminController@process',
		'as'   => 'chng'
	]);

	Route::get('administrar/reglas', [
		'uses' => 'AdminController@rules',
		'as'   => 'rules'
	]);

	Route::get('administrar/reglas/{id}', [
		'uses' => 'AdminController@edRules',
		'as'   => 'chngRule'
	]);

	Route::post('administrar/reglas/{id}', 'AdminController@postEdRules');

	Route::get('{process}/generar/reporte', [
		'uses' => 'AdminController@makeRepo',
		'as'   => 'repo'
	]);

	Route::post('{process}/generar/reporte', 'AdminController@postMakeRepo');

	/*
	* Views...
	*/

	Route::get('{process}/materiales', [
		'uses' => 'StorageController@matView',
		'as'  => 'mp'
	]);

	Route::get('{process}/perfiles', [
		'uses' => 'StorageController@alumView',
		'as'  => 'al'
	]);

	Route::get('{process}/ordenes/produccion', [
		'uses' => 'OrdersController@prodView',
		'as'   => 'op'
	]);

	Route::get('{process}/ordenes/produccion-parcial', [
		'uses' => 'OrdersController@partView',
		'as'   => 'pp'
	]);

	Route::get('{process}/movimientos/{type}', [
		'uses' => 'PutsController@view',
		'as'   => 'put'
	]);

	Route::get('{process}/movimientos/entradas-consumos/insumos', [
		'uses' => 'SuppliesController@view',
		'as'   => 'sn'
	]);

	Route::get('{process}/indices/{i?}', [
		'uses' => 'SuppliesController@index',
		'as'   => 'index'
	]);

	Route::post('{process}/indices/{i?}', 'SuppliesController@viewIndex');

	/*
	* Registers...
	*/

	Route::get('{process}/nuevo-movimiento/{type}/{list?}', [
		'uses' => 'PutsController@register',
		'as'   => 'regPut'
	]);

	Route::post('{process}/nuevo-movimiento/{type}/{list?}', 'PutsController@postRegister');

	Route::get('{process}/nueva-orden/produccion/{list?}', [
		'uses' => 'OrdersController@prodRegister',
		'as'   => 'ro'
	]);

	Route::post('{process}/nueva-orden/produccion/{list?}', 'OrdersController@postProdRegister');

	Route::get('{process}/nueva-nota/produccion-parcial/{list?}', [
		'uses' => 'OrdersController@partRegister',
		'as'   => 'regPart'
	]);

	Route::post('{process}/nueva-nota/produccion-parcial/{list?}', 'OrdersController@postPartRegister');

	Route::get('{process}/nueva-nota/insumo/{type}/{list?}', [
		'uses' => 'SuppliesController@regSuppliesNote',
		'as'   => 'regSup'
	]);

	Route::post('{process}/nueva-nota/insumo/{type}/{list?}', 'SuppliesController@postRegSuppliesNote');

	Route::get('{process}/insumo/transferencia', [
		'uses' => 'StorageController@mkTransfer',
		'as'   => 'transfer'
	]);

	Route::post('{process}/insumo/transferencia', 'StorageController@postMkTransfer');

	/*
	* Add..
	*/

	Route::post('nuevo-cliente', [
		'uses' => 'ClientsController@add',
		'as'   => 'nc'
	]);

	Route::post('nuevo-perfil', [
		'uses' => 'AdminController@addAlItem',
		'as'   => 'np'
	]);

	Route::post('nuevo-insumo', [
		'uses' => 'AdminController@addSupply',
		'as'   => 'ns'
	]);

	Route::get('nueva-regla/insumo/{i}', [
		'uses' => 'AdminController@addRule',
		'as'   => 'nr'
	]);

	Route::post('nueva-regla/insumo/{i}', 'AdminController@postAddRule');

	Route::post('nuevo-grupo', [
		'uses' => 'StorageController@newGroup',
		'as'   => 'newGroup'
	]);

	Route::post('nuevo-color', [
		'uses' => 'StorageController@newColor',
		'as'   => 'newColor'
	]);

	route::get('nueva-regla/color/{i}', [
		'uses' => 'AdminController@addColorRule',
		'as'   => 'newCRule'
	]);

	Route::post('nueva-regla/color/{i}', 'AdminController@postAddColorRule');

	/*
	* Edits...
	*/

	Route::get('{process}/materiales/modificar', [
		'uses' => 'StorageController@editSupply',
		'as'   => 'edSup'
	]);

	Route::post('{process}/materiales/modificar', 'StorageController@postEditSupply');

	Route::get('{process}/perfiles/modificar', [
		'uses' => 'StorageController@editAlum',
		'as'   => 'edAlum'
	]);

	Route::post('{process}/perfiles/modificar', 'StorageController@postEditAlum');

	Route::get('{process}/perfiles/grupos/modificar/{i?}', [
		'uses' => 'StorageController@edGroup',
		'as'   => 'edGroup'
	]);

	Route::post('{process}/perfiles/grupos/modificar/{i?}', 'StorageController@postEditGroup');

	Route::get('{process}/colores/{i?}', [
		'uses' => 'StorageController@editColor',
		'as'   => 'edColor'
	]);

	Route::post('{process}/colores/{i?}', 'StorageController@postEditColor');

	/*
	* Deletes...
	*/

});

// Authentication routes...
Route::get('/', [
	'uses' => 'Auth\AuthController@getLogin',
	'as'   => 'login'
]);
Route::post('/', 'Auth\AuthController@postLogin');
Route::get('cerrar-sesion', [
	'uses' => 'Auth\AuthController@getLogout',
	'as'   => 'logout'
]);

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
