<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{


    public $fillable = ['name','sex','contact','desc','date'];

}
