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

use App\Logs;
use App\Notifications\NotifyUsers;
use App\QuotationOrder;
use App\User;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {return view('auth.login'); });

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');


Route::namespace('Admin')->prefix('admin')->middleware(['auth', 'auth.admin'])->name('admin.')->group(function(){

	Route::resource('/users', 'UserController', ['except'=>[]]);
	Route::resource('/logs', 'LogsController');
	Route::resource('/roles_status', 'RolesStatusController');
});

Route::resource('/profile', 'UserProfileController')->middleware('auth');
Route::resource('/reciept', 'RecieptController');


Route::resource('/customers', 'CustomersController')->middleware('auth');
Route::resource('/products', 'ProductsController')->middleware('auth');
Route::resource('/auth/passwords', 'Auth\ChangePasswordController')->middleware(['auth']);
Route::resource('/transports', 'TransporterController')->middleware(['auth']);

Route::resource('/quotations', 'QuotationsController')->middleware('auth');
Route::get('/markAsRead', function (){ auth()->user()->unreadNotifications->markAsRead();});

Route::get('modals', function () { // for texting the notification
    $allAdmins = array();
    $users = User::all();
    foreach ($users as $user) {
        if (implode(', ', $user->roles()->get()->pluck('name')->toArray()) === 'Admin') {
            $allAdmins[] = $user->id;
        }
    }

    $usrs = User::whereIn('id', $allAdmins)->get();

    if (\Notification::send($usrs, new NotifyUsers(QuotationOrder::find(7)))){
        return back();
}
});

Route::get('/quotations/quot_gen/{id}/generatequot', 'QuotationsController@generatequot')->middleware('auth')->name('quotations.quot_gen.generatequot');

Route::post('/quotations/quot_gen/finalquotation', 'QuotationsController@finalquotation')->middleware('auth')->name('quotations.quot_gen.finalquotation');

Route::get('/quotations/quot_gen/{id}/finalquotationpdf', 'QuotationsController@finalquotationpdf')->middleware('auth')->name('quotations.quot_gen.finalquotationpdf');

Route::get('/quotations/quot_gen/downloadpdf/{id}', 'QuotationsController@downloadpdf')->middleware('auth')->name('quotations.quot_gen.downloadpdf');

Route::get('/quotations/quot_gen/prepared_quot', 'QuotationsController@prepared_quot')->middleware('auth')->name('quotations.quot_gen.prepared_quot');

Route::get('/quotations/quot_gen/{id}/rawquot', 'QuotationsController@rawquotation')->middleware('auth')->name('quotations.quot_gen.rawquot');

Route::any('/quotations/quot_gen/pending_quot', 'QuotationsController@pending_quot')->middleware('auth')->name('quotations.quot_gen.pending_quot');
Route::get('/quotations/quot_gen/confirmed_quot', 'QuotationsController@confirmed_quot')->middleware('auth')->name('quotations.quot_gen.confirmed_quot');

Route::get('/quotations/quot_gen/{id}/', 'QuotationsController@confirm')->middleware('auth')->name('quotations.quot_gen.confirm');

Route::get('/quotations/quot_gen/{id}/add_transporter', 'QuotationsController@add_transporter')->middleware('auth')->name('quotations.quot_gen.add_transporter');
Route::post('/quotations/quot_gen/store_trans_quot', 'QuotationsController@store_trans_quot')->middleware('auth')->name('quotations.quot_gen.store_trans_quot');
Route::any('/quotations/trans/transported_quot', 'QuotationsController@transported_quot')->middleware('auth')->name('quotations.trans.transported_quot');

Route::resource('/reports', 'ReportsController')->middleware('auth');

Route::get('/reports/pdf/{id}', 'ReportsController@generatePDF')->middleware('auth')->name('reports.pdf.generatePDF');


Route::resource('/pdfs', 'PDFControllers')->middleware('auth');
Route::resource('/glasstype', 'GlassTypeController')->middleware('auth');

Route::resource('/emails/account_verifi', 'EmailVerifyCreatePasswordController');

Route::get('/emails/account_verifi/{email}/{verifyToken}', 'EmailVerifyCreatePasswordController@emailverifybyuser')->name('emails.account_verifi.emailverifybyuser');


Route::get('/createpassword/{email}', 'EmailVerifyCreatePasswordController@show')->name('createpassword.show');
Route::post('/createpassword', 'EmailVerifyCreatePasswordController@store')->name('createpassword.store');

// Route::post('/auth', 'EmailVerifyCreatePasswordController@create')->name('auth.create');






