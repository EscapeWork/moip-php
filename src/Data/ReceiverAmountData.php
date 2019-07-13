<?php

namespace EscapeWork\Moip\Data;

class ReceiverAmountData extends Data
{
    /**
     * Fillable attributes
     */
    protected $fillable = [
        'fixed',
        'percentual',
    ];

    public function toArray()
    {
        return array_filter([
            'fixed' => $this->fixed,
            'percentual' => $this->percentual,
        ]);
    }
}
