<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';

    //One to Many relationship to table 'invoice'
    public function invoice()
    {
        return $this->hasMany('App\Invoice');
    }

    //Many to One relationship to table 'business'
    public function business() {
        return $this->belongsTo('App\Business');
    }
}
