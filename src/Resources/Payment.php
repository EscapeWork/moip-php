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
        'fundingInstrument',
    ];

    public function execute($order)
    {
        try {
            $response = $this->config->client->post('https://sandbox.moip.com.br/v2/orders/'.$order['id'].'/payments', [
                'debug' => false,
                'json'  => $data,
            ]);

            return json_decode($response->getBody()->getContents());
        }
        catch (\Exception $e) {
            dd('ERROR', $e->getResponse());
            $contents  = json_decode($e->getResponse()->getBody()->getContents());
            $exception = new RemoteException($e->getMessage());

            $exception->setError(isset($contents->errors) ? $contents->errors[0] : '');

            throw $exception;
        }
    }

    public function setFundingInstrument($fundingInstrument)
    {
        $this->fundingInstrument = new FundingInstrumentData($data);
        return $this;
    }
}
