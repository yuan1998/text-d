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



Route::group(['prefix' => 'article'],function(){
	$article = new \App\Article;
	Route::get('create',function(){
		return view('admin.views.article.create');
	});

	Route::get('edit/{id}',function($id) use($article){
		$a = $article->find($id);


    	return view('admin.views.article.edit',['id'=>$id,'data' => $a]);
	});
});


Route::group(['prefix'=>'case'],function(){

	Route::get('create',function(\App\Http\Controllers\ProjectCatController $s){

		return view('admin.views.case.create',['tree' => $s->buildCatTree()]);

	});

});





