<?php

namespace Every\Akeneo\Api\Endpoint;

class Locale extends AbstractEndpoint
{
    protected $supportsCreate = false;
    protected $supportsUpdate = false;
    protected $supportsMultiupdate = false;

    protected function getBaseEndpoint()
    {
        return '/locales';
    }
}
