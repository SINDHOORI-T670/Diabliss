<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $with = ['cities'];
    public function cities()
    {
        return $this->hasMany('App\models\City','id','country_id');
    }
}
