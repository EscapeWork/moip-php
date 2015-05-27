<?php namespace EscapeWork\Moip\Resources;

use EscapeWork\Moip\Config;

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

    public function __construct($config = null)
    {
        $this->config = $config ?: Config::getInstance();

        if (! $this->config->configured()) {
            $this->config->configure($this->endpoint[$this->config->getEnvironment()]);
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
}
