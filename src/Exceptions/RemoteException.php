<?php

namespace EscapeWork\Moip\Exceptions;

use ErrorException;

class RemoteException extends ErrorException
{
    /**
     * @var array
     */
    protected $error = [];

    /**
     * @var string
     */
    protected $code;

    /**
     * @var array
     */
    public $data;

    /**
     * @var array
     */
    public $headers;

    public function setError($error)
    {
        $this->error = $error;
        return $this;
    }

    public function getError()
    {
        return $this->error;
    }

    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    public function getCode()
    {
        return $this->code;
    }
}
