<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp;

use Infobip\Resources\WhatsApp\Models\TextContent;

/**
 * @link https://www.infobip.com/docs/api#channels/whatsapp/send-whatsapp-text-message
 */
final class WhatsAppTextMessageResource extends BaseWhatsAppMessageResource
{
    /** @var TextContent  */
    protected $content;

    public function __construct(string $from, string $to, TextContent $content)
    {
        parent::__construct($from, $to, $content);
    }
}
