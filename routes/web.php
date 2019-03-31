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

Route::group(['prefix' => 'coordinator'], function () {
	Route::group(['prefix' => 'vehicle'], function () {
		Route::get('/', function () {
			return view('welcome');
		});
		Route::get('routes', function(\Illuminate\Http\Request $request){
			dd($request->route()->getPrefix());
		});
	});
});

Route::get('routes', function() {
	dd(Route::getRoutes() );
	foreach (Route::getRoutes() as $route) {
		dd($route);
		$compiled = $route->getCompiled();
		if(!is_null($compiled))
		{
			var_dump($compiled->getStaticPrefix());
			break;
		}
	}
});

Route::group(['prefix' => 'passengers'], function () {
	Route::get('all', function () {
		return view('welcome');
	});
	Route::get('create', function () {
		return view('welcome');
	});
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/role/{id}', 'HomeController@role')->name('role');
Route::post('/access', 'HomeController@store')->name('access_store');
