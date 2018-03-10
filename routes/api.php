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

Route::group(['prefix'=> 'article'],function(){

    Route::any('add','ArticleController@add');

    Route::any('list','ArticleController@getPaginate');

    Route::any('fetch',"ArticleController@fetchId");

    Route::any('change', 'ArticleController@change');

});

Route::group(['prefix' => 'img'],function(){

    Route::any('upload',"ImageController@saveImage");


});
