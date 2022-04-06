<?php

declare(strict_types=1);

namespace Infobip\Resources;

use Infobip\Validations\Rules;

interface CollectionValidationInterface
{
    public function rules(): Rules;
}
