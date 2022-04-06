<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\ModelValidationInterface;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\BetweenLengthRule;

final class SmsFailover implements ModelInterface, ModelValidationInterface
{
    /** @var string */
    private $from;

    /** @var string */
    private $text;

    public function __construct(
        string $from,
        string $text
    ) {
        $this->from = $from;
        $this->text = $text;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'from' => $this->from,
            'text' => $this->text,
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new BetweenLengthRule('smsFailover.from', $this->from, 1, 24))
            ->addRule(new BetweenLengthRule('smsFailover.text', $this->text, 1, 4096));
    }
}
