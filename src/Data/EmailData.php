<?php

namespace EscapeWork\Moip\Data;

class EmailData extends Data
{

    /**
     * Fillable attributes
     */
    protected $fillable = [
        'address',
    ];

    public function getAddress()
    {
        return $this->address;
    }
}
