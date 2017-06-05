<?php

namespace Every\Akeneo\Api\Endpoint;

use Every\Akeneo\Api\Client;

class Attribute extends AbstractEndpoint
{
    protected $supportsDelete = false;

    protected function getBaseEndpoint()
    {
        return '/attributes';
    }
}
