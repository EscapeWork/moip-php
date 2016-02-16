<?php

namespace EscapeWork\Moip\Resources;

use EscapeWork\Moip\Data\FundingInstrumentData;
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
     * API endpoints
     */
    protected $endpoint = [
        'production' => '',
        'sandbox'    => 'https://sandbox.moip.com.br/v2/transfers',
    ];

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
            $response = $this->config->client->post('/', [
                'debug' => false,
                'json'  => $data,
            ]);

            return json_decode($response->getBody()->getContents());
        }
        catch (ClientException $e) {
            $this->handleClientException($e, $data);
        }
        catch (Exception $e) {
            $this->handleExcpetion($e);
        }
    }

    public function setData($data)
    {
        $this->transferData = new TransferData();
        $this->transferData->fill($data);
        return $this;
    }
}
