<?php

namespace Every\Akeneo\Api\Endpoint;

use Every\Akeneo\Api\Client;

class MediaFile extends AbstractEndpoint
{
    protected $supportsUpdate = false;
    protected $supportsMultiupdate = false;

    protected function getBaseEndpoint()
    {
        return '/media-files';
    }

    public function create($params)
    {
        return $this->client
            ->post($this->getBaseEndpoint(), $params, Client::CONTENT_FORM);
    }

    public function download($code)
    {
        return $this->client->get(
            "{$this->getBaseEndpoint()}/{$code}/download",
            null,
            Client::CONTENT_JSON,
            false
        );
    }
}
