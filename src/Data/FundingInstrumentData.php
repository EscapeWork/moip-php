<?php

namespace EscapeWork\Moip\Data;

class FundingInstrumentData extends Data
{

    const CREDIT_CARD       = 'CREDIT_CARD';
    const BOLETO            = 'BOLETO';
    const ONLINE_BANK_DEBIT = 'ONLINE_BANK_DEBIT';

    /**
     * Fillable attributes
     */
    protected $fillable = [
        'method',
        'creditCard',
        'boleto',
        'onlineBankDebit',
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

    public function setOnlineBankDebitAttribute($data)
    {
        $this->onlineDebit = new OnlineBankDebitData();
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
                break;

            case self::ONLINE_BANK_DEBIT:
                $data['onlineBankDebit'] = $this->onlineBankDebit->toArray();
                break;
        }

        return $data;
    }
}
