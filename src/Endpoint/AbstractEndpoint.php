<?php

namespace Every\Akeneo\Api\Endpoint;

use Every\Akeneo\Api\Client;

abstract class AbstractEndpoint
{
    const LIMIT = 10;

    protected $client;

    protected $supportsList = true;
    protected $supportsGet = true;
    protected $supportsCreate = true;
    protected $supportsUpdate = true;
    protected $supportsDelete = true;
    protected $supportsMultiupdate = true;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    protected abstract function getBaseEndpoint();

    protected function checkSupport($action)
    {
        if (!$this->{"supports$action"}) {
            throw new \Exception("{$action} is not supported for this element.");
        }
    }

    public function listItems($page = 1, $limit = self::LIMIT, $extra = [])
    {
        $this->checkSupport('List');

        $params = array_merge([
            'page' => $page,
            'limit' => $limit,
            'with_count' => 'false',
            'pagination_type' => 'page',
        ], $extra);

        return $this->client->get($this->getBaseEndpoint(), $params);
    }

    public function get($code)
    {
        $this->checkSupport('Get');

        return $this->client->get("{$this->getBaseEndpoint()}/{$code}");
    }

    public function update($code, $params)
    {
        $this->checkSupport('Update');

        return $this->client->patch("{$this->getBaseEndpoint()}/{$code}", $params);
    }

    public function create($params)
    {
        $this->checkSupport('Create');

        return $this->client->post($this->getBaseEndpoint(), $params);
    }

    public function delete($code)
    {
        $this->checkSupport('Delete');

        return $this->client->delete("{$this->getBaseEndpoint()}/{$code}");
    }

    public function multiupdate($params)
    {
        $this->checkSupport('Multiupdate');

        return $this->client
            ->patch($this->getBaseEndpoint(), $params, Client::CONTENT_AKENEO);
    }
}
