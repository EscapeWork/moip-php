<?php

namespace EscapeWork\Moip\Data\Subscriptions;

use EscapeWork\Moip\Data\Data;

class PlanData extends Data
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
