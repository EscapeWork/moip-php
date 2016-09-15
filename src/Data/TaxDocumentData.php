<?php

namespace EscapeWork\Moip\Data;

class TaxDocumentData extends Data
{
    /**
     * Fillable attributes
     */
    protected $fillable = [
        'type',
        'number',
    ];

    public function getType()
    {
        return $this->type ?: 'CPF';
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumberAttribute($number)
    {
        $this->attributes['number'] = filter_var($number, FILTER_SANITIZE_NUMBER_INT);
    }

    public function toArray()
    {
        return [
            'type'   => $this->getType(),
            'number' => $this->getNumber(),
        ];
    }
}
