<?php

declare(strict_types=1);

namespace Infobip\Exceptions;

use GuzzleHttp\Exception\RequestException;
use Infobip\Enums\StatusCode;

final class InfobipExceptionFactory
{
    public static function make(RequestException $exception): InfobipException
    {
        $responseStatusCode = self::getResponseStatusCodeFromException($exception);
        $responseBody = self::getResponseBodyFromException($exception);
        $errorMessage = self::getErrorMessageFromResponseBody($responseBody);

        switch ($responseStatusCode) {
            case StatusCode::BAD_REQUEST:
                return InfobipBadRequestException::create(
                    $errorMessage ?? 'Bad request',
                    $responseBody['requestError']['serviceException']['validationErrors'] ?? [],
                    $exception
                );

            case StatusCode::UNAUTHORIZED:
                return InfobipUnauthorizedException::create(
                    $errorMessage ?? 'Unauthorized',
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
                    $errorMessage ?? 'Too many requests',
                    $exception
                );

            case StatusCode::SERVER_ERROR:
                return InfobipServerException::create(
                    $errorMessage ?? 'Server error',
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

    private static function getResponseStatusCodeFromException(RequestException $exception): ?int
    {
        if ($exception->getResponse()) {
            return $exception->getResponse()->getStatusCode();
        }

        return null;
    }

    private static function getResponseBodyFromException(RequestException $exception): array
    {
        if (null === $exception->getResponse()) {
            return [];
        }

        $responseBody = json_decode(
            $exception->getResponse()->getBody()->getContents(),
            true
        );

        if (is_array($responseBody)) {
            return $responseBody;
        }

        return [];
    }

    private static function getErrorMessageFromResponseBody(array $responseBody): ?string
    {
        if (isset($responseBody['requestError']['serviceException']['text'])) {
            return $responseBody['requestError']['serviceException']['text'];
        }

        if (isset($responseBody['errorMessage'])) {
            return $responseBody['errorMessage'];
        }

        return null;
    }
}
