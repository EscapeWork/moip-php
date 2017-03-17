<?php

namespace EscapeWork\Moip\Resources;

use EscapeWork\Moip\Exceptions\RemoteException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class OAuthAuthorization extends Resource
{
    /**
     * Models needed
     */
    protected $required = [
        'response_type',
        'client_id',
        'redirect_uri',
    ];

    public function generateAuthorizationLink()
    {
        $data = [
            'response_type' => 'code',
            'client_id'     => $this->client_id,
            'redirect_uri'  => $this->redirect_uri,
        ];

        $endpoint = $this->endpoints['connect'][$this->config->getEnvironment()];

        return $endpoint . 'oauth/authorize?' . http_build_query($data);
    }

    public function setClientId($client_id)
    {
        $this->client_id = $client_id;
        return $this;
    }

    public function setRedirectUri($redirect_uri)
    {
        $this->redirect_uri = $redirect_uri;
        return $this;
    }
}
