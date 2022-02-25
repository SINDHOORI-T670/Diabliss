<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class DeliveryZone extends Model
{
    public $incrementing = false;
    protected $with = ['branch','dzareas','country'];
    public function branch()
    {
        return $this->belongsTo('App\models\Branch','branch_id','id');
    }
    public function dzareas()
    {
        return $this->hasMany('App\models\DeliveryZoneArea','zone_id','id');
    }
    public function country()
    {
        return $this->belongsTo('App\models\Country','country_id','id');
    }
    
}
