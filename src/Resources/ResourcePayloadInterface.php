<?php

declare(strict_types=1);

namespace Infobip\Resources;

interface ResourcePayloadInterface
{
    public function payload(): array;
}
