<?php 

namespace EscapeWork\Moip\Models;

use EscapeWork\Moip\Contracts\PlanContract;

class Plan extends Model implements PlanContract
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
