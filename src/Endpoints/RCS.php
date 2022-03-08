<?php

declare(strict_types=1);

namespace Infobip\Endpoints;

use Infobip\Resources\RCS\RCSBulkMessageResource;
use Infobip\Resources\RCS\RCSMessageResource;

final class RCS extends BaseEndpoint
{
    /**
     * @link https://www.infobip.com/docs/api#channels/rcs/send-rcs-message
     */
    public function sendRCSMessage(RCSMessageResource $resource): array
    {
        return $this->client->post('/ott/rcs/1/message', $resource->payload());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/rcs/send-rcs-bulk-message
     */
    public function sendBulkRCSMessage(RCSBulkMessageResource $resource): array
    {
        return $this->client->post('/ott/rcs/1/bulk', $resource->payload());
    }
}
