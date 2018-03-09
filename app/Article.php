<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{




    public $fillable = ['title','content','summary','cover','look','author','cat_id','push_time'];






}
