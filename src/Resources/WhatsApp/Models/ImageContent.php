<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\WhatsApp\Contracts\ContentInterface;
use Infobip\Validations\RuleCollection;
use Infobip\Validations\Rules\UrlRule;

final class ImageContent implements ContentInterface
{
    /** @var string */
    private $mediaUrl;

    /** @var string|null */
    private $caption = null;

    public function __construct(string $mediaUrl)
    {
        $this->mediaUrl = $mediaUrl;
    }

    public function setCaption(?string $caption): self
    {
        $this->caption = $caption;
        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'mediaUrl' => $this->mediaUrl,
            'caption' => $this->caption,
        ]);
    }

    public function validationRules(): RuleCollection
    {
        return (new RuleCollection())
            ->add(new UrlRule('content.mediaUrl', $this->mediaUrl));
    }
}
