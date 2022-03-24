<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'totalPrice'
    ];

    public function plates()
    {
        return $this->belongsToMany('App\Plate');
    }

    public function guest()
    {
        return $this->hasOne('App\Guest');
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }
}
