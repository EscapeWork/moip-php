<?php

namespace EscapeWork\Moip\Resources;

use EscapeWork\Moip\Data\FundingInstrumentData;
use EscapeWork\Moip\Exceptions\RemoteException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Exception;

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
        'installmentCount',
        'fundingInstrument',
    ];

    public function execute($order)
    {
        $data = [
            'installmentCount'  => $this->getInstallmentCount(),
            'fundingInstrument' => $this->fundingInstrument->toArray(),
        ];

        try {
            $response = $this->config->client->post('https://sandbox.moip.com.br/v2/orders/'.$order->id.'/payments', [
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

    public function getInstallmentCount()
    {
        return $this->installmentCount ?: 1;
    }

    public function setFundingInstrument($data)
    {
        $this->fundingInstrument = new FundingInstrumentData($data);
        return $this;
    }
}
