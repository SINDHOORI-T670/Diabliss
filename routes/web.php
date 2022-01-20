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
    Route::get('/logout', 'AdminController@logout')->name('Admin-Logout');
});
Route::get('/guestt', function(){
    echo "Hello Guest";
})->middleware('guestt');

Route::get('/customer', function(){
    echo "Hello Customer";
})->middleware('customer');
    