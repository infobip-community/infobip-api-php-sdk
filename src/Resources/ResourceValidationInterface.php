<?php

declare(strict_types=1);

namespace Infobip\Resources;

use Infobip\Validations\RuleCollection;

interface ResourceValidationInterface
{
    public function validationRules(): RuleCollection;
}
