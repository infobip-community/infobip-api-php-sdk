<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS;

use Infobip\Resources\ResourcePayloadInterface;
use Infobip\Resources\ResourceQueryOptionsInterface;
use Infobip\Resources\SMS\Collections\PlaceholderCollection;
use Infobip\Resources\SMS\Models\Placeholder;

/**
 * @link https://www.infobip.com/docs/api#channels/sms/send-2fa-pin-code-over-sms
 */
final class SendTwoFAPinCodeOverSMSResource implements ResourcePayloadInterface, ResourceQueryOptionsInterface
{
    /** @var bool */
    private $ncNeeded = true;

    /** @var string */
    private $messageId;

    /** @var string */
    private $applicationId;

    /** @var string */
    private $to;

    /** @var string|null */
    private $from;

    /** @var PlaceholderCollection */
    private $placeholders;

    public function __construct(
        string $applicationId,
        string $messageId,
        string $to
    ) {
        $this->applicationId = $applicationId;
        $this->messageId = $messageId;
        $this->to = $to;
        $this->placeholders = new PlaceholderCollection();
    }

    public function setNcNeeded(bool $ncNeeded): self
    {
        $this->ncNeeded = $ncNeeded;

        return $this;
    }

    public function setFrom(?string $from): self
    {
        $this->from = $from;

        return $this;
    }

    public function addPlaceholder(Placeholder $placeholder): self
    {
        $this->placeholders->add($placeholder);

        return $this;
    }

    public function payload(): array
    {
        return array_filter_recursive([
            'applicationId' => $this->applicationId,
            'from' => $this->from,
            'messageId' => $this->messageId,
            'placeholders' => $this->placeholders->toArray(),
            'to' => $this->to
        ]);
    }

    public function queryOptions(): array
    {
        return [
            'ncNeeded' => $this->ncNeeded,
        ];
    }
}
