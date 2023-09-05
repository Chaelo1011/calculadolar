<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    //One to many relationship to table 'sale_details'
    public function sale_details()
    {
        return $this->hasMany('App\Sale_Detail')->orderBy('id', 'desc');
    }

    //One to many relationship to table 'product_catalog'
    public function product_catalogs()
    {
        return $this->hasMany('App\Product_Catalog')->orderBy('id', 'desc');
    }

    //Many to One relationship to table 'category'
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

     //Many to One relationship to table 'category'
     public function user()
     {
         return $this->belongsTo('App\User');
     }

}
