<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $fillable = ['title','parent_id','desc'];
}
