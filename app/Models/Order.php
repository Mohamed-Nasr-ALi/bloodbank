<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('timestamps', 'patient_name', 'patient_age', 'blood_type_id', 'quantity', 'hospital_name', 'city_id', 'hospital_address', 'phone', 'notes', 'latitude', 'longitude', 'client_id');

//    public function governorate()
//    {
//        return $this->belongsTo('App\Models\Governorate');
//    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function bloodtype()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function notification()
    {
        return $this->hasOne('App\Models\Notification');
    }

}
