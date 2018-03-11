<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{


    /**
     * The Attribute is config table can change or set col name.
     * @var {Array}
     */
    public $fillable = ['name','cover','project_id','image','position','level','field','link','achievement','desc'];


    /**
     * The Attribute is set col data type.
     * @var {array}
     */
    public $casts = ['image' => 'json'];
}
