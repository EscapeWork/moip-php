<?php

namespace EscapeWork\Moip\Resources;

use EscapeWork\Moip\Config;
use EscapeWork\Moip\Exceptions\RemoteException;
use GuzzleHttp\Exception\ClientException;
use Exception;

abstract class Resource
{

    /**
     * @var  EscapeWork\Moip\Config
     */
    protected $config;

    /**
     * @var array
     */
    protected $models = [];

    /**
     * @var array
     */
    protected $required = [];

    /**
     * Authentication method
     */
    protected $auth = 'http';

    public function __construct($config = null)
    {
        $this->config = $config ?: Config::getInstance();

        if (! $this->config->configured()) {
            $this->config->configure([
                'endpoint' => $this->endpoint[$this->config->getEnvironment()],
                'auth'     => $this->auth,
            ]);
        }
    }

    public function __set($key, $value)
    {
        if (in_array($key, $this->required)) {
            $this->models[$key] = $value;
        }
    }

    public function __get($key)
    {
        if (array_key_exists($key, $this->models)) {
            return $this->models[$key];
        }
    }

    public function handleClientException(ClientException $e, $data = [])
    {
        $contents        = json_decode($e->getResponse()->getBody()->getContents());
        $exception       = new RemoteException($e->getMessage());
        $exception->data = $data;

        $exception->setError(isset($contents->errors) ? $contents->errors[0]->description : '');

        throw $exception;
    }

    public function handleException(Exception $e)
    {
        $exception = new RemoteException($e->getMessage());
        $exception->setError('Ocorreu um erro desconhecido, por favor, tente novamente');

        throw $exception;
    }
}
