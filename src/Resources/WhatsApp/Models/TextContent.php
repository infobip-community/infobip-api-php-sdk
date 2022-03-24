<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\WhatsApp\Contracts\ContentInterface;
use Infobip\Validations\RuleCollection;
use Infobip\Validations\Rules\BetweenLengthRule;

final class TextContent implements ContentInterface
{
    /** @var string */
    private $text;

    /** @var bool */
    private $previewUrl = false;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function setPreviewUrl(bool $previewUrl): self
    {
        $this->previewUrl = $previewUrl;
        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'text' => $this->text,
            'previewUrl' => $this->previewUrl,
        ]);
    }

    public function validationRules(): RuleCollection
    {
        return (new RuleCollection())
            ->add(new BetweenLengthRule('content.text', $this->text, 1, 4096));
    }
}
