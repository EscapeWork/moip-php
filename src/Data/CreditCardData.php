<?php

namespace EscapeWork\Moip\Data;

class CreditCardData extends Data
{
    /**
     * Fillable attributes
     */
    protected $fillable = [
        'hash',
        'holder',
    ];

    public function getHash()
    {
        return $this->hash;
    }

    public function getHolder()
    {
        return $this->holder;
    }

    public function setHolderAttribute($data)
    {
        $this->attributes['holder'] = new HolderData();
        $this->attributes['holder']->fill($data);
    }

    public function toArray()
    {
        return [
            'hash' => $this->getHash(),
            'holder' => $this->holder->toArray(),
        ];
    }
}
