<?php

namespace EscapeWork\Moip\Data;

class BoletoData extends Data
{

    /**
     * Fillable attributes
     */
    protected $fillable = [
        'expirationDate',
        'instructionLines',
        'logoUri',
    ];

    public function setInstructionLinesAttribute($data)
    {
        $this->instructionLines = new InstructionLinesData();
        $this->instructionLines->fill($data);
    }

    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    public function getInstructionLines()
    {
        return $this->instructionLines;
    }

    public function getLogoUri()
    {
        return $this->logoUri;
    }

    public function toArray()
    {
        return [
            'expirationDate'   => $this->expirationDate,
            'instructionLines' => $this->instructionLines->toArray(),
            'logoUri'          => $this->logoUri,
        ];
    }
}
