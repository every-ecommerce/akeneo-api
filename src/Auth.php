<?php

namespace Every\Akeneo\Api;

class Auth
{
    const BASE_PATH = '/api/oauth/v1/token';

    const REFRESH_TIME = 3500;

    protected $settings;

    protected $lastRefresh;

    protected $accessToken;

    protected $refreshToken;

    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    public function getToken()
    {
        if (!$this->accessToken) {
            $this->generateToken();
        } elseif ($this->needsRefresh()) {
            $this->refreshToken();
        }

        return $this->accessToken;
    }

    protected function needsRefresh()
    {
        return time() - $this->lastRefresh > self::REFRESH_TIME;
    }

    protected function generateToken()
    {
        $username = $this->settings->getUsername();
        $password = $this->settings->getPassword();

        $this->callForToken([
            'grant_type' => 'password',
            'username' => $username,
            'password' => $password,
        ]);
    }

    protected function refreshToken()
    {
        $this->callForToken([
            'grant_type' => 'refresh_token',
            'refresh_token' => $this->refreshToken,
        ]);
    }

    protected function callForToken($params)
    {
        $host = $this->settings->getHost();
        $clientId = $this->settings->getClientId();
        $secret = $this->settings->getSecret();
        $encoded = base64_encode("$clientId:$secret");

        $curl = curl_init($host.self::BASE_PATH);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            "Authorization: Basic {$encoded}",
        ));
        $response = json_decode(curl_exec($curl), true);

        curl_close($curl);

        $this->accessToken = $response['access_token'];
        $this->refreshToken = $response['refresh_token'];
        $this->lastRefresh = time();
    }

    public function getSettings()
    {
        return $this->settings;
    }
}
