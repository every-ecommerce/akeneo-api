<?php

namespace Every\Akeneo\Api\Endpoint;

use Every\Akeneo\Api\Client;

class Product extends AbstractEndpoint
{
    protected function getBaseEndpoint()
    {
        return '/products';
    }
}
