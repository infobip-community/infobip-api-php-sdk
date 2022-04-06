<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp;

use Infobip\Resources\ResourcePayloadInterface;
use Infobip\Resources\WhatsApp\Models\StickerContent;

/**
 * @link https://www.infobip.com/docs/api#channels/whatsapp/send-whatsapp-sticker-message
 */
final class WhatsAppStickerMessageResource extends BaseWhatsAppMessageResource
{
    /** @var StickerContent */
    protected $content;

    public function __construct(string $from, string $to, StickerContent $content)
    {
        parent::__construct($from, $to, $content);
    }
}
