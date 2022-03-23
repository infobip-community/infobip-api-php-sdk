<?php

declare(strict_types=1);

namespace Infobip\Resources\RCS\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\RCS\Enums\ValidityPeriodTimeUnit;

final class SMSFailover implements ModelInterface
{
    /** @var string */
    private $from;

    /** @var string */
    private $text;

    /** @var int|null */
    private $validityPeriod = null;

    /** @var ValidityPeriodTimeUnit|null */
    private $validityPeriodTimeUnit = null;

    public function __construct(
        string $from,
        string $text
    ) {
        $this->from = $from;
        $this->text = $text;
    }

    public function setValidityPeriod(?int $validityPeriod): self
    {
        $this->validityPeriod = $validityPeriod;

        return $this;
    }

    public function setValidityPeriodTimeUnit(?ValidityPeriodTimeUnit $validityPeriodTimeUnit): self
    {
        $this->validityPeriodTimeUnit = $validityPeriodTimeUnit;

        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'from' => $this->from,
            'text' => $this->text,
            'validityPeriod' => $this->validityPeriod,
            'validityPeriodTimeUnit' => $this->validityPeriodTimeUnit ? $this->validityPeriodTimeUnit->getValue() : null,
        ]);
    }
}
