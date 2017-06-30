<?php

namespace EscapeWork\Moip\Data;

use EscapeWork\Moip\Data\TransferInstrumentData;

class TransferData extends Data
{
    /**
     * Fillable attributes
     */
    protected $fillable = [
        'amount',
        'transferInstrument',
    ];

    public function setTransferInstrumentAttribute($data)
    {
        $this->transferInstrument = new TransferInstrumentData;
        $this->transferInstrument->fill($data);
        return $this;
    }

    public function toArray()
    {
        return [
            'amount'             => $this->amount,
            'transferInstrument' => $this->transferInstrument->toArray(),
        ];
    }
}
