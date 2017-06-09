<?php

namespace Every\Akeneo\Api;

class Client
{
    const BASE_PATH = '/api/rest/v1';

    const CONTENT_JSON = 'application/json';
    const CONTENT_FORM = 'multipart/form-data';
    const CONTENT_AKENEO = 'application/vnd.akeneo.collection+json';

    protected $settings;

    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->settings = $auth->getSettings();
        $this->auth = $auth;
    }

    public function call($type, $endpoint, $params = null, $contentType = self::CONTENT_JSON, $jsonDecode = true)
    {
        $host = $this->settings->getHost();
        $token = $this->auth->getToken();
        $url = $host.self::BASE_PATH.$endpoint;

        if ($params && $type === 'GET') {
            $curl = curl_init($url.'?'.http_build_query($params));
        } else {
            $curl = curl_init($url);
        }

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "Content-Type: {$contentType}",
            "Authorization: Bearer {$token}",
        ]);

        if ($type === 'POST') {
            curl_setopt($curl, CURLOPT_POST, true);
        } elseif ($type !== 'GET') {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $type);
        } else {
            curl_setopt($curl, CURLOPT_POST, false);
        }

        if ($params && $type !== 'GET') {
            if ($contentType === self::CONTENT_JSON) {
                $params = json_encode($params);
            }

            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        }

        $response = curl_exec($curl);

        if ($jsonDecode) {
            $response = json_decode($response, true);
        }

        curl_close($curl);

        return $response;
    }

    public function __call($method, $arguments) {
        return $this->call(
            strtoupper($method),
            $arguments[0],
            isset($arguments[1]) ? $arguments[1] : null,
            isset($arguments[2]) ? $arguments[2] : self::CONTENT_JSON,
            isset($arguments[3]) ? $arguments[3] : true
        );
    }
}
