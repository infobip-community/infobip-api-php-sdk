<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\WhatsApp\Contracts\TemplateButtonInterface;
use Infobip\Resources\WhatsApp\Enums\TemplateButtonTypeEnum;

final class TemplateQuickReplyButton implements ModelInterface, TemplateButtonInterface
{
    /** @var TemplateButtonTypeEnum */
    private $type;

    /** @var string */
    private $parameter;

    public function __construct(string $parameter)
    {
        $this->parameter = $parameter;
        $this->type = new TemplateButtonTypeEnum(TemplateButtonTypeEnum::QUICK_REPLY);
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'type' => $this->type->getValue(),
            'parameter' => $this->parameter,
        ]);
    }
}
