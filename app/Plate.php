<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plate extends Model
{
    protected $fillable = [
        "tag_id",
        "user_id",
        "name",
        "description",
        "price",
        "ingredients",
        "visible",
        "preview",
    ];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function order()
    {
        return $this->belongsToMany('App\Order');
    }
    public function tag()
    {
        return $this->belongsTo('App\Tag');
    }
}
