<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS\Models;

use Infobip\Resources\ModelInterface;

final class Binary implements ModelInterface
{
    /** @var string */
    private $hex;

    /** @var int|null */
    private $dataCoding;

    /** @var int|null */
    private $esmClass;

    public function __construct(string $hex)
    {
        $this->hex = $hex;
    }

    public function setDataCoding(?int $dataCoding): self
    {
        $this->dataCoding = $dataCoding;

        return $this;
    }

    public function setEsmClass(?int $esmClass): self
    {
        $this->esmClass = $esmClass;

        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'dataCoding' => $this->dataCoding,
            'esmClass' => $this->esmClass,
            'hex' => $this->hex
        ]);
    }
}
