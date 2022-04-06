<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS;

use Infobip\Resources\ResourceQueryOptionsInterface;
use Infobip\Resources\ResourceValidationInterface;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\MaxNumberRule;

/**
 * @link https://www.infobip.com/docs/api#channels/sms/get-outbound-sms-message-delivery-reports
 */
final class GetOutboundSMSMessageDeliveryReportsResource implements ResourceQueryOptionsInterface, ResourceValidationInterface
{
    /** @var string|null */
    private $bulkId;

    /** @var string|null */
    private $messageId;

    /** @var int|null */
    private $limit;

    public function setBulkId(?string $bulkId): self
    {
        $this->bulkId = $bulkId;

        return $this;
    }

    public function setMessageId(?string $messageId): self
    {
        $this->messageId = $messageId;

        return $this;
    }

    public function setLimit(?int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    public function queryOptions(): array
    {
        return array_filter_recursive([
            'bulkId' => $this->bulkId,
            'messageId' => $this->messageId,
            'limit' => $this->limit
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new MaxNumberRule('limit', $this->limit, 1000));
    }
}
