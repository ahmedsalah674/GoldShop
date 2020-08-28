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

Route::get('/',function(){return redirect()->route('home');})->middleware('destroy');
Route::get('/home','HomeController@index')->middleware('destroy')->name('home');
//Buy
Route::get('/buy/form','Buy\BuyController@buyform')->name('buy.form');
Route::post('/buy/form','Buy\BuyController@storebuy')->name('store.buy');
Route::get('/display/daily/buy','Buy\BuyController@displaydaily')->name('display.daily.buy');
Route::get('/edit/buy/{id}','Buy\BuyController@editbuy')->name('edit.buy');
Route::post('/update/buy','Buy\BuyController@updatebuy')->name('update.buy');
Route::get('/display/buy/{id}','Buy\BuyController@display')->name('display.buy');
Route::post('/destroy/buys','Buy\BuyController@destroy')->name('destroy.buy');
//Sales
Route::get('/sales/form','Sales\SalesController@salesform')->name('sales.form');
Route::post('/sales/form','Sales\SalesController@storesales')->name('store.sales');
Route::get('/edit/sales/{id}','Sales\SalesController@editsales')->name('edit.sales');
Route::post('/update/sales','Sales\SalesController@updatesales')->name('update.sales');
Route::get('/display/daliy/sales','Sales\SalesController@displaydaily')->name('display.daily.sales');
Route::get('/display/sales/{id}','Sales\SalesController@display')->name('display.sales');
Route::post('/destroy/sales','Sales\SalesController@destroy')->name('destroy.sales');
//dealers
Route::get('/dealers/buy','Dealers\DealersController@newQuantity')->name('new.quantity');
Route::post('/dealers/buy','Dealers\DealersController@storeQuantity')->name('store.quantity');
Route::get('/dealers/all','Dealers\DealersController@allDealers')->name('all.dealer');
Route::post('/dealers/new','Dealers\DealersController@storeDealer')->name('store.dealer');
Route::get('/dealers/display/{id}','Dealers\DealersController@displayDealer')->name('display.dealer');
Route::post('/dealers/update','Dealers\DealersController@updateDealer')->name('update.dealer');

//dealer quntitiy and Premium
Route::get('/dealers/Premiums/{id}','Dealers\DealersController@displayPremiums')->name('display.Premiums');
Route::post('/dealers/Premiums/store','Dealers\DealersController@storePremiums')->name('store.Premiums');

//days
Route::post('/update/stay','HomeController@updatestay')->name('update.stay');

//premiums
Route::get('/premiums/page','Sales\SalesController@allpremiumspage')->name('premiums.page');
Route::post('/premiums/add','Sales\SalesController@addPraimare')->name('premare.add');
Route::get('/premiums/daily','Sales\SalesController@dailyPremiums')->name('Premiums.daily');
Route::post('/premiums/destroy','Sales\SalesController@destoyPremiums')->name('Premiums.destroy');
Route::post('/premiums/update','Sales\SalesController@updatePremiums')->name('Premiums.update');



