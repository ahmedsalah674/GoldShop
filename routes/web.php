<?php

use Illuminate\Support\Facades\Route;

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
Auth::routes(['register'=>false]);
// Route::get('/', function () {
//     return view('welcome');
// });
//home
Route::get('/',function(){return redirect()->route('home');});
Route::get('/home','HomeController@index')->name('home');
//Buy
Route::get('/buy/form','Buy\BuyController@buyform')->name('buy.form');
Route::post('/buy/form','Buy\BuyController@storebuy')->name('store.buy');
Route::get('/display/daily/buy','Buy\BuyController@displaydaily')->name('display.daily.buy');
Route::post('/edit/buy','Buy\BuyController@editbuy')->name('edit.buy');
Route::post('/update/buy','Buy\BuyController@updatebuy')->name('update.buy');
Route::post('/display/buy','Buy\BuyController@display')->name('display.buy');
//Sales
Route::get('/sales/form','Sales\SalesController@salesform')->name('sales.form');
Route::post('/sales/form','Sales\SalesController@storesales')->name('store.sales');
Route::post('/edit/sales','Sales\SalesController@editsales')->name('edit.sales');
Route::post('/update/sales','Sales\SalesController@updatesales')->name('update.sales');
Route::get('/display/daliy/sales','Sales\SalesController@displaydaily')->name('display.daily.sales');
Route::get('/display/sales/{id}','Sales\SalesController@display')->name('display.sales');
//dealers
Route::get('/dealers/buy','Dealers\DealersController@buyform')->name('new.quantity');
Route::post('/dealers/buy','Dealers\DealersController@store')->name('store.quantity');

//days
Route::post('/update/stay','HomeController@updatestay')->name('update.stay');

//premiums
Route::get('/premiums/page','Sales\SalesController@allpremiumspage')->name('premiums.page');
Route::post('/premiums/add','Sales\SalesController@addPraimare')->name('premare.add');

//
Route::get('/test','HomeController@test')->name('test');
Route::post('/test','HomeController@test2')->name('test2');
//


