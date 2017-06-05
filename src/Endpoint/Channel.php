<?php

namespace Every\Akeneo\Api\Endpoint;

use Every\Akeneo\Api\Client;

class Channel extends AbstractEndpoint
{
    protected $supportsCreate = false;
    protected $supportsUpdate = false;
    protected $supportsMultiupdate = false;

    protected function getBaseEndpoint()
    {
        return '/channels';
    }
}
