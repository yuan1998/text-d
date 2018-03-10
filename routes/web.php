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



// Route::group(['prefix'=>'admin'],function(){

//     Route::get('{all}',function(){
//         return view('admin.root');
//     })->where(['all'=>'.*']);

// });


Route::get('/',function(){
    return view('admin.root');
});

Route::get('/test',function(){
    return view('admin.views.article.create');
});

