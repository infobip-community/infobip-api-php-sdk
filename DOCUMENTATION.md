# Infobip API PHP SDK Documentation

This is a Documentation for using the PHP SDK for Infobip API. The Infobip API documentation can be found [here](https://www.infobip.com/docs/api).

#### Table of contents:
* [Installation](#installation)
* [Basic usage](#basic-usage)
* [Exceptions](#exceptions)
* [Laravel](#laravel)
* [Symfony](#symfony)

## Installation

To start using the `infobip-api-php-sdk` library add it as dependency to your `composer.json` project dependency:

```sh
composer require fsasvari/infobip-api-php-sdk
```

Or you can add it manually to `composer.json` file:

```json
"require": {
    "fsasvari/infobip-api-php-sdk": "1.*"
}
```
And then simply run `composer install` to download dependencies.

## Basic Usage

A way to create a new `InfobipClient` instance. You can also define it in your DI Container and get configuration data from the `env()` or configuration file.

```php
$infobipClient = new Infobip\InfobipClient(
    'apiKey',
    'baseUrl',
    3 // timeout in seconds, optional parameter
);
```

A couple of simple examples of using the InfobipClient:

```php
// example 1
$resource = new WhatsAppDownloadInboundMediaResource(
    'sender',
    'mediaId'
);
$response = $infobipClient
    ->whatsApp()
    ->downloadWhatsAppInboundMedia($resource);

// example 2
$resource = new \Infobip\Resources\WhatsApp\WhatsAppTemplatesResource('sender');
$response = $infobipClient
    ->whatsApp()
    ->getWhatsAppTemplates($resource);
```

One more complex example of using the InfobipClient:

```php
$templateName = new \Infobip\Resources\WhatsApp\Models\TemplateName('name');
$templateBody = new \Infobip\Resources\WhatsApp\Models\TemplateBody();
$templateBody->addPlaceholder('placeholder1')
$templateData = new \Infobip\Resources\WhatsApp\Models\TemplateData($templateBody);
$templateLanguage = new \Infobip\Resources\WhatsApp\Models\TemplateLanguage('language');

$templateContent = new \Infobip\Resources\WhatsApp\Models\TemplateContent(
    $templateName,
    $templateData,
    $templateLanguage
);

$resource = new \Infobip\Resources\WhatsApp\WhatsAppTemplateMessageResource(
    'from',
    'to',
    $templateContent
);
$response = $infobipClient
->whatsApp()
->sendWhatsAppTemplateMessage($resource);
```

## Exceptions

There is a couple of Infobip exceptions that you could stumble upon while using the InfobipClient:

- Bad request (400)
- Unauthorized (401)
- Forbidden (403)
- Not found (404)
- Too many requests (429)
- Internal server error (500)

Of course, there is a way of handling those:

```php
$resource = new \Infobip\Resources\WhatsApp\WhatsAppTemplatesResource('sender');
try {
    $response = $infobipClient
        ->whatsApp()
        ->getWhatsAppTemplates($resource);
} catch (\Infobip\Exceptions\InfobipException $exception) {
    $exception->getMessage(); // error message
    $exception->getCode(); // http status code
    $exception->getValidationErrors(); // array of validation errors, only available on 400 Bad request exception
}
```

Also, here you can be more accurate which exception do you want to handle, and how:

```php
$resource = new \Infobip\Resources\WhatsApp\WhatsAppTemplatesResource('sender');
try {
    $response = $infobipClient
        ->whatsApp()
        ->getWhatsAppTemplates($resource);
} catch (\Infobip\Exceptions\InfobipBadRequestException $exception) {
    //
} catch (\Infobip\Exceptions\InfobipForbiddenException $exception) {
    //
} catch (\Infobip\Exceptions\InfobipNotFoundException $exception) {
    //
} catch (\Infobip\Exceptions\InfobipServerException $exception) {
    //
} catch (\Infobip\Exceptions\InfobipTooManyRequestException $exception) {
    //
} catch (\Infobip\Exceptions\InfobipUnauthorizedException $exception) {
    //
} finally {
    //
}
```

## Laravel

Register the InfobipServiceProvider to your `config/app.php` configuration file:

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

After that, you can start using the Infobip API PHP SDK package in your Laravel project, just inject the InfobipClient into your codebase:

```php
<?php

namespace App\Services;

use Infobip\InfobipClient;
use Infobip\Resources\WhatsApp\WhatsAppDownloadInboundMediaResource;

final class InfobipService
{
    public function dashboard(InfobipClient $infobipClient)
    {
        $resource = new WhatsAppDownloadInboundMediaResource(
            'sender',
            'mediaId'
        );
        
        $response = $infobipClient
            ->whatsApp()
            ->downloadWhatsAppInboundMedia($resource);
        
        return $response;
    }
}
```

## Symfony

TODO
