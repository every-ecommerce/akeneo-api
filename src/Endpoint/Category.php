<?php

namespace Every\Akeneo\Api\Endpoint;

class Category extends AbstractEndpoint
{
    protected $supportsDelete = false;

    protected function getBaseEndpoint()
    {
        return '/categories';
    }
}
