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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function(){
  Route::prefix('user')->group(function(){
      Route::get('list','UserController@index')->name('user-list');
      Route::get('{id}','UserController@show');
  });
  Route::prefix('bill')->group(function(){
    Route::get('import-bill','BillController@show')->name('import-bill');
    Route::get('import-bill-data','BillController@importBill')->name('import-bill-data');
    
  });
  Route::prefix('product')->group(function(){
  	Route::get('list','ProductController@index')->name('product-list');
    Route::post('add','ProductController@store')->name('product-add');

  });
  Route::resource('product','ProductController')->except([
      'destroy','edit','show'
    ]);


});

///check login with api
Route::get('auth/{serve}','LoginApiController@redirectToProvider');
Route::get('auth/{serve}/callback','LoginApiController@handleProviderCallback');

// });
