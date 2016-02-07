<?php

namespace EscapeWork\Moip\Data;

class FundingInstrumentData extends Data
{

    const CREDIT_CARD  = 'CREDIT_CARD';
    const BOLETO       = 'BOLETO';
    const ONLINE_DEBIT = 'ONLINE_DEBIT';

    /**
     * Fillable attributes
     */
    protected $fillable = [
        'method',
        'creditCard',
        'boleto',
        'onlineDebit',
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

    public function setBoletoAttribute($data)
    {
        $this->boleto = new BoletoData();
        $this->boleto->fill($data);
    }

    public function setOnlineDebitAttribute($data)
    {
        $this->onlineDebit = new OnlineDebitData();
        $this->onlineDebit->fill($data);
    }

    public function toArray()
    {
        $data = ['method' => $this->getMethod()];

        switch ($this->getMethod()) {
            case self::CREDIT_CARD:
                $data['creditCard'] = $this->creditCard->toArray();
                break;

            case self::BOLETO:
                $data['boleto'] = $this->boleto->toArray();

            case self::ONLINE_DEBIT:
                $data['onlineDebit'] = $this->onlineDebit->toArray();
        }

        return $data;
    }
}
