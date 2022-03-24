<?php

declare(strict_types=1);

namespace Infobip\Endpoints;

use Infobip\Exceptions\InfobipValidationException;
use Infobip\Resources\MMS\GetInboundMMSMessagesResource;
use Infobip\Resources\MMS\GetOutboundMMSMessageDeliveryReportsResource;
use Infobip\Resources\MMS\SendSingleMMSMessageResource;
use Infobip\Validations\Validator;

final class MMS extends BaseEndpoint
{
    /**
     * @link https://www.infobip.com/docs/api#channels/mms/send-mms-single-message
     * @throws InfobipValidationException
     */
    public function sendSingleMMSMessage(SendSingleMMSMessageResource $resource): array
    {
        Validator::validateResource($resource);

        return $this->client->post('/mms/1/single', $resource->payload());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/mms/get-outbound-mms-message-delivery-reports
     */
    public function getOutboundMMSMessageDeliveryReports(GetOutboundMMSMessageDeliveryReportsResource $resource): array
    {
        return $this->client->get('/mms/1/reports', $resource->queryOptions());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/mms/get-inbound-mms-messages
     */
    public function getInboundMMSMessages(GetInboundMMSMessagesResource $resource): array
    {
        return $this->client->get('/mms/1/inbox/reports', $resource->queryOptions());
    }
}
