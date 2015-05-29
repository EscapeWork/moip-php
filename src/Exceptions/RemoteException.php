<?php namespace EscapeWork\Moip\Exceptions;

use ErrorException;

class RemoteException extends ErrorException
{

    protected $error = array();

    public function setError($error)
    {
        $this->error = $error;
        return $this;
    }

    public function getError()
    {
        return $this->error;
    }
}
