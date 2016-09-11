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

    /**
     * API endpoints
     */
    protected $endpoints = [
        'api' => [
            'production' => 'https://api.moip.com.br/v2/',
            'sandbox'    => 'https://sandbox.moip.com.br/v2/',
        ],

        'connect' => [
            'production' => 'https://connect.moip.com.br/',
            'sandbox'    => 'https://connect-sandbox.moip.com.br/',
        ],
    ];

    public function __construct($config = null)
    {
        $this->config = $config ?: Config::getInstance();

        if (! $this->config->configured()) {
            $this->config->configure([
                'endpoint' => $this->endpoints['api'][$this->config->getEnvironment()],
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

    public function setAccessToken($token)
    {
        $this->config->setAppAccessToken($token);
        $this->config->configure([
            'endpoint' => $this->endpoints['api'][$this->config->getEnvironment()],
            'auth'     => $this->auth,
        ]);

        return $this;
    }

    public function handleClientException(ClientException $e, $data = [])
    {
        $contents           = json_decode($e->getResponse()->getBody()->getContents());
        $exception          = new RemoteException($e->getMessage());
        $exception->data    = $data;
        $exception->headers = $e->getRequest()->getHeaders();

        $exception->setCode(isset($contents->errors) ? $contents->errors[0]->code : null);
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
