<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Catalog extends Model
{
    protected $table = 'product_catalog';

    //Many to One relationship to table 'products'
    public function products()
    {
        return $this->belongsTo('App\Product');
    }
}
