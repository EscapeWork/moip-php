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
        'taxDocument',
    ];

    public function getfullname()
    {
        return $this->fullname;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function taxDocument()
    {
        return $this->taxDocument;
    }
}
