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

// Route::get('/', function () {
//     return view('welcome');
// });




Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/register', function () {
    return redirect('/home');
});

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::get('/count-new-customer', 'HomeController@getNewCustomer')->name('dashboard');
Route::get('/count-total-customer', 'HomeController@getTotalCustomer')->name('dashboard');
Route::get('/count-new-service', 'HomeController@getServices')->name('dashboard');
Route::get('/count-total-service', 'HomeController@getTotalService')->name('dashboard');


/*Get Admin id*/
Route::get('/admin', 'HomeController@adminId')->name('admin');

/*Get All Users Informations*/
Route::get('/all-users', 'AdminController@allUsers')->name('users');
Route::post('/create-user', 'AdminController@createUser')->name('users');
Route::post('/update-user', 'AdminController@updateUser')->name('users');

// Customers Handel
Route::get('/customers', 'CustomerController@index')->name('customers');
Route::get('/all-customers', 'CustomerController@getCustomers')->name('customers');
Route::post('/create-customer', 'CustomerController@createCustomer')->name('customers');
Route::post('/update-customer', 'CustomerController@updateCustomer')->name('customers');
Route::post('/delete-customer', 'CustomerController@deleteCustomer')->name('customers');

Route::post('/update-customer-offer', 'CustomerController@updateCustomerOffer')->name('customers');
Route::post('/create-customer-offer', 'CustomerController@createCustomerOffer')->name('customers');
Route::post('/customer-packages-discount', 'CustomerController@customerPackagesDisc')->name('packages');
Route::post('/customer-service', 'CustomerController@customerService')->name('packages');
Route::post('/getTotalService', 'CustomerController@getTotalService')->name('packages');

/*All Pacdkages Routes Here*/
Route::get('/packages', 'PackageController@index')->name('packages');
Route::get('/all-packages', 'PackageController@getAllPackages')->name('packages');
Route::post('/create-package', 'PackageController@createPackages')->name('packages');
Route::post('/update-package', 'PackageController@updatePackages')->name('packages');
Route::post('/delete-package', 'PackageController@deletePackages')->name('packages');
Route::get('/all-packages-discount', 'PackageController@getAllPackagesDisc')->name('packages');

/*All Services Routes*/
Route::get('/services', 'ServiceController@index')->name('services');
Route::get('/all-services', 'ServiceController@allService')->name('services');
Route::post('/create-service', 'ServiceController@createService')->name('services');
Route::post('/update-service', 'ServiceController@updateService')->name('services');
Route::post('/delete-service', 'ServiceController@deleteService')->name('services');

Route::get('/admin-panel', 'AdminController@index')->name('admin-panel');

Route::get('/test', 'HomeController@index')->name('test');


Route::get('{vue_capture?}', function () {
    return view('home');
})->where('vue_capture','.*');
