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
     * return the address flagged as default
     * there should only be one default address (where can I enforce this?), so
     * using 'first' should work
     *
     * @return Address default address for contact
     */
    public function getDefaultAddress()
    {
        $address = $this->belongsToMany('App\Address', 'address_contact')->wherePivot('is_default',1)->first();
        if ($address == ''){
            $address = new Address;
        }
        return $address;
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
