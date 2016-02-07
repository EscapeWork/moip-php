<?php

namespace EscapeWork\Moip\Data;

class IdentityDocumentData extends Data
{

    /**
     * Fillable attributes
     */
    protected $fillable = [
        'type',
        'number',
        'issuer',
        'issueDate',
    ];

    public function getType()
    {
        return $this->type ?: 'RG';
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getIssuer()
    {
        return $this->issuer;
    }

    public function getIssueDate()
    {
        return $this->issueDate;
    }

    public function setNumberAttribute($number)
    {
        $this->attributes['number'] = filter_var($number, FILTER_SANITIZE_NUMBER_INT);
    }

    public function toArray()
    {
        return [
            'type'      => $this->getType(),
            'number'    => $this->getNumber(),
            'issuer'    => $this->getIssuer(),
            'issueDate' => $this->issueDate(),
        ];
    }
}
