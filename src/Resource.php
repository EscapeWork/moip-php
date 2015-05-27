<?php namespace EscapeWork\Moip;

abstract class Resource
{

    /**
     * @var  EscapeWork\Moip\Config
     */
    protected $config;

    public function __construct($config = null)
    {
        $this->config = $config ?: Config::getInstance();
    }
}
