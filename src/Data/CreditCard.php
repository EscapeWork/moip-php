<?php

namespace EscapeWork\Moip\Data;

class CreditCard extends Data
{

    /**
     * Fillable attributes
     */
    protected $fillable = [
        'holder_name',
        'number',
        'expiration_month',
        'expiration_year',
    ];

    public function getHolderName()
    {
        return $this->holder_name;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getExpirationMonth()
    {
        return $this->expiration_month;
    }

    public function getExpirationYear()
    {
        return $this->expiration_year;
    }
}
