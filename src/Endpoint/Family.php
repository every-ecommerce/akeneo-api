<?php

namespace Every\Akeneo\Api\Endpoint;

use Every\Akeneo\Api\Client;

class Family extends AbstractEndpoint
{
    protected function getBaseEndpoint()
    {
        return '/families';
    }
}
