<?php

declare(strict_types=1);

namespace Infobip\Resources\Email;

use Infobip\Resources\ResourcePayloadInterface;
use Infobip\Resources\ResourceValidationInterface;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\EmailRule;

/**
 * @link https://www.infobip.com/docs/api#channels/email/validate-email-addresses
 */
final class ValidateEmailAddressesResource implements ResourcePayloadInterface, ResourceValidationInterface
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

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new EmailRule('to', $this->to));
    }
}
