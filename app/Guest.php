<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    //


    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
