<?php

namespace EscapeWork\Moip\Data;

class TransferInstrumentData extends Data
{

    /**
     * Fillable attributes
     */
    protected $fillable = [
        'method',
        'bankAccount',
    ];

    public function setBankAccountAttribute($data)
    {
        $this->bankAccount = new BankAccountData;
        $this->bankAccount->fill($data);
        return $this;
    }

    public function toArray()
    {
        return [
            'method'      => $this->method ?: 'BANK_ACCOUNT',
            'bankAccount' => $this->bankAccount->toArray(),
        ];
    }
}
