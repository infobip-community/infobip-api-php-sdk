<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\WhatsApp\Contracts\TemplateButtonInterface;
use Infobip\Resources\WhatsApp\Enums\TemplateButtonType;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\BetweenLengthRule;

final class TemplateQuickReplyButton implements TemplateButtonInterface
{
    /** @var TemplateButtonType */
    private $type;

    /** @var string */
    private $parameter;

    public function __construct(string $parameter)
    {
        $this->parameter = $parameter;
        $this->type = new TemplateButtonType(TemplateButtonType::QUICK_REPLY);
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'type' => $this->type->getValue(),
            'parameter' => $this->parameter,
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new BetweenLengthRule('templateButton.parameter', $this->parameter, 1, 128));
    }
}
