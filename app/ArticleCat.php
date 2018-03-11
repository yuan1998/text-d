<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleCat extends Model
{


    public $fillable = ['title','parent_id','desc'];

}
