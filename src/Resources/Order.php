<?php

namespace EscapeWork\Moip\Resources;

use EscapeWork\Moip\Data\CustomerData;
use EscapeWork\Moip\Data\ItemData;
use EscapeWork\Moip\Data\OrderData;
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
        'order',
        'customer',
    ];

    /**
     * @var array
     */
    public $items = [];

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

    public function setOrder($data = [])
    {
        $this->order = new OrderData($data);
        return $this;
    }

    public function setItem($data = [])
    {
        $this->items[] = new ItemData($data);
        return $this;
    }

    public function setCustomer($data = [])
    {
        $this->customer = new CustomerData($data);
        return $this;
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
