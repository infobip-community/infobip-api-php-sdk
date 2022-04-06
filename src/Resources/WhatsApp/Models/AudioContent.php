<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\WhatsApp\Contracts\ContentInterface;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\UrlRule;

final class AudioContent implements ContentInterface
{
    /** @var string */
    private $mediaUrl;

    public function __construct(
        string $mediaUrl
    ) {
        $this->mediaUrl = $mediaUrl;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'mediaUrl' => $this->mediaUrl,
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new UrlRule('content.mediaUrl', $this->mediaUrl));
    }
}
