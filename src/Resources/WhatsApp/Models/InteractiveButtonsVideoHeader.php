<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\WhatsApp\Contracts\InteractiveButtonsHeaderInterface;
use Infobip\Resources\WhatsApp\Enums\InteractiveButtonHeaderType;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\UrlRule;

final class InteractiveButtonsVideoHeader implements InteractiveButtonsHeaderInterface
{
    /** @var InteractiveButtonHeaderType */
    private $type;

    /** @var string */
    private $mediaUrl;

    public function __construct(string $mediaUrl)
    {
        $this->mediaUrl = $mediaUrl;
        $this->type = new InteractiveButtonHeaderType(InteractiveButtonHeaderType::VIDEO);
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'type' => $this->type->getValue(),
            'mediaUrl' => $this->mediaUrl,
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new UrlRule('interactiveButtonsVideoHeader.mediaUrl', $this->mediaUrl));
    }
}
