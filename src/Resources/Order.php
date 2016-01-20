<?php

namespace EscapeWork\Moip\Resources;

use EscapeWork\Moip\Exceptions\RemoteException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Order extends Resource
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
        'customer',
    ];

    /**
     * @var array
     */
    public $items;

    public function create()
    {
        $data = [
            'ownId'  => $this->order->getOwnId(),
            'amount' => [
                'currency'  => $this->order->getCurrency(),
                'subtotals' => [
                    'shipping' => $this->order->getShipping(),
                ],
            ],

            'items'    => $this->getItemsData(),
            'customer' => $this->getCustomerData(),
        ];
    }

    protected function getItemsData()
    {
        return [];
    }

    protected function getCustomerData()
    {
        return [];
    }
}
