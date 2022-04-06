<?php

declare(strict_types=1);

namespace Infobip\Resources;

use Infobip\Validations\Rules;

interface ModelValidationInterface
{
    public function rules(): Rules;
}
