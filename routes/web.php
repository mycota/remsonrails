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
Route::resource('/reciept', 'RecieptController');


Route::resource('/customers', 'CustomersController')->middleware('auth');
Route::resource('/products', 'ProductsController')->middleware('auth');
Route::resource('/auth/passwords', 'Auth\ChangePasswordController')->middleware(['auth']);
Route::resource('/transports', 'TransporterController')->middleware('auth');

Route::resource('/quotations', 'QuotationsController')->middleware('auth');

Route::get('/quotations/quot_gen/{id}/generatequot', 'QuotationsController@generatequot')->middleware('auth')->name('quotations.quot_gen.generatequot');

Route::post('/quotations/quot_gen/finalquotation', 'QuotationsController@finalquotation')->middleware('auth')->name('quotations.quot_gen.finalquotation');

Route::get('/quotations/quot_gen/{id}/finalquotationpdf', 'QuotationsController@finalquotationpdf')->middleware('auth')->name('quotations.quot_gen.finalquotationpdf');

Route::get('/quotations/quot_gen/downloadpdf/{id}', 'QuotationsController@downloadpdf')->middleware('auth')->name('quotations.quot_gen.downloadpdf');

Route::get('/quotations/quot_gen/prepared_quot', 'QuotationsController@prepared_quot')->middleware('auth')->name('quotations.quot_gen.prepared_quot');

Route::get('/quotations/quot_gen/{id}/rawquot', 'QuotationsController@rawquotation')->middleware('auth')->name('quotations.quot_gen.rawquot');

Route::resource('/pdfs', 'PDFControllers')->middleware('auth');
Route::resource('/glasstype', 'GlassTypeController')->middleware('auth');

Route::resource('/emails/account_verifi', 'EmailVerifyCreatePasswordController');

Route::get('/emails/account_verifi/{email}/{verifyToken}', 'EmailVerifyCreatePasswordController@emailverifybyuser')->name('emails.account_verifi.emailverifybyuser');


Route::get('/createpassword/{email}', 'EmailVerifyCreatePasswordController@show')->name('createpassword.show');
Route::post('/createpassword', 'EmailVerifyCreatePasswordController@store')->name('createpassword.store');

// Route::post('/auth', 'EmailVerifyCreatePasswordController@create')->name('auth.create');






