<?php

namespace EscapeWork\Moip\Data;

class CreditCard extends Data
{

    /**
     * Fillable attributes
     */
    protected $fillable = [
        'hash',
        'holder',
        'phone',
    ];

    public function getHash()
    {
        return $this->hash;
    }

    public function getHolder()
    {
        return $this->holder;
    }

    public function getPhone()
    {
        return $this->phone;
    }
}
