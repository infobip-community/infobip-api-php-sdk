<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp;

use Infobip\Resources\ResourcePayloadInterface;
use Infobip\Resources\ResourceValidationInterface;
use Infobip\Resources\WhatsApp\Collections\TemplateMessageCollection;
use Infobip\Resources\WhatsApp\Models\TemplateMessage;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\BetweenLengthRule;

/**
 * @link https://www.infobip.com/docs/api#channels/whatsapp/send-whatsapp-template-message
 */
final class WhatsAppTemplateMessageResource implements ResourcePayloadInterface, ResourceValidationInterface
{
    /** @var TemplateMessageCollection */
    private $messages;

    /** @var string|null */
    private $bulkId = null;

    public function __construct(
    ) {
        $this->messages = new TemplateMessageCollection();
    }

    public function setBulkId(?string $bulkId): self
    {
        $this->bulkId = $bulkId;
        return $this;
    }

    public function addTemplateMessage(TemplateMessage $templateMessage): self
    {
        $this->messages->add($templateMessage);
        return $this;
    }

    public function payload(): array
    {
        return array_filter_recursive([
            'messages' => $this->messages->toArray(),
            'bulkId' => $this->bulkId,
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new BetweenLengthRule('bulkId', $this->bulkId, 0, 100))
            ->addCollectionRules($this->messages);
    }
}
