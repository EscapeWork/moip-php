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
        'sandbox'    => 'https://sandbox.moip.com.br/v2/orders',
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

        try {
            $response = $this->config->client->post('https://sandbox.moip.com.br/v2/orders', [
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
        $data = [];

        foreach ($this->items as $item) {
            $data[] = [
                'product'  => $item->getProduct(),
                'quantity' => $item->getQuantity(),
                'detail'   => $item->getDetail(),
                'price'    => $item->getPrice(),
            ];
        }

        return $data;
    }

    protected function getCustomerData()
    {
        return [
            'ownId'     => $this->customer->getOwnId(),
            'fullname'  => $this->customer->getFullname(),
            'email'     => $this->customer->getEmail(),
            'birthDate' => $this->customer->getBirthDate(),

            'taxDocument' => [
                'type'   => $this->customer->getTaxDocument()->getType(),
                'number' => $this->customer->getTaxDocument()->getNumber(),
            ],

            'phone' => [
                'countryCode' => $this->customer->getPhone()->getCountryCode(),
                'areaCode'    => $this->customer->getPhone()->getAreaCode(),
                'number'      => $this->customer->getPhone()->getNumber(),
            ],

            'shippingAddress' => [
                'street'       => $this->customer->getShippingAddress()->getStreet(),
                'streetNumber' => $this->customer->getShippingAddress()->getStreetNumber(),
                'complement'   => $this->customer->getShippingAddress()->getComplement(),
                'district'     => $this->customer->getShippingAddress()->getDistrict(),
                'city'         => $this->customer->getShippingAddress()->getCity(),
                'state'        => $this->customer->getShippingAddress()->getState(),
                'country'      => $this->customer->getShippingAddress()->getCountry(),
                'zipCode'      => $this->customer->getShippingAddress()->getZipCode(),
            ]
        ];
    }
}
