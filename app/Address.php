<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function contacts()
    {
        return $this->belongsToMany('App\Contact');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }
}
