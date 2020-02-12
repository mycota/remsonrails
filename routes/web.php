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

Route::get('/', function () {return view('auth.login'); });

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');


Route::namespace('Admin')->prefix('admin')->middleware(['auth', 'auth.admin'])->name('admin.')->group(function(){
	
	Route::resource('/users', 'UserController', ['except'=>['create', 'show', 'updateprofile']]);
	Route::resource('/logs', 'LogsController');
	Route::resource('/roles_status', 'RolesStatusController');
});

Route::resource('/profile', 'UserProfileController')->middleware('auth');


Route::resource('/customers', 'CustomersController')->middleware('auth');
Route::resource('/products', 'ProductsController')->middleware('auth');
Route::resource('/auth/passwords', 'Auth\ChangePasswordController')->middleware(['auth']);
Route::resource('/transports', 'TransporterController')->middleware('auth');

Route::resource('/emails/account_verifi', 'EmailVerifyCreatePasswordController');

Route::get('/emails/account_verifi/{email}/{verifyToken}', 'EmailVerifyCreatePasswordController@emailverifybyuser')->name('emails.account_verifi.emailverifybyuser');


Route::get('/createpassword/{email}', 'EmailVerifyCreatePasswordController@show')->name('createpassword.show');
Route::post('/createpassword', 'EmailVerifyCreatePasswordController@store')->name('createpassword.store');

// Route::post('/auth', 'EmailVerifyCreatePasswordController@create')->name('auth.create');






