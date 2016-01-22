<?php

namespace EscapeWork\Moip\Data;

class AddressData extends Data
{

    /**
     * Fillable attributes
     */
    protected $fillable = [
        'street',
        'streetNumber',
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

    public function getStreetNumber()
    {
        return $this->streetNumber;
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
