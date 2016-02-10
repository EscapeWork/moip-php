<?php

namespace EscapeWork\Moip;

use GuzzleHttp\Client;

class Config
{

    const AUTH_HTTP  = 'http';
    const AUTH_OAUTH = 'oauth';

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
     * App ID
     */
    protected $appId;

    /**
     * App Access Token
     */
    protected $appAccessToken;

    /**
     * Environment
     */
    protected $environment = 'production';

    /**
     * @var  Guzzle\Http\Client
     */
    public $client;

    public function configure($options = [])
    {
        $this->client = new Client([
            'base_uri' => $options['endpoint'],
            'headers'  => [
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
                'Authorization' => $this->getAuthorizationString($options['auth'])
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

    public function setAppId($appId)
    {
        $this->appId = $appId;
        return $this;
    }

    public function setAppAccessToken($appAccessToken)
    {
        $this->appAccessToken = $appAccessToken;
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

    protected function getOauthKey()
    {
        return $this->appAccessToken;
    }

    public function getAuthorizationString($auth)
    {
        if ($auth == 'oauth') {
            return 'OAuth ' . $this->getOauthKey();
        }

        return 'Basic ' . $this->getAuthorizationKey();
    }
}
