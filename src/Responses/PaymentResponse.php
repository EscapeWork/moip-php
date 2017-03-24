<?php

namespace EscapeWork\Moip\Responses;

use EscapeWork\Moip\Data\OnlineBankDebitData;

class PaymentResponse extends Response
{
    public function getId()
    {
        return $this->data->id;
    }

    public function getStatus()
    {
        return $this->data->status;
    }

    public function getMethod()
    {
        return $this->data->fundingInstrument->method;
    }

    public function getAmount()
    {
        return $this->data->amount;
    }

    public function getAmountTotal()
    {
        return $this->getAmount()->total;
    }

    public function hasCancellationDetails()
    {
        return isset($this->data->cancellationDetails);
    }

    public function getCancellationDetailsCode()
    {
        return $this->data->cancellationDetails->code;
    }

    public function getCancellationDetailsDescription()
    {
        return $this->data->cancellationDetails->description;
    }

    public function getCancellationDetailsCancelledBy()
    {
        return $this->data->cancellationDetails->cancelledBy;
    }

    public function getBoletoLink()
    {
        return $this->data->_links->payBoleto->redirectHref;
    }

    public function getOnlineBankDebitLink()
    {
        switch ($this->data->fundingInstrument->onlineBankDebit->bankNumber) {
            case OnlineBankDebitData::BANK_BB:
                return $this->data->_links->payOnlineBankDebitBB->redirectHref;

            // case OnlineBankDebitData::BANK_BRADSCO:
            //     return $this->data->_links->payOnlineBankDebitBB->redirectHref;

            default:
                dd($this->data);
        }
    }
}
