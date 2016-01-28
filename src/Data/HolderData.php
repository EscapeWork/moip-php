<?php

namespace EscapeWork\Moip\Data;

class HolderData extends Data
{

    /**
     * Fillable attributes
     */
    protected $fillable = [
        'fullname',
        'birthdate',
        'cpf',
        'taxDocument',
        'phone',
    ];

    public function getFullname()
    {
        return $this->fullname;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function getTaxDocument()
    {
        return $this->taxDocument;
    }

    public function setCpfAttribute($cpf)
    {
        if (! isset($this->attributes['taxDocument'])) {
            $this->attributes['taxDocument'] = new TaxDocumentData;
        }

        $this->attributes['taxDocument']->number = $cpf;
    }

    public function setTaxDocumentAttribute($data)
    {
        $this->taxDocument = new TaxDocumentData($data);
    }

    public function setPhoneData($data)
    {
        $this->phone = new PhoneData($data);
    }

    public function toArray()
    {
        $data = [
            'fullname'    => $this->getFullname(),
            'birthdate'   => $this->getBirthdate(),
        ];

        if ($this->taxDocument) {
            $data['taxDocument'] = $this->taxDocument->toArray();
        }

        if ($this->phone) {
            $data['phone'] = $this->phone->toArray();
        }

        return $data;
    }
}
