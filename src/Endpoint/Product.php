<?php

namespace Every\Akeneo\Api\Endpoint;

class Product extends AbstractEndpoint
{
    protected function getBaseEndpoint()
    {
        return '/products';
    }
}
