<?php namespace EscapeWork\Moip\Contracts;

interface CreditCardContract
{

    public function getHolderName();
    public function getNumber();
    public function getExpirationMonth();
    public function getExpirationYear();
}
