<?php

namespace EscapeWork\Moip\Resources;

use EscapeWork\Moip\Exceptions\RemoteException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Subscription extends Resource
{

    /**
     * API endpoints
     */
    protected $endpoint = [
        'production' => 'https://api.moip.com.br/assinaturas/v1/',
        'sandbox'    => 'https://sandbox.moip.com.br/assinaturas/v1/',
    ];

    /**
     * Models needed
     */
    protected $required = [
        'customer',
        'address',
        'credit_card',
        'plan',
    ];

    public function create($id, $options = array())
    {
        $options = array_merge([
            'new_customer' => true,
        ], $options);

        $data    = [
            'code'     => $id,
            'plan'     => $this->getPlanData(),
            'customer' => $this->getCustomerData(),
        ];

        try {
            $response = $this->config->client->post('subscriptions?new_customer=' . ($options['new_customer'] ? 'true' : 'false'), [
                'json' => $data,
            ]);

            return json_decode($response->getBody()->getContents());
        }
        catch (ClientException $e) {
            $contents  = json_decode($e->getResponse()->getBody()->getContents());
            $exception = new RemoteException($e->getMessage());

            $exception->setError(isset($contents->errors) ? $contents->errors[0] : '');

            throw $exception;
        }
    }

    public function update($id, $options = array())
    {
        $data = ['plan' => $this->getPlanData()];

        try {
            $response = $this->config->client->put('subscriptions/' . $id, [
                'json' => $data,
            ]);

            return json_decode($response->getBody()->getContents());
        }
        catch (ClientException $e) {
            $contents  = json_decode($e->getResponse()->getBody()->getContents());
            $exception = new RemoteException($e->getMessage());

            $exception->setError(isset($contents->errors) ? $contents->errors[0] : '');

            throw $exception;
        }
    }

    public function invoices($subscription_code)
    {
        try {
            $response = $this->config->client->get('subscriptions/'.$subscription_code.'/invoices');

            return json_decode($response->getBody()->getContents());
        }
        catch (ClientException $e) {
            $contents  = json_decode($e->getResponse()->getBody()->getContents());
            $exception = new RemoteException($e->getMessage());

            $exception->setError(isset($contents->errors) ? $contents->errors[0] : '');

            throw $exception;
        }
    }

    protected function getPlanData()
    {
        return ['code' => $this->plan->getCode()];
    }

    protected function getCustomerData()
    {
        return [
            'code'            => $this->customer->getCode(),
            'email'           => $this->customer->getEmail(),
            'fullname'        => $this->customer->getFullname(),
            'cpf'             => $this->customer->getCpf(),
            'phone_number'    => $this->customer->getPhoneNumber(),
            'phone_area_code' => $this->customer->getPhoneAreaCode(),
            'birthdate_day'   => $this->customer->getBirthdateDay(),
            'birthdate_month' => $this->customer->getBirthdateMonth(),
            'birthdate_year'  => $this->customer->getBirthdateYear(),

            # address
            'address' => $this->getAdddressData(),

            # billing_info
            'billing_info' => [
                'credit_card' => $this->getCreditCardData(),
            ],
        ];
    }

    protected function getAdddressData()
    {
        return [
            'street'     => $this->address->getStreet(),
            'number'     => $this->address->getNumber(),
            'complement' => $this->address->getComplement(),
            'district'   => $this->address->getDistrict(),
            'city'       => $this->address->getCity(),
            'state'      => $this->address->getState(),
            'country'    => $this->address->getCountry(),
            'zipcode'    => $this->address->getZipcode(),
        ];
    }

    protected function getCreditCardData()
    {
        return [
            'holder_name'      => $this->credit_card->getHolderName(),
            'number'           => $this->credit_card->getNumber(),
            'expiration_month' => $this->credit_card->getExpirationMonth(),
            'expiration_year'  => $this->credit_card->getExpirationYear(),
        ];
    }
}
