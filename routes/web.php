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
Route::get('/buyform','Buy\BuyController@buyform')->name('buyform');
Route::post('/buyform','Buy\BuyController@storebuy')->name('storebuy');
Route::get('/displaydailybuy','Buy\BuyController@displaydaily')->name('displaydailybuy');
Route::post('/editbuy','Buy\BuyController@editbuy')->name('editbuy');
Route::post('/updatebuy','Buy\BuyController@updatebuy')->name('updatebuy');
Route::post('/displaybuy','Buy\BuyController@display')->name('displaybuy');
//Sales
Route::get('/salesform','Sales\SalesController@salesform')->name('salesform');
Route::post('/salesform','Sales\SalesController@storesales')->name('storesales');
Route::post('/editsales','Sales\SalesController@editsales')->name('editsales');
Route::post('/updatebuy','Buy\BuyController@updatebuy')->name('updatebuy');
Route::get('/displaydaliysales','Sales\SalesController@displaydaily')->name('displaydailysales');
Route::post('/displaysales','Sales\SalesController@display')->name('displaysales');




