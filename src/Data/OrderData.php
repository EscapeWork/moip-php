<?php

namespace EscapeWork\Moip\Data;

class OrderData extends Data
{
    /**
     * Fillable attributes
     */
    protected $fillable = [
        'ownId',
        'currency',
        'shipping',
    ];

    public function getOwnId()
    {
        return $this->ownId;
    }

    public function getCurrency()
    {
        return $this->currency ?: 'BRL';
    }

    public function getShipping()
    {
        return $this->shipping;
    }
}
