<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $incrementing = false;
    public $with = ['proimg','protag','category'];
    public function proimg()
    {
        return $this->hasMany('App\models\ProductImage','product_id','id');
    }
    public function protag()
    {
        return $this->hasMany('App\models\ProductTags','product_id','id');
    }
    public function category()
    {
        return $this->belongsTo('App\models\Category','cat_id','id');
    }
}
