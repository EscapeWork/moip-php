<?php

namespace EscapeWork\Moip\Resources;

use EscapeWork\Moip\Config;
use EscapeWork\Moip\Data\CompanyData;
use EscapeWork\Moip\Data\EmailData;
use EscapeWork\Moip\Data\PersonData;
use EscapeWork\Moip\Exceptions\RemoteException;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Account extends Resource
{

    /**
     * Authentication method
     */
    protected $auth = Config::AUTH_OAUTH;

    /**
     * Models needed
     */
    protected $required = [
        'email',
        'person',
        'company',
        'type',
        'transparentAccount',
    ];

    public function create()
    {
        $data = $this->getData();

        try {
            $response = $this->config->client->post('accounts', [
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

    public function setTransparentAccount($transparentAccount)
    {
        $this->transparentAccount = $transparentAccount;
        return $this;
    }

    public function setEmail($address)
    {
        if (! is_array($address)) {
            $address = ['address' => $address];
        }

        $this->email = new EmailData();
        $this->email->fill($address);
        return $this;
    }

    public function setPerson($data)
    {
        $this->person = new PersonData();
        $this->person->fill($data);
        return $this;
    }

    public function setCompany($data)
    {
        $this->company = new CompanyData($data);
        $this->company->fill($data);
        return $this;
    }

    public function getType()
    {
        return $this->type ?: 'MERCHANT';
    }

    public function getTransparentAccount()
    {
        return $this->transparentAccount ?: false;
    }

    public function getData()
    {
        $data = [
            'email'              => $this->email->toArray(),
            'person'             => $this->person->toArray(),
            'type'               => $this->getType(),
            'transparentAccount' => $this->getTransparentAccount(),
        ];

        if ($this->company instanceof CompanyData) {
            $data['company'] = $this->company->toArray();
        }

        return $data;
    }
}
