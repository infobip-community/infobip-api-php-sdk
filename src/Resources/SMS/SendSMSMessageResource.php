<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS;

use Infobip\Resources\ResourcePayloadInterface;
use Infobip\Resources\ResourceValidationInterface;
use Infobip\Resources\SMS\Collections\MessageCollection;
use Infobip\Resources\SMS\Models\Message;
use Infobip\Resources\SMS\Models\SendingSpeedLimit;
use Infobip\Resources\SMS\Models\Tracking;
use Infobip\Validations\Rules;

/**
 * @link https://www.infobip.com/docs/api#channels/sms/send-sms-message
 */
final class SendSMSMessageResource implements ResourcePayloadInterface, ResourceValidationInterface
{
    /** @var MessageCollection */
    private $messages;

    /** @var string|null  */
    private $bulkId;

    /** @var SendingSpeedLimit|null */
    private $sendingSpeedLimit;

    /** @var Tracking|null */
    private $tracking;

    public function __construct()
    {
        $this->messages = new MessageCollection();
    }

    public function setBulkId(?string $bulkId): self
    {
        $this->bulkId = $bulkId;

        return $this;
    }

    public function addMessage(Message $message): self
    {
        $this->messages->add($message);

        return $this;
    }

    public function setSendingSpeedLimit(?SendingSpeedLimit $sendingSpeedLimit): self
    {
        $this->sendingSpeedLimit = $sendingSpeedLimit;

        return $this;
    }

    public function setTracking(?Tracking $tracking): self
    {
        $this->tracking = $tracking;

        return $this;
    }

    public function payload(): array
    {
        return array_filter_recursive([
            'bulkId' => $this->bulkId,
            'messages' => $this->messages->toArray(),
            'sendingSpeedLimit' => $this->sendingSpeedLimit,
            'tracking' => $this->tracking,
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addCollectionRules($this->messages);
    }
}
