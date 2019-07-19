<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model 
{

    protected $table = 'governorates';
    public $timestamps = true;
    protected $fillable = array('name');

    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }

//    public function orders()
//    {
//        return $this->hasMany('App\Models\Order');
//    }

    public function clientnotifications()
    {
        return $this->belongsToMany('App\Models\Client');
    }

}
