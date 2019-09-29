<?php

namespace EscapeWork\Moip\Data;

use EscapeWork\Moip\Data\RefundInstrumentData;

class RefundData extends Data
{
    /**
     * Fillable attributes
     */
    protected $fillable = [
        'amount',
        'refundInstrument',
    ];

    public function setRefundInstrumentAttribute($data)
    {
        $this->refundInstrument = new RefundInstrumentData;
        $this->refundInstrument->fill($data);
        return $this;
    }

    public function toArray()
    {
        return [
            'amount' => $this->amount,
            'refundInstrument' => $this->refundInstrument->toArray(),
        ];
    }
}
