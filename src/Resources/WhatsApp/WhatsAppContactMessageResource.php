<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp;

use Infobip\Resources\WhatsApp\Models\ContactContent;

/**
 * @link https://www.infobip.com/docs/api#channels/whatsapp/send-whatsapp-contact-message
 */
final class WhatsAppContactMessageResource extends BaseWhatsAppMessageResource
{
    /** @var ContactContent */
    protected $content;

    public function __construct(string $from, string $to, ContactContent $content)
    {
        parent::__construct($from, $to, $content);
    }
}
