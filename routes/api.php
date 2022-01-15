<?php

use App\Models\Category;
use Illuminate\Http\Request;
// use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('api-test',function(){
    dd("api test");
});
Route::group(['prefix' =>'category','namespace'=>'API'],function(){
    Route::get('list','ApiController@categoryList');
    Route::post('create','ApiController@create');
    Route::post('details','ApiController@details');
    Route::get('delete/{id}','ApiController@delete');
    Route::post('update','ApiController@update');
});
