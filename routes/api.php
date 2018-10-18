<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('articles','ArticleController@index');

//show api
Route::get('article/{id}','ArticleController@show');
//create
Route::post('article','ArticleController@store');

//update
Route::put('articles','ArticleController@store');
//delete
Route::delete('article1/{id}','ArticleController@destroy');




