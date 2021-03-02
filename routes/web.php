<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|Route::get('login','LoginController@login')->name('login-view');
 */

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', 'LoginController@login')->name('login-view');
Route::post('login', 'LoginController@authenticate')->name('post-login');
Route::get('forgot-password', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.email');
Route::post('forgot-password', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

Route::get('reset-password/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('reset-pasword', 'Auth\ResetPasswordController@reset')->name('password.reset');

Route::get('home', 'LoginController@home')->name('home-view');
Route::get('signup', 'RegisterAccountController@signup')->name('signup');
Route::get('users', 'SignUpController@users');
Route::post('createUsers', 'RegisterAccountController@createaccount')->name('create-user');
// Route::post('createaccount','RegisterAccountController@createaccount')->name('create-account');
Route::group(['prefix' => 'onboarding', 'as' => 'onboarding.', 'middleware' => 'auth'], function () {
    Route::post('farmsetup', ['as' => 'farmsetup', 'uses' => 'FarmAccountController@createOrUpdateFarmAccount']);
    Route::post('penhouse', ['as' => 'penhouse', 'uses' => 'PenHouseController@createPenHouse']);
    Route::post('penhouseupdate', ['as' => 'penhouseupdate', 'uses' => 'PenHouseController@UpdatePenHouse']);
    Route::post('penhouse/delete', ['as' => 'penhousedelete', 'uses' => 'PenHouseController@deletePenHouse']);

    Route::post('stocking', ['as' => 'stocking', 'uses' => 'PenHouseStockingController@createOrUpdateStocking']);
    Route::post('stocking/delete/{id}', ['as' => 'updatestocking', 'uses' => 'PenHouseStockingController@updatePenHouseStocking']);
    Route::delete('stocking/delete/{id}', ['as' => 'deletestocking', 'uses' => 'PenHouseStockingController@deletePenhouseStocking']);

    Route::post('stockingupdate', ['as' => 'stockingupdate', 'uses' => 'PenHouseStockingController@editStocking']);

    Route::get('farmsetup', ['as' => 'farmsetup', 'uses' => 'FarmAccountController@farmSetUpView']);
    Route::get('penhouse', ['as' => 'penhouse', 'uses' => 'PenHouseController@penHouseView']);
    // Route::get('penhouse/{id?}', ['as' => 'penhouse', 'uses' => 'PenHouseController@penHouseViewUpdate']);
    Route::get('stocking', ['as' => 'stocking', 'uses' => 'PenHouseStockingController@penHouseStockingView']);

});

//Route::match(['get', 'put'], 'update/{id}', 'Crud5Controller@update');
Route::group(['prefix' => 'birds', 'as' => 'birds.', 'middleware' => 'auth'], function () {
    Route::get('penhouses', ['as' => 'penhouses', 'uses' => 'PenHouseController@dashPenHouseView']);
    Route::post('penhouses', ['as' => 'penhouses', 'uses' => 'PenHouseController@createDashPenHouse']);
    Route::get('stock', ['as' => 'stock', 'uses' => 'PenHouseStockingController@dashPenHouseStockingView']);
    Route::post('stocking', ['as' => 'stocking', 'uses' => 'PenHouseStockingController@createOrUpdateDashStocking']);
    Route::put('stocking/{id}', ['as' => 'updatestocking', 'uses' => 'PenHouseStockingController@updateDashStocking']);
    Route::get('cyclelist', ['as' => 'stocktracking', 'uses' => 'StockingTrackingController@stockTrackingView']);
    
    Route::get('mortality', ['as' => 'mortality', 'uses' => 'CullingDeadBirdsController@deadBirdsView']);
   
    Route::put('mortality/update/{id}', ['as' => 'updatemortality', 'uses' => 'CullingDeadBirdsController@deadBirdsUpdate']);
   
    Route::delete('mortality/delete/{id}', ['as' => 'deletemortality', 'uses' => 'CullingDeadBirdsController@deadBirdsDelete']);
   
    Route::post('mortality', ['as' => 'mortality', 'uses' => 'CullingDeadBirdsController@deadBirdsCreate']);
    
    Route::get('feedgiven', ['as' => 'feedgiven', 'uses' => 'FeedRecordController@feedRecordingView']);
    Route::post('givefeed', ['as' => 'recordfeed', 'uses' => 'FeedRecordController@createFeedRecording']);
    Route::put('givefeed/update/{id}', ['as' => 'updaterecordfeed', 'uses' => 'FeedRecordController@updateFeedRecording']);
    Route::delete('givefeed/delete/{id}', ['as' => 'deleterecordfeed', 'uses' => 'FeedRecordController@deleteFeedRecording']);
    
    Route::get('drugtaking', ['as' => 'druggiven', 'uses' => 'FarmDrugRecordingController@createDrugRecording']);
   
    Route::post('givedrug', ['as' => 'recorddrug', 'uses' => 'FarmDrugRecordingController@createDrugRecording']);
    Route::put('givedrug/update/{id}', ['as' => 'updatedrugrecord', 'uses' => 'FarmDrugRecordingController@updateFarmDrugRecording']);
    Route::delete('givedrug/delete/{id}', ['as' => 'deletedrugrecord', 'uses' => 'FarmDrugRecordingController@deleteFarmDrugRecording']);
    Route::get('feedwastage', ['as' => 'feedwastage', 'uses' => 'FarmWastageController@createWasteRecording']);
    Route::post('feedwastage', ['as' => 'feedwastage', 'uses' => 'FarmWastageController@createWasteRecording']);
    Route::put('feedwastage/update/{id}', ['as' => 'updatefeedwastage', 'uses' => 'FarmWastageController@updateWasteRecording']);
    Route::delete('feedwastage/delete/{id}', ['as' => 'deletefeedwastage', 'uses' => 'FarmWastageController@deleteWasteRecording']);

///DELETE MORTALITES

Route::post('/editCullingDeadBirds', ['as' => 'editCullingDeadBirds', 'uses' => 'CullingDeadBirdsController@editCullingDeadBirds']);
   

});

Route::get('vendor', ['as' => 'vendor', 'uses' => 'VendorController@rendorVendor']);
Route::post('vendor', ['as' => 'vendor', 'uses' => 'PenHouseStockingController@penHouseStockingView']);
Route::post('vendor/{id}', ['as' => 'vendor', 'uses' => 'PenHouseStockingController@penHouseStockingView']);

//account group routings

Route::group(['prefix' => 'account', 'as' => 'account.', 'middleware' => 'auth'], function () {

    Route::get('/farm-setup', ['as' => 'farmsetup', 'uses' => 'AccountController@farmsetup']);

    Route::get('/pen-house-creation', ['as' => 'penhouse', 'uses' => 'AccountController@penhouse']);

    Route::get('/stocking-setup', ['as' => 'stockingsetup', 'uses' => 'AccountController@stockingsetup']);

    //Check for the onboarding if done...

    Route::get('/dashboard', ['as' => 'index', 'uses' => 'AccountController@index'])->middleware('onboarding');;
    Route::get('settings', ['as' => 'settings', 'uses' => 'AccountController@index']);

    Route::get('registereggs', ['as' => 'forms', 'uses' => 'AccountController@forms']);

    Route::get('/billrecords', ['as' => 'viewbills', 'uses' => 'BillsController@viewBills']);
    Route::delete('/viewbilldetails/{id}', ['as' => 'deletebill', 'uses' => 'BillsController@deletebill']);

    Route::get('/viewbilldetails/{id}', ['as' => 'viewbilldetails', 'uses' => 'BillsController@billdetails']);
    Route::post('/viewbilldetails/{id}', ['as' => 'viewbilldetails', 'uses' => 'BillsController@updateBillsDetail']);
    Route::post('/viewbilldetails/items/delete/{id}', ['as' => 'deletebillitem', 'uses' => 'BillsController@deleteBillItem']);
    Route::post('/viewbilldetails/payment/delete/{id}', ['as' => 'deletebillpayment', 'uses' => 'FarmPayablePaymentController@deleteBillpayment']);
    Route::get('/createbillrecords', ['as' => 'createbills', 'uses' => 'BillsController@index']);
    Route::post('/createbillrecords', ['as' => 'createbills', 'uses' => 'BillsController@createBills']);
    Route::get('/billpayment', ['as' => 'billpayment', 'uses' => 'BillsController@index']);
    Route::post('/billpayment/{id?}', ['as' => 'billpayment', 'uses' => 'FarmPayablesController@makePayment']);

    Route::get('/items', ['as' => 'items', 'uses' => 'FarmItemsController@index']);
    Route::post('/createFarmItem', ['as' => 'createFarmItem', 'uses' => 'FarmItemsController@createFarmItem']);
    
   // Route::match(['get', 'post'], 'item/create', ['as' => 'itemcreate', 'uses' => 'FarmItemsController@createFarmItem']);
    Route::match(['get', 'post'], 'item/update/{id}', ['as' => 'itemupdate', 'uses' => 'FarmItemsController@updateFarmItem']);
    Route::delete('item/delete/{id}', ['as' => 'itemdelete', 'uses' => 'FarmItemsController@deleteFarmItem']);


    //human resource
    //employee
    Route::match(['get', 'post'], 'employee', ['as' => 'employee', 'uses' => 'EmployeeController@createEmployee']);
    Route::put('employee/{id}', ['as' => 'updateemployee', 'uses' => 'EmployeeController@updateEmployee']);
    Route::delete('employee/{id}', ['as' => 'deleteemployee', 'uses' => 'EmployeeController@deleteEmployee']);
    
    //Payroll
    Route::match(['get', 'post'], 'payroll', ['as' => 'payroll', 'uses' => 'PayrollController@createPayroll']);
    Route::put('payroll/{id}', ['as' => 'updatepayroll', 'uses' => 'PayrollController@updatePayroll']);
    Route::delete('payroll/{id}', ['as' => 'deletepayroll', 'uses' => 'PayrollController@deletePayroll']);



    Route::get('/billitems', ['as' => 'billitems', 'uses' => 'BillItemsController@index']);
   // Route::match(['get', 'post'], 'billitems/create', ['as' => 'billitemcreate', 'uses' => 'BillItemsController@createBillItem']);
    Route::post('/createBillItem', ['as' => 'createBillItem', 'uses' => 'BillItemsController@createBillItem']);
    
    Route::post('/createSaleItem', ['as' => 'createSaleItem', 'uses' => 'BillItemsController@createSaleItem']);
   
    Route::match(['get', 'post'], 'billitems/update/{id}', ['as' => 'billitemupdate', 'uses' => 'BillItemsController@updateBillItem']);
   // Route::delete('billitems/delete/{id}', ['as' => 'billitemdelete', 'uses' => 'BillItemsController@deleteBillItem']);

   
    Route::get('/vendors', ['as' => 'vendor', 'uses' => 'VendorController@rendorVendor']);

    Route::post('/vendors', ['as' => 'vendor', 'uses' => 'VendorController@createVendor']);
    Route::post('/collectEggs', ['as' => 'collectEggs', 'uses' => 'EggsController@collectEggs']);
    Route::post('/collectUpdatedEggs', ['as' => 'collectUpdatedEggs', 'uses' => 'EggsController@collectUpdatedEggs']);
   


  // Route::post('/collectEggs', ['as' => 'collectEggs', 'uses' => 'EggsController@collectEggs']);
  // Route::post('/collectUpdatedEggs', ['as' => 'collectUpdatedEggs', 'uses' => 'EggsController@collectUpdatedEggs']);
  // Route::get('/eggs', ['as' => 'eggs', 'uses' => 'EggsController@eggs']);
  // Route::get('/collectlist', ['as' => 'collectlist', 'uses' => 'EggsController@collecteggslist']);
   Route::delete('deleteCollection/{id}', ['as' => 'deleteCollection', 'uses' => 'EggsController@deleteCollection']);
  
   Route::delete('deleteStockingOnDashboard/delete/{id}', ['as' => 'deleteStockingOnDashboard', 'uses' => 'PenHouseStockingController@deleteStockingOnDashboard']);

   Route::get('/printMonthlyCollection', ['as' => 'printMonthlyCollection', 'uses' => 'EggsController@printMonthlyCollection']);
   //Route::get('/dashboardEggMetrics', ['as' => 'dashboardEggMetrics', 'uses' => 'EggsController@dashboardEggMetrics']);
  
    

    Route::get('/sales', ['as' => 'sales', 'uses' => 'SalesController@index']);
    Route::post('/sales/edit/{id}', ['as' => 'salesedit', 'uses' => 'SalesController@editsales']);
    Route::delete('/sales/delete/{id}', ['as' => 'salesdelete', 'uses' => 'SalesController@deleteSales']);
    Route::get('/sales/edit/{id}', ['as' => 'salesedit', 'uses' => 'SalesController@editsalesView']);
    Route::post('/sales/item/delete/{id}', ['as' => 'salesitemdelete', 'uses' => 'SalesController@deleteSaleItem']);
    Route::post('/sales/payment/delete/{id}', ['as' => 'salespaymentdelete', 'uses' => 'SalesController@deleteFarmPayment']);
    Route::post('/sales/payment/{id}', ['as' => 'salespayment', 'uses' => 'SalesController@addPaymentToSales']);

    Route::get('/customers', ['as' => 'customer', 'uses' => 'CustomerController@index']);
    Route::match(['get', 'post'], 'customer/update/{id}', ['as' => 'customerupdate', 'uses' => 'CustomerController@updateCustomer']);
    Route::match(['get', 'post'], 'customer/create', ['as' => 'customercreate', 'uses' => 'CustomerController@createCustomer']);
    Route::delete('customer/delete/{id}', ['as' => 'customerdelete', 'uses' => 'CustomerController@deleteCustomer']);

    Route::get('/products', ['as' => 'product', 'uses' => 'AccountController@product']);

    Route::get('/addinvoice', ['as' => 'addSales', 'uses' => 'SalesController@addSales']);
    Route::post('/addinvoice', ['as' => 'addSales', 'uses' => 'SalesController@createSales']);

    Route::get('/completed', ['as' => 'onboard_complete', 'uses' => 'AccountController@onboard_complete']);

    Route::get('/cyclelist', ['as' => 'cycle_list', 'uses' => 'AccountController@cycle_list']);

    Route::get('/drugs', ['as' => 'drugs', 'uses' => 'AccountController@drugs']);

    Route::get('/eggs', ['as' => 'eggs', 'uses' => 'EggsController@eggs']);
    Route::get('/eggMetrics', ['as' => 'eggMetrics', 'uses' => 'EggsController@eggMetrics']);
    Route::get('/collectlist', ['as' => 'collectlist', 'uses' => 'EggsController@collecteggslist']);

    Route::get('/feed', ['as' => 'feed', 'uses' => 'AccountController@feed']);

    Route::get('/mortality', ['as' => 'mortality', 'uses' => 'AccountController@mortality']);

   // Route::get('/drugtaking', ['as' => 'drugtaking', 'uses' => 'AccountController@drugtaking']);

    Route::get('/feedtaking', ['as' => 'feedtaking', 'uses' => 'AccountController@feedtaking']);

    // Route::get('/employee', ['as' => 'employee', 'uses' => 'AccountController@employee']);

    Route::get('/asset', ['as' => 'asset', 'uses' => 'AccountController@asset']);

    // Route::get('/payroll', ['as' => 'payroll', 'uses' => 'AccountController@payroll']);

    // Route::get('/stock', ['as' => 'stock', 'uses' => 'AccountController@stock']);

    // Route::get('/penhouse', ['as' => 'penhouse', 'uses' => 'AccountController@penhouse']);

    Route::get('logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);

    Route::get('registereggs', ['as' => 'forms', 'uses' => 'AccountController@forms']);

    //Route::get('logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);

    ///farmitems delete on product and services

    Route::delete('deleteBillItem2/delete/{id}', ['as' => 'deleteBillItem2', 'uses' => 'BillItemsController@deleteBillItem2']);



    ////Accounting rountes//profitandloss


    Route::get('/chartofaccountlist', ['as' => 'chartofaccountlist', 'uses' => 'ChartOfAccountsController@index']);
    Route::get('/journals', ['as' => 'journals', 'uses' => 'JournalController@index']);
    Route::get('/profitandloss', ['as' => 'profitandloss', 'uses' => 'ProfitAndLossController@index']);
    
    Route::get('/balancesheet', ['as' => 'balancesheet', 'uses' => 'BalanceSheetController@index']);
    Route::get('/trialbalance', ['as' => 'trialbalance', 'uses' => 'TrialBalanceController@index']);



    Route::post('/profitandloss', ['as' => 'profitandloss', 'uses' => 'ProfitAndLossController@ingetAllIncomeOfFarmFromJournalDateSelectdex']);
    Route::post('/createaccounts', ['as' => 'createaccounts', 'uses' => 'ChartOfAccountsController@createaccounts']);
    Route::post('/createjournals', ['as' => 'createjournals', 'uses' => 'JournalController@createjournals']);

});
