<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Plate extends Model
{
    protected $fillable = [
        "tag_id",
        "user_id",
        "name",
        "slug",
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

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function createSlug($title)
    {
        $slug = Str::slug($title, '-');

        $oldPlate = Plate::where('slug', $slug)->first();

        $counter = 0;
        while ($oldPlate) {
            $newSlug = $slug . '-' . $counter;
            $oldPlate = Plate::where('slug', $newSlug)->first();
            $counter++;
        }

        return (empty($newSlug)) ? $slug : $newSlug;
    }
}
