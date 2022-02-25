<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\WhatsApp\Enums\UrlTypeEnum;

final class Url implements ModelInterface
{
    /** @var string */
    private $url;

    /** @var UrlTypeEnum */
    private $type;

    public function __construct(string $url, UrlTypeEnum $type)
    {
        $this->url = $url;
        $this->type = $type;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'url' => $this->url,
            'type' => $this->type->getValue(),
        ]);
    }
}
