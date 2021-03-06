<?php

namespace EscapeWork\Moip\Resources;

use EscapeWork\Moip\Config;
use EscapeWork\Moip\Data\BankAccountData;
use EscapeWork\Moip\Exceptions\RemoteException, Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class BankAccount extends Resource
{
    /**
     * Authentication method
     */
    protected $auth = Config::AUTH_OAUTH;

    /**
     * Models needed
     */
    protected $required = [
        'data',
    ];

    public function create($account_id)
    {
        $data = $this->getData();

        try {
            $response = $this->config->client->post('accounts/'.$account_id.'/bankaccounts', [
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

    public function update($id)
    {
        $data = $this->getData();

        try {
            $response = $this->config->client->put('bankaccounts/' . $id, [
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

    public function setData($data)
    {
        $this->data = new BankAccountData();
        $this->data->fill($data);

        return $this;
    }

    protected function getData()
    {
        return $this->data->toArray();
    }
}
