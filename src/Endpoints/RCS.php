<?php

declare(strict_types=1);

namespace Infobip\Endpoints;

use Infobip\Exceptions\InfobipValidationException;
use Infobip\Resources\RCS\RCSBulkMessageResource;
use Infobip\Resources\RCS\RCSMessageResource;
use Infobip\Validations\Validator;

final class RCS extends BaseEndpoint
{
    /**
     * @link https://www.infobip.com/docs/api#channels/rcs/send-rcs-message
     * @throws InfobipValidationException
     */
    public function sendRCSMessage(RCSMessageResource $resource): array
    {
        Validator::validateResource($resource);

        return $this->client->post('/ott/rcs/1/message', $resource->payload());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/rcs/send-rcs-bulk-message
     * @throws InfobipValidationException
     */
    public function sendBulkRCSMessage(RCSBulkMessageResource $resource): array
    {
        Validator::validateResource($resource);

        return $this->client->post('/ott/rcs/1/bulk', $resource->payload());
    }
}
