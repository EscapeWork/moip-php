<?php

namespace EscapeWork\Moip\Data;

use EscapeWork\Moip\Contracts\CustomerContract;

class CustomerData extends Data implements CustomerContract
{

    /**
     * Fillable attributes
     */
    protected $fillable = [
        'ownId',
        'fullname',
        'email',
        'birthDate',
        'cpf',
        'taxDocument',
        'phone',
        'shippingAddress',
    ];

    public function getOwnId()
    {
        return $this->ownId;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getFullname()
    {
        return $this->fullname;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    public function getPhoneAreaCode()
    {
        return $this->phone_area_code;
    }

    public function getBirthdateDay()
    {
        return $this->birthdate_day;
    }

    public function getBirthdateMonth()
    {
        return $this->birthdate_month;
    }

    public function getBirthdateYear()
    {
        return $this->birthdate_year;
    }
}
