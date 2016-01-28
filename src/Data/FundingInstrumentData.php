<?php

namespace EscapeWork\Moip\Data;

class FundingInstrumentData extends Data
{

    const CREDIT_CARD = 'CREDIT_CARD';

    /**
     * Fillable attributes
     */
    protected $fillable = [
        'method',
        'creditCard',
    ];

    public function getMethod()
    {
        return $this->method;
    }

    public function setCreditCardAttribute($data)
    {
        $this->creditCard = new CreditCardData();
        $this->creditCard->fill($data);
    }

    public function toArray()
    {
        $data = ['method' => $this->getMethod()];

        if ($this->getMethod() === self::CREDIT_CARD) {
            $data['creditCard'] = $this->creditCard->toArray();
        }

        return $data;
    }
}
