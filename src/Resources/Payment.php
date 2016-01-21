<?php

namespace EscapeWork\Moip\Resources;

use EscapeWork\Moip\Exceptions\RemoteException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Payment extends Resource
{

    /**
     * API endpoints
     */
    protected $endpoint = [
        'production' => '',
        'sandbox'    => 'https://sandbox.moip.com.br/orders/v2/',
    ];

    /**
     * Models needed
     */
    protected $required = [

    ];
}
