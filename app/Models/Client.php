<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model 
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $guarded = array('api_token');
    protected $fillable = array('name', 'email', 'blood_type_id', 'city_id', 'pin_code', 'phone', 'b_o_d', 'password', 'order_last_date', 'is_active');

    public function bloodtype()
    {
        return $this->belongsTo('App\Models\BloodType','blood_type_id');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification');
    }

    public function bloodtypes()
    {
        return $this->belongsToMany('App\Models\BloodType');
    }

    public function cities()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function governorates()
    {
        return $this->belongsToMany('App\Models\Governorate');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function tokens()
    {
        return $this->hasMany('App\Models\Token');
    }

}
