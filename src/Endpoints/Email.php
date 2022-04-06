<?php

declare(strict_types=1);

namespace Infobip\Endpoints;

use Infobip\Exceptions\InfobipValidationException;
use Infobip\Resources\Email\EmailDeliveryReportsResource;
use Infobip\Resources\Email\EmailLogsResource;
use Infobip\Resources\Email\FullyFeaturedEmailResource;
use Infobip\Resources\Email\RescheduleEmailMessagesResource;
use Infobip\Resources\Email\SentEmailBulksResource;
use Infobip\Resources\Email\SentEmailBulksStatusResource;
use Infobip\Resources\Email\UpdateScheduledEmailMessagesStatusResource;
use Infobip\Resources\Email\ValidateEmailAddressesResource;
use Infobip\Validations\Validator;

final class Email extends BaseEndpoint
{
    /**
     * @link https://www.infobip.com/docs/api#channels/email/get-email-delivery-reports
     */
    public function getEmailDeliveryReports(EmailDeliveryReportsResource $resource): array
    {
        return $this->client->get('email/1/reports', $resource->queryOptions());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/email/get-email-logs
     */
    public function getEmailLogs(EmailLogsResource $resource): array
    {
        return $this->client->get('email/1/logs', $resource->queryOptions());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/email/send-email
     * @throws InfobipValidationException
     */
    public function sendFullyFeaturedEmail(FullyFeaturedEmailResource $resource): array
    {
        Validator::validateResource($resource);

        return $this->client->post('email/2/send', $resource->payload());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/email/get-scheduled-emails
     */
    public function getSentEmailBulks(SentEmailBulksResource $resource): array
    {
        return $this->client->get('email/1/bulks', $resource->queryOptions());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/email/reschedule-emails
     */
    public function rescheduleEmailMessages(RescheduleEmailMessagesResource $resource): array
    {
        return $this->client->put('/email/1/bulks', $resource->payload(), $resource->queryOptions());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/email/get-scheduled-email-statuses
     */
    public function getSentEmailBulksStatus(SentEmailBulksStatusResource $resource): array
    {
        return $this->client->get('email/1/bulks/status', $resource->queryOptions());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/email/update-scheduled-email-statuses
     */
    public function updateScheduledEmailMessagesStatus(UpdateScheduledEmailMessagesStatusResource $resource): array
    {
        return $this->client->put('/email/1/bulks/status', $resource->payload(), $resource->queryOptions());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/email/validate-email-addresses
     * @throws InfobipValidationException
     */
    public function validateEmailAddresses(ValidateEmailAddressesResource $resource): array
    {
        Validator::validateResource($resource);

        return $this->client->put('/email/2/validation', $resource->payload());
    }
}
