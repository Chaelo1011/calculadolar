<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DollarUser extends Model
{
    protected $table = 'dollar_user';

    public function users ()
    {
        return $this->belongsTo('App\User');
    }

}
