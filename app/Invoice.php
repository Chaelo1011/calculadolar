<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';

    //One to Many relationship to table 'sale_details'
    public function sale_details()
    {
        return $this->hasMany('App\Sale_Detail');
    }

    //Many to One relationship to table 'users'
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //Many to One relationship to table 'customer'
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
}
