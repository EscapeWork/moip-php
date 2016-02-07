<?php

namespace EscapeWork\Moip\Data;

class OnlineDebitData extends Data
{

    /**
     * Fillable attributes
     */
    protected $fillable = [
        'bankNumber',
        'expirationDate',
        'returnUri',
    ];

    public function getBankNumber()
    {
        return $this->bankNumber;
    }

    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    public function getReturnUri()
    {
        return $this->returnUri;
    }

    public function toArray()
    {
        return [
            'bankNumber'     => $this->getBankNumber(),
            'expirationDate' => $this->getExpirationDate(),
            'returnUri'      => $this->getReturnUri(),
        ];
    }
}
