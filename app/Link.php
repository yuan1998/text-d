<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    public $fillable = ['title','cover','desc','link'];
}
