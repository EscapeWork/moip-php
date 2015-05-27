<?php namespace EscapeWork\Moip\Resources;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Subscription extends Resource
{

    /**
     * API endpoints
     */
    protected $endpoint = [
        'production' => '',
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

    public function create()
    {
        $data = [
            'code'     => 1,
            'plan'     => $this->getPlanData(),
            'customer' => $this->getCustomerData(),
        ];

        try {
            $request = $this->config->client->createRequest('POST', 'subscriptions?new_customer=true', [
                'debug' => true,
                'json'  => $data,
            ]);

            dd($request->getBody());

            dd($response->json());
        }
        catch (ClientException $e) {
            dd($e->getResponse());
        }
    }

    public function getPlanData()
    {
        return ['code' => $this->plan->getCode()];
    }

    public function getCustomerData()
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

    public function getAdddressData()
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

    public function getCreditCardData()
    {
        return [
            'holder_name'      => $this->credit_card->getHolderName(),
            'number'           => $this->credit_card->getNumber(),
            'expiration_month' => $this->credit_card->getNumber(),
            'expiration_year'  => $this->credit_card->getNumber(),
        ];
    }
}
