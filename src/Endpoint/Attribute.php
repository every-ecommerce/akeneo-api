<?php

namespace Every\Akeneo\Api\Endpoint;

class Attribute extends AbstractEndpoint
{
    protected $supportsDelete = false;

    protected function getBaseEndpoint()
    {
        return '/attributes';
    }
}
