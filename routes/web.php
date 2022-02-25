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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/',   'FrontendController@index');
Route::get('admin/login','FrontendController@adminlogin')->name('Admin-Login');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    Route::get('/home','AdminController@index')->name('Admin_Dashboard');
    Route::get('/profile','AdminController@myProfile')->name('My-Profile');
    Route::post('/update/profile','AdminController@updateProfile');
    Route::get('change/password','AdminController@changePassword');
    Route::post('update/password','AdminController@updatePassword');
    Route::get('branches','AdminController@listBranches')->name('Branches');
    Route::get('create/branch/details','AdminController@addBranchDetails');
    Route::post('save/branch_details','AdminController@SaveBranchDetails');
    Route::get('create/branch/order/settings/{id}','AdminController@addBranchOrderSettings')->name('branch_order_setting');
    Route::post('save/branch_ordersettings','AdminController@SaveBranchOrderSettings');
    Route::get('create/branch/working/hours/{id}','AdminController@addBranchWorkingHours')->name('branch_working_hours');
    Route::post('save/branch/workinghours','AdminController@SaveBranchWorkingHours');
    Route::get('create/branch/location/{id}','AdminController@addBranchLocation')->name('branch_location');
    Route::post('save/branch_location','AdminController@SaveBranchLocation');
    Route::get('edit/branch/details/{id}','AdminController@editBranchDetails')->name('Edit-Branch-Details');
    Route::post('update/branch/details','AdminController@UpdateBranchDetails');
    Route::get('edit/branch/ordersettings/{id}','AdminController@editBranchOrderSettings')->name('Edit-Branch-Ordersettings');
    Route::post('update/branch/ordersettings','AdminController@UpdateBranchOrderSettings');
    Route::get('edit/branch/working/hours/{id}','AdminController@editBranchWorkingHours')->name('Edit-Branch-Working-Hours');
    Route::post('update/branch/workinghours','AdminController@UpdateBranchWorkingHours');
    Route::get('edit/branch/location/{id}','AdminController@editBranchLocation')->name('Edit-Branch-Location');
    Route::post('update/branch/location','AdminController@updateBranchLocation');
    Route::post('delete/branch/{id}','AdminController@deleteBranch');
    Route::get('list/country','AdminController@listCountry');
    Route::post('save/country','AdminController@saveNewCountry');
    Route::post('update/country/{id}','AdminController@EditCountry')->name('Edit-Country');
    Route::get('delete/country/{id}','AdminController@deleteCountry');
    Route::get('list/city/{id}','AdminController@listCity');
    Route::post('save/city','AdminController@saveNewCity');
    Route::post('update/city/{id}','AdminController@EditCity')->name('Edit-City');
    Route::get('delete/city/{id}','AdminController@deleteCity');
    Route::get('list/area/{id}','AdminController@listArea');
    Route::post('save/area','AdminController@saveNewArea');
    Route::post('update/area/{id}','AdminController@EditArea')->name('Edit-Area');
    Route::get('delete/area/{id}','AdminController@deleteArea');
    Route::get('delivery-zones','AdminController@Listdeliveryzones')->name('Delivery-Zones');
    Route::get('create/delivery/zone','AdminController@createDeliveryZone');
    Route::post('save/delivery-zone','AdminController@SaveDeliveryZone');
    Route::get('create/zone/working-hours/{id}','AdminController@addZoneWorkingHours')->name('zone-working-hours');
    Route::post('save/zone/workinghours','AdminController@SaveZoneWorkingHours');
    Route::get('add/zone-location/{id}','AdminController@addzonelocation')->name('zone_location');
    Route::get('get/city','AdminController@getCity')->name('getCity');
    Route::get('get/area','AdminController@getArea')->name('getArea');
    Route::get('get/area','AdminController@getAreaEdit')->name('getAreaedit');
    Route::post('save/zone/location','AdminController@saveZoneLocation');
    Route::get('edit/zone/details/{id}','AdminController@editzoneDetails')->name('Edit-Zone-Details');
    Route::post('update/zone/details','AdminController@UpdatezoneDetails');
    Route::get('edit/zone/working/hours/{id}','AdminController@editZoneWorkingHours')->name('Edit-Zone-Working-Hours');
    Route::post('update/zone/workinghours','AdminController@UpdateZonehWorkingHours');
    Route::get('edit/zone/location/{id}','AdminController@editZoneLocation')->name('Edit-Zone-Location');
    Route::post('update/zone/location','AdminController@updateZoneLocation');
    Route::get('/categories','AdminController@categorylist');
    Route::post('save/category','AdminController@addCategory');
    Route::post('update/category/{id}','AdminController@updateCategory');
    Route::get('delete/category','AdminController@deleteCategory');
    Route::get('list/sub-category/{id}','AdminController@subcategory');
    Route::post('save/subcategory','AdminController@addSubCategory');
    Route::post('update/subcategory/{id}','AdminController@updateSubCategory');
    Route::get('delete/subcategory','AdminController@deleteSubCategory');
    Route::get('/products','AdminController@ListProducts')->name('Products');
    Route::get('/getSubcategory','AdminController@getSubcategory')->name('getSubcategory');
    Route::get('create/product/details','AdminController@createProduct');
    Route::post('save/product_details','AdminController@SaveProduct');
    Route::get('/logout', 'AdminController@logout')->name('Admin-Logout');
});
Route::get('/guestt', function(){
    echo "Hello Guest";
})->middleware('guestt');

Route::get('/customer', function(){
    echo "Hello Customer";
})->middleware('customer');
    