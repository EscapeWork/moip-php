<?php

namespace EscapeWork\Moip\Data;

class TransferData extends Data
{

    /**
     * Fillable attributes
     */
    protected $fillable = [
        'amount',
        'transferInstrument',
    ];

    public function toArray()
    {
        return [
            'amount'             => $this->amount,
            'transferInstrument' => $this->transferInstrument->toArray(),
        ];
    }
}
