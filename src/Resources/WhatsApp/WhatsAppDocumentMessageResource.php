<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp;

use Infobip\Resources\WhatsApp\Models\DocumentContent;

/**
 * @link https://www.infobip.com/docs/api#channels/whatsapp/send-whatsapp-document-message
 */
final class WhatsAppDocumentMessageResource extends BaseWhatsAppMessageResource
{
    /** @var DocumentContent */
    protected $content;

    public function __construct(string $from, string $to, DocumentContent $content)
    {
        parent::__construct($from, $to, $content);
    }
}
