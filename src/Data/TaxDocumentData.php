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
}
