<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;
    use Searchable;

    protected $dates = ['deleted_at'];

    public function addresses()
    {
        return $this->belongsToMany('App\Address', 'address_contact')->withPivot('is_default','address_type_id');
    }

    /**
     * overide Scout method toSearchableArray to select specific cols to be added to search index
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,

            'email' => $this->email,
            'telephone' => $this->telephone,
            'postcode' => $this->postcode,
        ];
    }

}
