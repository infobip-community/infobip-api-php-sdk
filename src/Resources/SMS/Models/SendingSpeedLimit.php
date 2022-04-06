<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\SMS\Enums\TimeUnitType;

final class SendingSpeedLimit implements ModelInterface
{
    /** @var int */
    private $amount;

    /** @var TimeUnitType */
    private $timeUnit;

    public function __construct(int $amount)
    {
        $this->amount = $amount;
        $this->timeUnit = new TimeUnitType(TimeUnitType::MINUTE);
    }

    public function setTimeUnit(TimeUnitType $timeUnit): self
    {
        $this->timeUnit = $timeUnit;

        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'amount' => $this->amount,
            'timeUnit' => $this->timeUnit->getValue(),
        ]);
    }
}
