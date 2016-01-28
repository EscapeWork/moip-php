<?php namespace EscapeWork\Moip\Exceptions;

use ErrorException;

class RemoteException extends ErrorException
{

    /**
     * @var array
     */
    protected $error = array();

    /**
     * @var array
     */
    public $data;

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
