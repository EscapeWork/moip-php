<?php

namespace EscapeWork\Moip\Data;

class BankAccountData extends Data
{

    /**
     * Fillable attributes
     */
    protected $fillable = [
        'id',
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
        $data = array_except($this->attributes, ['holder']);

        if ($this->holder) {
            $data['holder'] = $this->holder->toArray();
        }

        return $data;
    }
}
