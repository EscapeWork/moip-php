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
        'zipCode',
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

    public function getZipCode()
    {
        return $this->zipCode;
    }

    public function toArray()
    {
        return [
            'street'       => $this->getStreet(),
            'streetNumber' => $this->getStreetNumber(),
            'complement'   => $this->getComplement(),
            'district'     => $this->getDistrict(),
            'city'         => $this->getCity(),
            'state'        => $this->getState(),
            'country'      => $this->getCountry(),
            'zipCode'      => $this->getZipCode(),
        ];
    }
}
