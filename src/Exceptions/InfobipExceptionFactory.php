<?php

declare(strict_types=1);

namespace Infobip\Exceptions;

use GuzzleHttp\Exception\RequestException;
use Infobip\Enums\StatusCode;

final class InfobipExceptionFactory
{
    public static function make(RequestException $exception): InfobipException
    {
        $responseStatusCode = $exception->getResponse()->getStatusCode();
        $responseBody = json_decode($exception->getResponse()->getBody()->getContents(), true);

        switch ($responseStatusCode) {
            case StatusCode::BAD_REQUEST:
                return InfobipBadRequestException::create(
                    $responseBody['requestError']['serviceException']['text'] ?? 'Bad request',
                    $responseBody['requestError']['serviceException']['validationErrors'] ?? [],
                    $exception
                );

            case StatusCode::UNAUTHORIZED:
                return InfobipUnauthorizedException::create(
                    $responseBody['requestError']['serviceException']['text'] ?? 'Unauthorized',
                    $exception
                );

            case StatusCode::FORBIDDEN:
                return InfobipForbiddenException::create(
                    'Forbidden',
                    $exception
                );

            case StatusCode::NOT_FOUND:
                return InfobipNotFoundException::create(
                    'Not found',
                    $exception
                );

            case StatusCode::TOO_MANY_REQUESTS:
                return InfobipTooManyRequestException::create(
                    $responseBody['requestError']['serviceException']['text'] ?? 'Too many requests',
                    $exception
                );

            case StatusCode::SERVER_ERROR:
                return InfobipServerException::create(
                    $responseBody['requestError']['serviceException']['text'] ?? 'Server error',
                    $exception
                );

            default:
                return new InfobipException(
                    'Unknown Infobip exception',
                    0,
                    $exception
                );
        }
    }
}
