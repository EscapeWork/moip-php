<?php

namespace EscapeWork\Moip\Data;

use EscapeWork\Moip\Contracts\PlanContract;

class Plan extends Data implements PlanContract
{

    /**
     * Fillable attributes
     */
    protected $fillable = [
        'code',
    ];

    public function getCode()
    {
        return $this->code;
    }
}
