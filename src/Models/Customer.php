<?php 

namespace EscapeWork\Moip\Models;

use EscapeWork\Moip\Contracts\CustomerContract;

class Customer extends Model implements CustomerContract
{

    /**
     * Fillable attributes
     */
    protected $fillable = [
        'code',
        'email',
        'fullname',
        'cpf',
        'phone_number',
        'phone_area_code',
        'birthdate_day',
        'birthdate_month',
        'birthdate_year',
    ];

    public function getCode()
    {
        return $this->code;
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
