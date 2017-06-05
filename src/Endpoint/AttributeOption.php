<?php

namespace Every\Akeneo\Api\Endpoint;

use Every\Akeneo\Api\Client;

class AttributeOption extends AbstractEndpoint
{
    protected $supportsMultiupdate = false;

    protected $attributeCode;

    public function forAttribute($attributeCode)
    {
        $this->attributeCode = $attributeCode;

        return $this;
    }

    protected function getBaseEndpoint()
    {
        if (!$this->attributeCode) {
            throw new \Exception('Set an Attribute Code before call an action.');
        }

        return "/attributes/{$this->attributeCode}/options";
    }
}
