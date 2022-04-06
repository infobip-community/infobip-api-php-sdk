<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp;

use Infobip\Resources\WhatsApp\Models\LocationContent;

/**
 * @link https://www.infobip.com/docs/api#channels/whatsapp/send-whatsapp-location-message
 */
final class WhatsAppLocationMessageResource extends BaseWhatsAppMessageResource
{
    /** @var LocationContent */
    protected $content;

    public function __construct(string $from, string $to, LocationContent $content)
    {
        parent::__construct($from, $to, $content);
    }
}
