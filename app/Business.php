<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $table = 'business';

    //Many to One relationship to table 'users'
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //One to Many relationship to table 'customer'
    public function customer()
    {
        return $this->hasMany('App\Customer');
    }
}
