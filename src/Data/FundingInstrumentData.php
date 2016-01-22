<?php

namespace EscapeWork\Moip\Data;

class FundingInstrumentData extends Data
{

    /**
     * Fillable attributes
     */
    protected $fillable = [
        'method',
        'creditCard',
    ];

    public function getMethod()
    {
        return $this->method;
    }
}
