<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function addresses()
    {
        return $this->belongsToMany('App\Address', 'address_contact')->withPivot('is_default','address_type_id');
    }

}
