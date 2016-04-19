<?php

namespace EscapeWork\Moip\Data;

use EscapeWork\Moip\Data\IdentityDocumentData;

class PersonData extends Data
{

    /**
     * Fillable attributes
     */
    protected $fillable = [
        'name',
        'lastName',
        'taxDocument',
        'identityDocument',
        'cpf',
        'cnpj',
        'birthDate',
        'nationality',
        'phone',
        'address',
    ];

    public function setTaxDocumentAttribute($data)
    {
        if ($data instanceof TaxDocumentData) {
            $this->attributes['taxDocument'] = $data;
            return $this;
        }

        $this->attributes['taxDocument'] = new TaxDocumentData();
        $this->attributes['taxDocument']->fill($data);
    }

    public function setCpfAttribute($cpf)
    {
        if (! isset($this->attributes['taxDocument'])) {
            $this->attributes['taxDocument'] = new TaxDocumentData;
        }

        $this->attributes['taxDocument']->number = $cpf;
    }

    public function setCnpjAttribute($cnpj)
    {
        if (! isset($this->attributes['taxDocument'])) {
            $this->attributes['taxDocument'] = new TaxDocumentData;
        }

        $this->attributes['taxDocument']->type   = 'CNPJ';
        $this->attributes['taxDocument']->number = $cnpj;
    }

    public function setIdentityDocumentAttribute($data)
    {
        if ($data instanceof IdentityDocumentData) {
            $this->attributes['identityDocument'] = $data;
            return $this;
        }

        $this->attributes['identityDocument'] = new IdentityDocumentData();
        $this->attributes['identityDocument']->fill($data);
    }

    public function setPhoneAttribute($data)
    {
        if ($data instanceof PhoneData) {
            $this->attributes['phone'] = $data;
            return $this;
        }

        $this->attributes['phone'] = new PhoneData();
        $this->attributes['phone']->fill($data);
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

    public function setAddressAttribute($data)
    {
        if ($data instanceof AddressData) {
            $this->attributes['address'] = $data;
            return $this;
        }

        $this->attributes['address'] = new AddressData();
        $this->attributes['address']->fill($data);
    }

    public function toArray()
    {
        $data = [
            'name'        => $this->name,
            'lastName'    => $this->lastName,
            'birthDate'   => $this->birthDate,
            'nationality' => $this->nationality,
            'taxDocument' => $this->taxDocument->toArray(),
            'phone'       => $this->phone->toArray(),
            'address'     => $this->address->toArray(),
        ];

        if ($this->identityDocument instanceof IdentityDocumentData) {
            $data['identityDocument'] = $this->identityDocument->toArray();
        }

        return $data;
    }
}
