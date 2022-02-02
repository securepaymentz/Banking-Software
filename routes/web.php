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


Route::group(['middleware' => ['install']], function () {	
	
	//Frontend Route
	Route::get('/', function () {
		return redirect('login');
	});
	
	Auth::routes(['verify' => true]);
	
	Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

	//Pay Now Screen
	Route::get('payment_request/{id}','PaymentRequestController@view_payment_request');
	
	Route::group(['middleware' => ['auth','verified']], function () {
		
		Route::get('/dashboard', 'DashboardController@index');
        
		//Profile Controller
		Route::get('profile/edit', 'ProfileController@edit');
		Route::post('profile/update', 'ProfileController@update');
		Route::get('profile/change_password', 'ProfileController@change_password');
		Route::post('profile/update_password', 'ProfileController@update_password');

        //Get Account By User ID
		Route::get('admin/accounts/get_by_user_id/{user_id}','AccountController@get_by_user_id');
			
		//Get Account By Account Type
		Route::get('admin/accounts/get_by_account_type/{account_type}','AccountController@get_by_account_type');
		
		
		//Admin Only Routes
		Route::group(['middleware' => ['permission:admin,manager'], 'prefix'=> 'admin'], function () {
			
			//User Controller
			Route::get('users/status/{account_status}','UserController@index');
			Route::resource('users','UserController');


			//Account Controller
			Route::resource('accounts','AccountController');

			//Card Controller
			Route::resource('cards','CardController');

			//Card Transactions
			Route::resource('card_transactions','CardTransactionController');
			
			//Deposit Controller
			Route::get('deposit/request/{status?}/{id?}/{action?}','DepositController@deposit_request');
			Route::resource('deposit','DepositController');
			
			//Withdraw Controller
			Route::resource('withdraw','WithdrawController');
			
			//Report Controller
			Route::match(['get', 'post'],'reports/transactions_report/{view?}', 'ReportController@transactions_report');
		});

        //Admin Only Route
		Route::group(['middleware' => ['admin'], 'prefix'=> 'admin'], function () {
				
			//Account Type Controller
			Route::resource('account_types','AccountTypeController');

			//Card Type Controller
			Route::resource('card_types','CardTypeController');

			//Currency Controller
			Route::resource('currency','CurrencyController');

			//Utility Controller
			Route::match(['get', 'post'],'administration/general_settings/{store?}', 'UtilityController@settings')->name('general_settings.update');
			Route::post('administration/upload_logo', 'UtilityController@upload_logo')->name('general_settings.update_logo');
			Route::get('administration/backup_database', 'UtilityController@backup_database')->name('utility.backup_database');

		});
		
		//User Only Route
		Route::group(['middleware' => ['user'], 'prefix'=> 'user'], function () {

			//Client Overview
			Route::get('overview','ClientController@overview');
			
			//Submit Documents
			Route::match(['get', 'post'], 'submit_documents', 'ClientController@submit_documents');

						
            //Transfer Between Accounts
			Route::match(['get', 'post'], 'transfer_between_accounts', 'ClientController@transfer_between_accounts');

			//Transfer Between Users
			Route::match(['get', 'post'], 'transfer_between_users', 'ClientController@transfer_between_users');

			//Card Funding Transfer
			Route::match(['get', 'post'], 'card_funding_transfer', 'ClientController@card_funding_transfer');

			//Outgoing Wire Transfer
			Route::match(['get', 'post'], 'outgoing_wire_transfer', 'ClientController@outgoing_wire_transfer');

			//View Account Details
			Route::get('accounts/{id}','ClientController@view_account_details');

			//View Transaction Details
			Route::get('view_transaction/{id}','ClientController@view_transaction');


			//Client Report Controller
			Route::match(['get', 'post'],'reports/all_transaction/{view?}', 'ClientReportController@all_transaction');
			
		});

	});
	
});


//JSON data for dashboard chart
Route::get('dashboard/json_month_wise_deposit','DashboardController@json_month_wise_deposit')->middleware('auth');
Route::get('dashboard/json_month_wise_withdraw','DashboardController@json_month_wise_withdraw')->middleware('auth');

//Update System
Route::get('migration/update', 'Install\UpdateController@update_migration');


Route::get('/installation', 'Install\InstallController@index');
Route::get('install/database', 'Install\InstallController@database');
Route::post('install/process_install', 'Install\InstallController@process_install');
Route::get('install/create_user', 'Install\InstallController@create_user');
Route::post('install/store_user', 'Install\InstallController@store_user');
Route::get('install/system_settings', 'Install\InstallController@system_settings');
Route::post('install/finish', 'Install\InstallController@final_touch');