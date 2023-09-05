<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale_Detail extends Model
{
    protected $table = 'sale_details';

    //Many to One relationship to table 'products'
    public function products()
    {
        return $this->belongsTo('App\Product');
    }

    //Many to One relationship to table 'invoice'
    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
}
