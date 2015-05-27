<?php namespace EscapeWork\Moip;

use Guzzle\Http\Client;

class Config
{

    /**
     * @var  static
     */
    public static $instance;

    /**
     * Moip token
     */
    protected $token;

    /**
     * Moip key
     */
    protected $key;

    /**
     * Environment
     */
    protected $environment = 'production';

    /**
     * API endpoints
     */
    protected $endpoints = [
        'production' => '',
        'sandbox'    => 'https://sandbox.moip.com.br/assinaturas/v1/',
    ];

    /**
     * @var  Guzzle\Http\Client
     */
    protected $client;

    public function configure()
    {
        $this->client = new Client([
            'base_uri' => $this->getEndpoint(),
        ]);
    }

    public static function getInstance()
    {
        if (! static::$instance) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    public function setEnvironment($environment)
    {
        $this->environment = $environment;
        return $this;
    }

    public function getEndpoint()
    {
        return $this->endpoints[$this->getEnvironment()];
    }

    public function getEnvironment()
    {
        return $this->environment;
    }
}
