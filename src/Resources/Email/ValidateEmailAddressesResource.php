<?php

declare(strict_types=1);

namespace Infobip\Resources\Email;

use Infobip\Resources\ResourcePayloadInterface;

/**
 * @link https://www.infobip.com/docs/api#channels/email/validate-email-addresses
 */
final class ValidateEmailAddressesResource implements ResourcePayloadInterface
{
    /** @var string */
    private $to;

    public function __construct(string $to)
    {
        $this->to = $to;
    }

    public function payload(): array
    {
        return array_filter_recursive([
            'to' => $this->to,
        ]);
    }
}
