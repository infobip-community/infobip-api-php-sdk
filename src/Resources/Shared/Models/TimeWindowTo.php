<?php

declare(strict_types=1);

namespace Infobip\Resources\Shared\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\ModelValidationInterface;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\TimeHourRule;
use Infobip\Validations\Rules\TimeMinuteRule;

final class TimeWindowTo implements ModelInterface, ModelValidationInterface
{
    /** @var int */
    private $hour;

    /** @var int */
    private $minute;

    public function __construct(int $hour, int $minute)
    {
        $this->hour = $hour;
        $this->minute = $minute;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'hour' => $this->hour,
            'minute' => $this->minute,
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new TimeHourRule('deliveryTimeWindow.to.hour', $this->hour))
            ->addRule(new TimeMinuteRule('deliveryTimeWindow.to.minute', $this->minute));
    }
}
