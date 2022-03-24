<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp;

use Infobip\Resources\WhatsApp\Models\AudioContent;

/**
 * @link https://www.infobip.com/docs/api#channels/whatsapp/send-whatsapp-audio-message
 */
final class WhatsAppAudioMessageResource extends BaseWhatsAppMessageResource
{
    /** @var AudioContent */
    protected $content;

    public function __construct(string $from, string $to, AudioContent $content)
    {
        $this->from = $from;
        $this->to = $to;
        $this->content = $content;
    }
}
