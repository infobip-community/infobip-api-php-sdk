# Infobip API PHP SDK

[![Latest Stable Version](https://poser.pugx.org/infobip-community/infobip-api-php-sdk/v/stable)](https://packagist.org/packages/infobip-community/infobip-api-php-sdk)
[![Latest Unstable Version](https://poser.pugx.org/infobip-community/infobip-api-php-sdk/v/unstable)](https://packagist.org/packages/infobip-community/infobip-api-php-sdk)
[![Total Downloads](https://poser.pugx.org/infobip-community/infobip-api-php-sdk/downloads)](https://packagist.org/packages/infobip-community/infobip-api-php-sdk/stats)
[![License](https://poser.pugx.org/infobip-community/infobip-api-php-sdk/license)](LICENSE)

This is a PHP SDK for Infobip API and you can use it as a dependency to add [Infobip APIs](https://www.infobip.com/docs/api) to your application. To use this, you'll need an Infobip account. If you do not own one, you can create a [free account here](https://www.infobip.com/signup).

#### Table of contents:

- [General Info](#general-info)
- [License](#license)
- [Compatibility Chart](#compatibility-chart)
- [Installation](#installation)
- [Basic usage](#basic-usage)
  - [Example](#example)
  - [Exceptions](#exceptions)
  - [Laravel](#laravel)
  - [Symfony](#symfony)
- [Documentation](#documentation)
- [Development](#development)

## General Info

For `infobip-api-php-sdk` versioning we use [Semantic Versioning](https://semver.org) scheme.

## License

Published under [MIT License](LICENSE).

## Compatibility Chart

| Infobip API PHP SDK | PHP         |
|---------------------|-------------|
| 1.*                 | 7.2.5+ / 8+ |

## Installation

To start using the `infobip-api-php-sdk` library add it as dependency to your `composer.json` project dependency:

```sh
composer require infobip-community/infobip-api-php-sdk
```

Or you can add it manually to `composer.json` file:

```json
"require": {
    "infobip-community/infobip-api-php-sdk": "1.*"
}
```
And then simply run `composer install` to download dependencies.

## Basic usage

Example on how to create the `InfobipClient` instance. You can also define it in your DI Container and get configuration data from the `env()` or configuration file.

```php
$infobipClient = new Infobip\InfobipClient(
    'apiKey',
    'baseUrl',
    3 // timeout in seconds, optional parameter
);
```
### Example

A simple example of using the `InfobipClient` for calling the :

```php
// example 1
$resource = new \Infobip\Resources\WhatsApp\WhatsAppTextMessageResource(
    '441134960000',
    '441134960001',
    new \Infobip\Resources\WhatsApp\Models\TextContent('text message')
);

$response = $infobipClient
    ->whatsApp()
    ->sendWhatsAppTextMessage($resource);
```

### Exceptions

There is a couple of Infobip `exceptions` that you could stumble upon while using the `InfobipClient`:

- Bad request (400)
- Unauthorized (401)
- Forbidden (403)
- Not found (404)
- Unprocessable entity (422)
- Too many requests (429)
- Internal server error (500)

Of course, there is a way of handling those:

```php
try {
    $resource = new WhatsAppTextMessageResource();
    
    $response = $infobipClient
        ->whatsApp()
        ->sendWhatsAppTextMessage($resource);
} catch (InfobipException $exception) {
    $exception->getMessage(); // error message
    $exception->getCode(); // http status code
    $exception->getValidationErrors(); // array of validation errors, only available on 400 Bad request and 422 Unprocessable entity exceptions
}
```

### Laravel

Register the `InfobipServiceProvider` in your `config/app.php` configuration file:

```php
'providers' => [
    // Application Service Providers...
    // ...

    // Other Service Providers...
    Infobip\Support\Laravel\InfobipServiceProvider::class,
    // ...
],
```

And then run the following command to copy the Infobip configuration file to your `config` directory:

```shell
php artisan vendor:publish --provider="Infobip\Support\Laravel\InfobipServiceProvider"
```

After that, you can start using the Infobip API PHP SDK package in your Laravel project, just inject the `InfobipClient` into your codebase:

```php
<?php

namespace App\Http\Controllers;

use Infobip\InfobipClient;
use Infobip\Resources\WhatsApp\WhatsAppTextMessageResource;
use Infobip\Resources\WhatsApp\Models\TextContent;

final class InfobipController
{
    public function sendTextMessage(Request $request, InfobipClient $infobipClient)
    {
        $resource = new WhatsAppTextMessageResource(
            $request->input('from'),
            $request->input('to'),
            new TextContent($request->input('message'))
        );
        
        $response = $infobipClient
            ->whatsApp()
            ->sendWhatsAppTextMessage($resource);
        
        return $response;
    }
}
```

### Symfony

Add and bind `InfobipClient` to your `config/services.yaml` file:

```yaml
services:
  Infobip\InfobipClient:
    arguments:
      $apiKey: '%infobip.api_key%'
      $baseUrl: '%infobip.base_url%'
      $timeout: '%infobip.timeout%'
```

## Documentation

Infobip API Documentation can be found [here](https://www.infobip.com/docs/api).

## Development

Feel free to participate in this open source project. These are some console commands that could help you with the development like linter, static analysis and coding standards fixer:

```sh
vendor/bin/php-cs-fixer fix src
vendor/bin/php-cs-fixer fix tests
vendor/bin/phplint
vendor/bin/phpstan
```

For running the PHPunit tests:

```sh
vendor/bin/phpunit
```
