<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class DeliveryZoneArea extends Model
{
    protected $with = ['country','area'];
    public function country()
    {
        return $this->belongsTo('App\models\country','country_id','id');
    }
    public function area(){
        return $this->belongsTo('App\models\Area','area_id','id');
    }

}
