<?php

namespace EscapeWork\Moip\Data;

class InstructionLinesData extends Data
{

    /**
     * Fillable attributes
     */
    protected $fillable = [
        'first',
        'second',
        'third',
    ];

    public function getFirst()
    {
        return $this->first;
    }

    public function getSecond()
    {
        return $this->second;
    }

    public function getThird()
    {
        return $this->third;
    }

    public function toArray()
    {
        return [
            'first'  => $this->first,
            'second' => $this->second,
            'third'  => $this->third,
        ];
    }
}
