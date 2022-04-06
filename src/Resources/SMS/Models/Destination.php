<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\ModelValidationInterface;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\MaxLengthRule;

final class Destination implements ModelInterface, ModelValidationInterface
{
    /** @var string */
    private $to;

    /** @var string|null */
    private $messageId;

    public function __construct(string $to)
    {
        $this->to = $to;
    }

    public function setMessageId(?string $messageId): self
    {
        $this->messageId = $messageId;

        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'messageId' => $this->messageId,
            'to' => $this->to,
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new MaxLengthRule('destination.to', $this->to, 50));
    }
}
