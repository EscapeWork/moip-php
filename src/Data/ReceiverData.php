<?php

namespace EscapeWork\Moip\Data;

class ReceiverData extends Data
{
    const TYPE_PRIMARY = 'PRIMARY';
    const TYPE_SECONDARY = 'SECONDARY';

    /**
     * Fillable attributes
     */
    protected $fillable = [
        'type',
        'feePayor',
        'moipAccount',
        'amount',
    ];

    public function setMoipAccountAttribute($data)
    {
        $this->attributes['moipAccount'] = new MoipAccountData($data);
    }

    public function setAmountAttribute($data)
    {
        $this->attributes['amount'] = new ReceiverAmountData($data);
    }

    public function toArray()
    {
        return [
            'type' => $this->type,
            'feePayor' => $this->feePayor,
            'moipAccount' => $this->moipAccount->toArray(),
            'amount' => $this->amount->toArray(),
        ];
    }
}
