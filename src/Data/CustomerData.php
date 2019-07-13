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

    public function setCpfAttribute($cpf)
    {
        if (! isset($this->attributes['taxDocument'])) {
            $this->attributes['taxDocument'] = new TaxDocumentData;
        }

        $this->attributes['taxDocument']->number = $cpf;
    }

    public function setPhoneAttribute($data)
    {
        if ($data instanceof PhoneData) {
            $this->attributes['phone'] = $data;
            return $this;
        }

        $this->attributes['phone'] = new PhoneData($data);
    }

    public function setPhoneAreaCodeAttribute($areaCode)
    {
        if (! isset($this->attributes['phone'])) {
            $this->attributes['phone'] = new PhoneData;
        }

        $this->attributes['phone']->areaCode = $areaCode;
    }

    public function setPhoneNumberAttribute($number)
    {
        if (! isset($this->attributes['phone'])) {
            $this->attributes['phone'] = new PhoneData;
        }

        $this->attributes['phone']->number = $number;
    }

    public function setShippingAddressAttribute($data)
    {
        if ($data instanceof AddressData) {
            $this->attributes['shippingAddress'] = $data;
            return $this;
        }

        $this->attributes['shippingAddress'] = new AddressData($data);
    }

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

    public function getBirthDate()
    {
        return $this->birthDate;
    }

    public function getTaxDocument()
    {
        return $this->taxDocument;
    }

    public function getCpf()
    {
        return $this->taxDocument->cpf;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getPhoneCountryCode()
    {
        return $this->phone->countryCode;
    }

    public function getPhoneAreaCode()
    {
        return $this->phone->areaCode;
    }

    public function getPhoneNumber()
    {
        return $this->phone->number;
    }

    public function getShippingAddress()
    {
        return $this->shippingAddress;
    }
}
