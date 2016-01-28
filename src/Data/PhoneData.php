<?php

namespace EscapeWork\Moip\Data;

class PhoneData extends Data
{

    /**
     * Fillable attributes
     */
    protected $fillable = [
        'countryCode',
        'areaCode',
        'number',
    ];

    public function getCountryCode()
    {
        return $this->countryCode ?: '55';
    }

    public function getAreaCode()
    {
        return $this->areaCode;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function toArray()
    {
        return [
            'countryCode' => $this->getCountryCode(),
            'areaCode'    => $this->getAreaCode(),
            'number'      => $this->getNumber(),
        ];
    }
}
