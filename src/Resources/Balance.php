<?php

namespace EscapeWork\Moip\Resources;

use EscapeWork\Moip\Config;
use EscapeWork\Moip\Exceptions\RemoteException;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Balance extends Resource
{

    /**
     * Authentication method
     */
    protected $auth = Config::AUTH_OAUTH;

    /**
     * Models needed
     */
    protected $required = [];

    public function get($id)
    {
        try {
            $response = $this->config->client->get('balances', [
                'debug' => false,
            ]);

            return json_decode($response->getBody()->getContents());
        }
        catch (ClientException $e) {
            $this->handleClientException($e, ['']);
        }
        catch (Exception $e) {
            $this->handleException($e);
        }
    }
}
