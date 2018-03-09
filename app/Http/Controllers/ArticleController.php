<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends ApiController
{

	public $modelName = 'Article';


	public function getList()
    {

    	$limit = request('limit') ?: 10 ;

    	$r = $this->model->orderBy('id','desc')->paginate($limit);


    	return $this->resultReturn($r);

    }


}
