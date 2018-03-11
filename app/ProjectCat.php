<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectCat extends Model
{
    public $fillable = ['title','desc','parent_id','cover_url','image','treatment','reason','symptom','harm'];

    public $casts = ['image' => 'json'];

}
