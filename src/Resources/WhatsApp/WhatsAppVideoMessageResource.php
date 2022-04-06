<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp;

use Infobip\Resources\WhatsApp\Models\VideoContent;

/**
 * @link https://www.infobip.com/docs/api#channels/whatsapp/send-whatsapp-video-message
 */
final class WhatsAppVideoMessageResource extends BaseWhatsAppMessageResource
{
    /** @var VideoContent */
    protected $content;

    public function __construct(string $from, string $to, VideoContent $content)
    {
        parent::__construct($from, $to, $content);
    }
}
