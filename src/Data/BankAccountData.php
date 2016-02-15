<?php

namespace EscapeWork\Moip\Data;

class BankAccountData extends Data
{

    /**
     * Fillable attributes
     */
    protected $fillable = [
        'bankNumber',
        'type',
        'agencyNumber',
        'agencyCheckNumber',
        'accountNumber',
        'accountCheckNumber',
        'holder',
    ];

    public function setHolderAttribute($data)
    {
        $this->holder = new HolderData;
        $this->holder->fill($data);
    }

    public function toArray()
    {
        return [
            'bankNumber'         => $this->bankNumber,
            'type'               => $this->type,
            'agencyNumber'       => $this->agencyNumber,
            'agencyCheckNumber'  => $this->agencyCheckNumber,
            'accountNumber'      => $this->accountNumber,
            'accountCheckNumber' => $this->accountCheckNumber,
            'holder'             => $this->holder->toArray(),
        ];
    }
}
