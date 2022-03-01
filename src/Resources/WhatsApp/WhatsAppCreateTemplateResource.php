<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp;

use Infobip\Resources\ResourcePayloadInterface;
use Infobip\Resources\WhatsApp\Contracts\CreateTemplateCategoryInterface;
use Infobip\Resources\WhatsApp\Enums\CreateTemplateCategoryType;
use Infobip\Resources\WhatsApp\Models\Structure;

/**
 * @link https://www.infobip.com/docs/api#channels/whatsapp/create-whatsapp-template
 */
final class WhatsAppCreateTemplateResource implements ResourcePayloadInterface
{
    /** @var string */
    private $sender;

    /** @var string */
    private $name;

    /** @var string */
    private $language;

    /** @var CreateTemplateCategoryType */
    private $category;

    /** @var Structure */
    private $structure;

    public function __construct(
        string $sender,
        string $name,
        string $language,
        CreateTemplateCategoryType $category,
        Structure $structure
    ) {
        $this->sender = $sender;
        $this->name = $name;
        $this->language = $language;
        $this->category = $category;
        $this->structure = $structure;
    }

    public function getSender(): string
    {
        return $this->sender;
    }

    public function payload(): array
    {
        return array_filter_recursive([
            'name' => $this->name,
            'language' => $this->language,
            'category' => $this->category,
            'structure' => $this->structure->toArray()
        ]);
    }
}
