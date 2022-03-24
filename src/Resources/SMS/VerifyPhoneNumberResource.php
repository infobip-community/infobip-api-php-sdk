<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS;

use Infobip\Resources\ResourcePayloadInterface;

/**
 * @link https://www.infobip.com/docs/api#channels/sms/verify-2fa-phone-number
 */
final class VerifyPhoneNumberResource implements ResourcePayloadInterface
{
    /** @var string */
    private $pinId;

    /** @var string */
    private $pin;

    public function __construct(string $pinId, string $pin)
    {
        $this->pinId = $pinId;
        $this->pin = $pin;
    }

    public function getPinId(): string
    {
        return $this->pinId;
    }

    public function payload(): array
    {
        return array_filter_recursive([
            'pin' => $this->pin
        ]);
    }
}
