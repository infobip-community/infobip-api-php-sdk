<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp;

use Infobip\Resources\WhatsApp\Models\ImageContent;

/**
 * @link https://www.infobip.com/docs/api#channels/whatsapp/send-whatsapp-image-message
 */
final class WhatsAppImageMessageResource extends BaseWhatsAppMessageResource
{
    /** @var ImageContent */
    protected $content;

    public function __construct(string $from, string $to, ImageContent $content)
    {
        parent::__construct($from, $to, $content);
    }
}
