<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\WhatsApp\Contracts\InteractiveButtonsHeaderInterface;
use Infobip\Resources\WhatsApp\Enums\InteractiveButtonHeaderType;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\UrlRule;
use Infobip\Validations\Rules\BetweenLengthRule;

final class InteractiveButtonsDocumentHeader implements InteractiveButtonsHeaderInterface
{
    /** @var InteractiveButtonHeaderType */
    private $type;

    /** @var string */
    private $mediaUrl;

    /** @var string|null */
    private $filename = null;

    public function __construct(string $mediaUrl)
    {
        $this->mediaUrl = $mediaUrl;
        $this->type = new InteractiveButtonHeaderType(InteractiveButtonHeaderType::DOCUMENT);
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'type' => $this->type->getValue(),
            'mediaUrl' => $this->mediaUrl,
            'filename' => $this->filename,
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new UrlRule('interactiveButtonsDocumentHeader.mediaUrl', $this->mediaUrl))
            ->addRule(new BetweenLengthRule('interactiveButtonsDocumentHeader.filename', $this->filename, 0, 240));
    }
}
