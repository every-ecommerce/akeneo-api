# Akeneo Api wrapper for PHP

Connect easily to the [Akeneo](https://www.akeneo.com/) Api.

**Compatible with Akeneo ^1.7**

## Install

You can install this library with composer:

```bash
composer require every/akeneo-api
```

## Usage

In orden to use any of the Akeneo endpoints, first you need to create a settings object with the akeneo host, username, password, client id and secret.
You need to create the Auth and the Client, and pass the Client object to the endpoint object.

Below an example to get a product:
```php
<?php

require_once 'vendor/autoload.php';

use Every\Akeneo\Api;
use Every\Akeneo\Api\Endpoint;

$settings = new Api\Settings(
    'http://akeneohost.com', // Akeneo Host
    'myuser',                // User Username
    'mypass',                // User Password
    'myclientid',            // Client ID
    'mysecret'               // Secret
);
$auth = new Api\Auth($settings);
$client = new Api\Client($auth);
$product = new Endpoint\Product($client);

var_dump($product->get('product_sku'));
```

For more information about the Akeneo Api see its [docs](https://api.akeneo.com/).
