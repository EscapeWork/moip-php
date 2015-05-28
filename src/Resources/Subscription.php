<?php namespace EscapeWork\Moip\Resources;

use EscapeWork\Moip\Exceptions\HttpException;
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

    public function create($id)
    {
        $data = [
            'code'     => $id,
            'plan'     => $this->getPlanData(),
            'customer' => $this->getCustomerData(),
        ];

        try {
            $response = $this->config->client->post('subscriptions?new_customer=true', [
                'json' => $data,
            ]);

            return $response->getBody();
        }
        catch (ClientException $e) {
            throw new HttpException($e->getMessage());
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
            'expiration_month' => $this->credit_card->getExpirationMonth(),
            'expiration_year'  => $this->credit_card->getExpirationYear(),
        ];
    }
}
