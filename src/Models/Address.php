<?php 

namespace EscapeWork\Moip\Models;

use EscapeWork\Moip\Contracts\AddressContract;

class Address extends Model implements AddressContract
{

    /**
     * Fillable attributes
     */
    protected $fillable = [
        'street',
        'number',
        'complement',
        'district',
        'city',
        'state',
        'country',
        'zipcode',
    ];

    public function getStreet()
    {
        return $this->street;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getComplement()
    {
        return $this->complement;
    }

    public function getDistrict()
    {
        return $this->district;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getState()
    {
        return $this->state;
    }

    public function getCountry()
    {
        return $this->country ?: 'BRA';
    }

    public function getZipcode()
    {
        return $this->zipcode;
    }
}
