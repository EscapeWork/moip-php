<?php

namespace EscapeWork\Moip\Data;

class OnlineBankDebitData extends Data
{
    const BANK_BB       = '001';
    const BANK_BRADESCO = '237';
    const BANK_ITAU     = '341';
    const BANK_BANRISUL = '041';

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
