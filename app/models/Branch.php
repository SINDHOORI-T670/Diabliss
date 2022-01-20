<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
class Branch extends Model
{
    protected $primaryKey = 'id'; 
    public $incrementing = false;
    public $timestamps = true;
    // public static function boot()
    // {
    //     parent::boot();
    //     self::creating(function ($model) {
    //         $model->id = IdGenerator::generate(['table' => 'branches', 'length' => 6, 'prefix' =>'BRANCH-']);
    //     });
    // }
    protected $with = ['settings','hours','locat'];
    public function settings()
    {
        return $this->belongsTo('App\models\BranchOrderSetting','id','branch_id');
    }
    public function hours(){
        return $this->belongsTo('App\models\BranchWorkingHour','id','branch_id');
    }
    public function locat(){
        return $this->belongsTo('App\models\BranchLocation','id','branch_id');
    }
}
