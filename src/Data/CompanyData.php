<?php

namespace EscapeWork\Moip\Data;

use EscapeWork\Moip\Data\AddressData;

class CompanyData extends Data
{

    /**
     * Fillable attributes
     */
    protected $fillable = [
        'name',
        'businessName',
        'taxDocument',
        'cnpj',
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
        $this->attributes['taxDocument']->type = 'CNPJ';
        $this->attributes['taxDocument']->fill($data);
    }

    public function setCnpjAttribute($cnpj)
    {
        if (! isset($this->attributes['taxDocument'])) {
            $this->attributes['taxDocument'] = new TaxDocumentData;
        }

        $this->attributes['taxDocument']->type   = 'CNPJ';
        $this->attributes['taxDocument']->number = $cnpj;
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
        return [
            'name'         => $this->name,
            'businessName' => $this->businessName,
            'taxDocument'  => $this->taxDocument->toArray(),
            'phone'        => $this->phone->toArray(),
            'address'     => $this->address->toArray(),
        ];
    }
}
