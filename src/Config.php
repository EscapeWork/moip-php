<?php 

namespace EscapeWork\Moip;

use GuzzleHttp\Client;

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
     * @var  Guzzle\Http\Client
     */
    public $client;

    public function configure($endpoint)
    {
        $this->client = new Client([
            'base_uri' => $endpoint,
            'headers'  => [
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
                'Authorization' => 'Basic ' . $this->getAuthorizationKey()
            ],
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

    public function getEnvironment()
    {
        return $this->environment;
    }

    public function configured()
    {
        return $this->client;
    }

    protected function getAuthorizationKey()
    {
        return base64_encode($this->token . ':' . $this->key);
    }
}
