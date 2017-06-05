<?php

namespace Every\Akeneo\Api;

class Settings
{
    private $host;
    private $username;
    private $password;
    private $clientId;
    private $secret;

    public function __construct($host, $username, $password, $clientId, $secret)
    {
        $this->host = $host;
        $this->clientId = $clientId;
        $this->secret = $secret;
        $this->username = $username;
        $this->password = $password;
    }

    public function getHost()
    {
        return $this->host;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getClientId()
    {
        return $this->clientId;
    }

    public function getSecret()
    {
        return $this->secret;
    }
}
