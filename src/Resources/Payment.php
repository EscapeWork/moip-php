<?php

namespace EscapeWork\Moip\Resources;

use EscapeWork\Moip\Data\FundingInstrumentData;
use EscapeWork\Moip\Exceptions\RemoteException;
use EscapeWork\Moip\Responses\PaymentResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Exception;

class Payment extends Resource
{
    /**
     * Models needed
     */
    protected $required = [
        'installmentCount',
        'fundingInstrument',
    ];

    /**
     * @var string
     */
    protected $statementDescriptor;

    public function execute($order)
    {
        $data = array_filter([
            'installmentCount'  => $this->getInstallmentCount(),
            'statementDescriptor'  => $this->getStatementDescriptor(),
            'fundingInstrument' => $this->fundingInstrument->toArray(),
        ]);

        try {
            $response = $this->config->client->post('orders/'.$order->id.'/payments', [
                'debug' => false,
                'json'  => $data,
            ]);

            return new PaymentResponse(json_decode($response->getBody()->getContents()));
        }
        catch (ClientException $e) {
            $this->handleClientException($e, $data);
        }
        catch (Exception $e) {
            $this->handleException($e);
        }
    }

    public function getInstallmentCount()
    {
        return $this->installmentCount ?: 1;
    }

    public function setStatementDescriptor($statementDescriptor)
    {
        $this->statementDescriptor = $statementDescriptor;
        return $this;
    }

    public function getStatementDescriptor()
    {
        return $this->statementDescriptor;
    }

    public function setFundingInstrument($data)
    {
        $this->fundingInstrument = new FundingInstrumentData($data);
        return $this;
    }

    public function setCreditCard($data)
    {
        $this->fundingInstrument->creditCard = $data;
    }

    public function setBoleto($data)
    {
        $this->fundingInstrument->boleto = $data;
    }
}
