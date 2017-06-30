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
        'moipAccount',
    ];

    public function setBankAccountAttribute($data)
    {
        $this->bankAccount = new BankAccountData;
        $this->bankAccount->fill($data);
        return $this;
    }

    public function setMoipAccountAttribute($data)
    {
        $this->moipAccount = new MoipAccountData;
        $this->moipAccount->fill($data);
        return $this;
    }

    public function toArray()
    {
        $data = ['method' => $this->method ?: 'BANK_ACCOUNT'];

        if ($this->bankAccount) {
            $data['bankAccount'] = $this->bankAccount->toArray();
        }

        if ($this->moipAccount) {
            $data['moipAccount'] = $this->moipAccount->toArray();
        }

        return $data;
    }
}
