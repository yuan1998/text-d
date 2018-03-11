<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Case extends Model
{
    //
    public $fillable = ['cover','title','project','desc','article_id','look','link','image','project_id','expert_desc','expert_id','name','sex','before_img','after_img'];

    public $casts = [ 'image' => 'json'];
}
