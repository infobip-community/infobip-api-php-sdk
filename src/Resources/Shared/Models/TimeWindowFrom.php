<?php

declare(strict_types=1);

namespace Infobip\Resources\Shared\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\ResourceValidationInterface;
use Infobip\Validations\RuleCollection;
use Infobip\Validations\Rules\TimeHourRule;
use Infobip\Validations\Rules\TimeMinuteRule;

final class TimeWindowFrom implements ModelInterface, ResourceValidationInterface
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

    public function validationRules(): RuleCollection
    {
        return (new RuleCollection())
            ->add(new TimeHourRule('deliveryTimeWindow.from.hour', $this->hour))
            ->add(new TimeMinuteRule('deliveryTimeWindow.from.minute', $this->minute));
    }
}
