<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class EskizSmsClient
{
    public $baseUrl;
    private $token;
    private $tokenLifetime;
    private $client;
    private $email;
    private $password;
    private $sender;

    public function __construct()
    {
        $this->loadConfig();
        $this->client = new Client([
            'base_uri' => $this->baseUrl
        ]);
        $this->login();
    }

    private function loadConfig(): void
    {
        $this->baseUrl = config('sms.api_url');
        $this->tokenLifetime = config('sms.token_lifetime');
        $this->email = config('sms.email');
        $this->password = config('sms.password');
        $this->sender = config('sms.from');
    }

    private function login()
    {
        $this->token = cache()->remember(/**
         * @throws GuzzleException
         */ 'sms_auth_token', $this->tokenLifetime, function () {
            $res = $this->sendRequest('POST', 'auth/login', [
                'form_params' => [
                    'email' => $this->email,
                    'password' => $this->password
                ]
            ]);
            return $res['data']['token'];
        });

    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    private function sendRequest($method, $uri, $options = [])
    {
        if ($this->token) {
            $options['headers']['Authorization'] = "Bearer {$this->token}";
        }
        if (in_array($method, ['GET', 'POST', 'PATCH', 'DELETE', 'PUT'])) {
            $res = $this->client->request($method, $uri, $options);
            if ($res->getStatusCode() === 200) {
                return json_decode($res->getBody()->getContents(), true);
            }
            throw new Exception('Bad status code on response');
        } else {
            throw new Exception('Method not found');
        }
    }

    /**
     * @throws GuzzleException
     */
    public function send(string $number, string $text)
    {
        return $this->sendRequest('POST', 'message/sms/send', [
            'form_params' => [
                'mobile_phone' => $number,
                'message' => $text,
                'from' => $this->sender
            ],
        ]);
    }

    /**
     * @throws GuzzleException
     */
    public function about()
    {
        return $this->sendRequest('GET', 'auth/user');
    }

    /**
     * @throws GuzzleException
     */
    public function limits()
    {
        return $this->sendRequest('GET', 'user/get-limit');
    }
}
