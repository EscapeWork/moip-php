<?php

namespace EscapeWork\Moip\Responses;

abstract class Response
{
    /**
     * @var object
     */
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
}
