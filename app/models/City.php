<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $with = ['country','areas'];
    public function country()
    {
        return $this->belongsTo('App\models\country','country_id','id');
    }
    public function areas(){
        return $this->hasMany('App\models\Area','city_id','id');
    }
}
