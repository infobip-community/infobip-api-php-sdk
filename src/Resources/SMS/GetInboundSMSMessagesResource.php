<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS;

use Infobip\Resources\ResourceQueryOptionsInterface;
use Infobip\Resources\ResourceValidationInterface;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\MaxNumberRule;

/**
 * @link https://www.infobip.com/docs/api#channels/sms/get-inbound-sms-messages
 */
final class GetInboundSMSMessagesResource implements ResourceQueryOptionsInterface, ResourceValidationInterface
{
    /** @var int|null */
    private $limit;

    public function setLimit(?int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    public function queryOptions(): array
    {
        return array_filter_recursive([
            'limit' => $this->limit
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new MaxNumberRule('limit', $this->limit, 1000));
    }
}
