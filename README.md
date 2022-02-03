# Infobip API PHP SDK

[![Latest Stable Version](https://poser.pugx.org/fsasvari/infobip-api-php-sdk/v/stable)](https://packagist.org/packages/fsasvari/infobip-api-php-sdk)
[![Latest Unstable Version](https://poser.pugx.org/fsasvari/infobip-api-php-sdk/v/unstable)](https://packagist.org/packages/fsasvari/infobip-api-php-sdk)
[![Total Downloads](https://poser.pugx.org/fsasvari/infobip-api-php-sdk/downloads)](https://packagist.org/packages/fsasvari/infobip-api-php-sdk)
[![License](https://poser.pugx.org/fsasvari/infobip-api-php-sdk/license)](https://packagist.org/packages/fsasvari/infobip-api-php-sdk)

This is a PHP SDK for Infobip API and you can use it as a dependency to add [Infobip APIs](https://www.infobip.com/docs/api) to your application. To use this, you'll need an Infobip account. If you do not own one, you can create a [free account here](https://www.infobip.com/signup).

#### Table of contents:

* [Documentation](#documentation)
* [General Info](#general-info)
* [License](#license)
* [Compatibility Chart](#compatibility-chart)
* [Installation](#installation)
* [Development](#development)

## Documentation

Infobip API Documentation can be found [here](https://www.infobip.com/docs/api).

The documentation for using the Infobip API PHP SDK package can be found [here](DOCUMENTATION.md).

## General Info

For `infobip-api-php-sdk` versioning we use [Semantic Versioning](https://semver.org) scheme.

## License

Published under [MIT License](LICENSE).

## Compatibility Chart

| Infobip API PHP SDK | PHP  |
|---------------------|------|
| 1.*                 | 7.2+ |

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

## Development

Feel free to participate in this open source project. These are some console commands that could help you with the development:

```sh
vendor/bin/phplint
vendor/bin/phpstan analyse
vendor/bin/php-cs-fixer fix src
vendor/bin/php-cs-fixer fix tests
vendor/bin/phpunit
```
