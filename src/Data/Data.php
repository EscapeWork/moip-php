<?php

namespace EscapeWork\Moip\Data;

abstract class Data
{

    /**
     * @var  array
     */
    protected $attributes = array();

    /**
     * @var  array
     */
    protected $fillable = array();

    public function __construct($data = array())
    {
        $this->fill($data);
    }

    public function fill($data)
    {
        foreach ((array) $data as $key => $value) {
            if ($this->isFillable($key)) {
                $this->setAttribute($key, $value);
            }
        }

        return $this;
    }

    public function isFillable($key)
    {
        return in_array($key, $this->fillable);
    }

    public function setAttribute($key, $value)
    {
        $this->attributes[$key] = $value;
        return $this;
    }

    public function getAttribute($key)
    {
        return $this->attributes[$key];
    }

    public function __set($key, $value)
    {
        $this->setAttribute($key, $value);
    }

    public function __get($key)
    {
        return $this->getAttribute($key);
    }
}
