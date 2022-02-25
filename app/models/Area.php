<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    // protected $with = ['city'];
    public function city()
    {
        return $this->belongsTo('App\models\city','city_id','id');
    }
}
