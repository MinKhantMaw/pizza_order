<?php

use Illuminate\Support\Facades\Auth;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin#profile');
        } else if (Auth::user()->role === 'user') {
            return redirect()->route('user#index');

        }
    }
})->name('dashboard');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    // Profile Controller
    Route::get('/profile', 'AdminController@profile')->name('admin#profile');
    Route::post('/updateProfile/{id}', 'AdminController@updateProfile')->name('admin#updateProfile');
    Route::get('/changePassword', 'AdminController@changePasswordPage')->name('admin#changePasswordPage');
    Route::post('/changePassword/{id}', 'AdminController@changePassword')->name('admin#changePassword');
    // Category Controller
    Route::get('/category', 'CategoryController@category')->name('admin#category');
    Route::get('/addCategory', 'CategoryController@addCategory')->name('admin#addCategory');
    Route::post('/createCategory', 'CategoryController@createCategory')->name('admin#createCategory');
    Route::get('/deleteCategory/{id}', 'CategoryController@deleteCategory')->name('admin#delete');
    Route::get('/editCategory/{id}', 'CategoryController@editCategory')->name('admin#edit');
    Route::post('updateCategoty', 'CategoryController@updateCategoty')->name('admin#update');
    Route::get('category/search', 'CategoryController@searchCategory')->name('admin#search');
    Route::get('categoryItem/{id}', 'CategoryController@categoryItem')->name('admin#categoryItem');
    // for pizza route
    Route::get('/pizza', 'PizzaController@pizza')->name('admin#pizza');
    Route::get('/createPizza', 'PizzaController@createPizza')->name('admin#create');
    Route::post('/insertPizza', 'PizzaController@insertPizza')->name('admin#insertPizza');
    Route::get('/deletePizza/{id}', 'PizzaController@deletePizza')->name('admin#deletePizza');
    Route::get('/editPizza/{id}', 'PizzaController@editPizza')->name('admin#editPizza');
    Route::get('/infoPizza/{id}', 'PizzaController@infoPizza')->name('admin#infoPizza');
    Route::post('/updatePizza/{id}', 'PizzaController@updatePizza')->name('admin#updatePizza');
    Route::get('pizza/search', 'PizzaController@searchPizza')->name('admin#pizza');

    // Auth Controller
    Route::get('/userList', 'AuthController@userList')->name('admin#userList');
    Route::get('/user/search', 'AuthController@userSearch')->name('admin#userSearch');
    Route::get('user/delte/{id}', 'AuthController@userDelete')->name('admin#userDelete');
    Route::get('/adminList', 'AuthController@adminList')->name('admin#adminList');
    Route::get('/admin/delete/{id}', 'AuthController@adminDelete')->name('admin#adminDelete');
    Route::get('admin/search', 'AuthController@adminSearch')->name('admin#adminSearch');

    Route::get('contact/list/','ContactController@contactList')->name('admin#contactList');
    Route::get('contact/search/','ContactController@contactSearch')->name('admin#contactSearch');
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/', 'UserController@index')->name('user#index');

// Contact Controller
    Route::post('contact/create', 'Admin\ContactController@contactCreate')->name('user#contactCreate');
    Route::get('pizza/details/{id}', 'UserController@pizzaDetails')->name('user#pizzaDetails');
});
