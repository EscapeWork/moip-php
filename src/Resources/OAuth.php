<?php

namespace EscapeWork\Moip\Resources;

use EscapeWork\Moip\Exceptions\RemoteException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class OAuth extends Resource
{
    /**
     * Models needed
     */
    protected $required = [
        'client_id',
        'client_secret',
        'redirect_uri',
        'code',
        'grant_type',
    ];

    public function generateAccessToken()
    {
        $data = [
            'client_id'     => $this->client_id,
            'client_secret' => $this->client_secret,
            'redirect_uri'  => $this->redirect_uri,
            'code'          => $this->code,
            'grant_type'    => 'authorization_code',
        ];
        // dd($data);
        try {
            $endpoint = $this->endpoints['connect'][$this->config->getEnvironment()];
            $response = $this->config->client->post($endpoint . 'oauth/token', [
                'debug' => false,
                'json'  => $data,
            ]);

            dd($response->getBody()->getContents());

            return json_decode($response->getBody()->getContents());
        }
        catch (ClientException $e) {
            $this->handleClientException($e, $data);
        }
        catch (Exception $e) {
            $this->handleExcpetion($e);
        }
    }

    public function setClientId($client_id)
    {
        $this->client_id = $client_id;
        return $this;
    }

    public function setClientSecret($client_secret)
    {
        $this->client_secret = $client_secret;
        return $this;
    }

    public function setRedirectUri($redirect_uri)
    {
        $this->redirect_uri = $redirect_uri;
        return $this;
    }

    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }
}
