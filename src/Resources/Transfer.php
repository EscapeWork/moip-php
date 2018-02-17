<?php

namespace EscapeWork\Moip\Resources;

use EscapeWork\Moip\Config;
use EscapeWork\Moip\Data\TransferData;
use EscapeWork\Moip\Exceptions\RemoteException;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Transfer extends Resource
{
    /**
     * Authentication method
     */
    protected $auth = Config::AUTH_OAUTH;

    /**
     * Transfer methods
     */
    const MOIP_ACCOUNT = 'MOIP_ACCOUNT';
    const BANK_ACCOUNT = 'BANK_ACCOUNT';

    /**
     * Transfer status
     */
    const STATUS_FAILED = 'FAILED';
    const STATUS_PENDING = 'PENDING';
    const STATUS_COMPLETED = 'COMPLETED';

    /**
     * Models needed
     */
    protected $required = [
        'transferData',
    ];

    public function create()
    {
        $data = $this->transferData->toArray();

        try {
            $response = $this->config->client->post('transfers', [
                'debug' => false,
                'json'  => $data,
            ]);

            return json_decode($response->getBody()->getContents());
        }
        catch (ClientException $e) {
            $this->handleClientException($e, $data);
        }
        catch (Exception $e) {
            $this->handleException($e);
        }
    }

    public function reverse($code)
    {
        try {
            $response = $this->config->client->post(sprintf('transfers/%s/reverse', $code), [
                'debug' => false,
            ]);

            return json_decode($response->getBody()->getContents());
        }
        catch (ClientException $e) {
            $this->handleClientException($e, $data);
        }
        catch (Exception $e) {
            $this->handleException($e);
        }
    }

    public function get($code)
    {
        try {
            $response = $this->config->client->get('transfers/' . $code, [
                'debug' => false,
            ]);

            return json_decode($response->getBody()->getContents());
        }
        catch (ClientException $e) {
            $this->handleClientException($e, ['code' => $code]);
        }
        catch (Exception $e) {
            $this->handleException($e);
        }
    }

    public function setData($data)
    {
        $this->transferData = new TransferData();
        $this->transferData->fill($data);
        return $this;
    }
}
