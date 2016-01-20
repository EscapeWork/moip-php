<?php

namespace EscapeWork\Moip\Data;

class ItemData extends Data
{

    /**
     * Fillable attributes
     */
    protected $fillable = [
        'product',
        'quantity',
        'detail',
        'price',
    ];

    public function getProduct()
    {
        return $this->product;
    }

    public function getQuantity()
    {
        return $this->quantity ?: 1;
    }

    public function getDetail()
    {
        return $this->detail;
    }

    public function getPrice()
    {
        return $this->price;
    }
}
