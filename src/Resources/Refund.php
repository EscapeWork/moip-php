<?php

namespace EscapeWork\Moip\Resources;

use Exception;
use GuzzleHttp\Client;
use EscapeWork\Moip\Config;
use EscapeWork\Moip\Data\RefundData;
use EscapeWork\Moip\Data\TransferData;
use GuzzleHttp\Exception\ClientException;
use EscapeWork\Moip\Exceptions\RemoteException;

class Refund extends Resource
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
    const CREDIT_CARD = 'CREDIT_CARD';

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
        'refundData',
    ];

    /**
     * Refund a payment.
     */
    public function payment($paymentId)
    {
        $data = $this->refundData->toArray();

        try {
            $response = $this->config->client->post(sprintf('payments/%s/refunds', $paymentId), [
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
        $this->refundData = new RefundData();
        $this->refundData->fill($data);
        return $this;
    }
}
