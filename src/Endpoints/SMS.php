<?php

declare(strict_types=1);

namespace Infobip\Endpoints;

use Infobip\Exceptions\InfobipValidationException;
use Infobip\Resources\SMS\CreateTwoFAApplicationResource;
use Infobip\Resources\SMS\CreateTwoFAMessageTemplateResource;
use Infobip\Resources\SMS\GetInboundSMSMessagesResource;
use Infobip\Resources\SMS\GetScheduledSMSMessagesResource;
use Infobip\Resources\SMS\GetScheduledSMSMessagesStatusResource;
use Infobip\Resources\SMS\GetOutboundSMSMessageDeliveryReportsResource;
use Infobip\Resources\SMS\GetOutboundSMSMessageLogsResource;
use Infobip\Resources\SMS\GetTwoFAApplicationResource;
use Infobip\Resources\SMS\GetTwoFAMessageTemplateResource;
use Infobip\Resources\SMS\GetTwoFAMessageTemplatesResource;
use Infobip\Resources\SMS\GetTwoFAVerificationStatusResource;
use Infobip\Resources\SMS\PreviewSMSMessageResource;
use Infobip\Resources\SMS\RescheduleSMSMessagesResource;
use Infobip\Resources\SMS\ResendTwoFAPinCodeOverSMSResource;
use Infobip\Resources\SMS\ResendTwoFAPinCodeOverVoiceResource;
use Infobip\Resources\SMS\SendBinarySMSMessageResource;
use Infobip\Resources\SMS\SendSMSMessageOverQueryParametersResource;
use Infobip\Resources\SMS\SendSMSMessageResource;
use Infobip\Resources\SMS\SendTwoFAPinCodeOverSMSResource;
use Infobip\Resources\SMS\SendTwoFAPinCodeOverVoiceResource;
use Infobip\Resources\SMS\UpdateScheduledSMSMessagesStatusResource;
use Infobip\Resources\SMS\UpdateTwoFAApplicationResource;
use Infobip\Resources\SMS\UpdateTwoFAMessageTemplateResource;
use Infobip\Resources\SMS\VerifyPhoneNumberResource;
use Infobip\Validations\Validator;

final class SMS extends BaseEndpoint
{
    /**
     * @link https://www.infobip.com/docs/api#channels/sms/send-sms-message
     * @throws InfobipValidationException
     */
    public function sendSMSMessage(SendSMSMessageResource $resource): array
    {
        Validator::validateResource($resource);

        return $this->client->post('sms/2/text/advanced', $resource->payload());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/sms/send-sms-message-over-query-parameters
     */
    public function sendSMSMessageOverQueryParameters(SendSMSMessageOverQueryParametersResource $resource): array
    {
        return $this->client->get('sms/1/text/query', $resource->queryOptions());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/sms/send-binary-sms-message
     * @throws InfobipValidationException
     */
    public function sendBinarySMSMessage(SendBinarySMSMessageResource $resource): array
    {
        Validator::validateResource($resource);

        return $this->client->post('sms/2/binary/advanced', $resource->payload());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/sms/preview-sms-message
     */
    public function previewSMSMessage(PreviewSMSMessageResource $resource): array
    {
        return $this->client->post('sms/1/preview', $resource->payload());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/sms/get-outbound-sms-message-delivery-reports
     * @throws InfobipValidationException
     */
    public function getOutboundSMSMessageDeliveryReports(GetOutboundSMSMessageDeliveryReportsResource $resource): array
    {
        Validator::validateResource($resource);

        return $this->client->get('sms/1/reports', $resource->queryOptions());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/sms/get-outbound-sms-message-logs
     * @throws InfobipValidationException
     */
    public function getOutboundSMSMessageLogs(GetOutboundSMSMessageLogsResource $resource): array
    {
        Validator::validateResource($resource);

        return $this->client->get('sms/1/logs', $resource->queryOptions());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/sms/get-inbound-sms-messages
     * @throws InfobipValidationException
     */
    public function getInboundSMSMessages(GetInboundSMSMessagesResource $resource): array
    {
        Validator::validateResource($resource);

        return $this->client->get('sms/1/inbox/reports', $resource->queryOptions());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/sms/get-inbound-sms-messages
     */
    public function getScheduledSMSMessages(GetScheduledSMSMessagesResource $resource): array
    {
        return $this->client->get('sms/1/bulks', $resource->queryOptions());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/sms/reschedule-sms-messages
     */
    public function rescheduleSMSMessages(RescheduleSMSMessagesResource $resource): array
    {
        return $this->client->put('sms/1/bulks', $resource->payload(), $resource->queryOptions());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/sms/get-scheduled-sms-messages-status
     */
    public function getScheduledSMSMessagesStatus(GetScheduledSMSMessagesStatusResource $resource): array
    {
        return $this->client->get('sms/1/bulks/status', $resource->queryOptions());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/sms/reschedule-sms-messages
     */
    public function updateScheduledSMSMessagesStatus(UpdateScheduledSMSMessagesStatusResource $resource): array
    {
        return $this->client->put('sms/1/bulks/status', $resource->payload(), $resource->queryOptions());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/sms/get-2fa-applications
     */
    public function getTwoFAApplications(): array
    {
        return $this->client->get('2fa/2/applications');
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/sms/create-2fa-application
     */
    public function createTwoFAApplication(CreateTwoFAApplicationResource $resource): array
    {
        return $this->client->post('2fa/2/applications', $resource->payload());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/sms/get-2fa-application
     */
    public function getTwoFAApplication(GetTwoFAApplicationResource $resource): array
    {
        $endpoint = sprintf(
            '2fa/2/applications/%s',
            $resource->getAppId()
        );

        return $this->client->get($endpoint);
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/sms/update-2fa-application
     */
    public function updateTwoFAApplication(UpdateTwoFAApplicationResource $resource): array
    {
        $endpoint = sprintf(
            '2fa/2/applications/%s',
            $resource->getAppId()
        );

        return $this->client->put($endpoint, $resource->payload());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/sms/get-2fa-message-templates
     */
    public function getTwoFAMessageTemplates(GetTwoFAMessageTemplatesResource $resource): array
    {
        $endpoint = sprintf(
            '2fa/2/applications/%s/messages',
            $resource->getAppId()
        );

        return $this->client->get($endpoint);
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/sms/create-2fa-message-template
     * @throws InfobipValidationException
     */
    public function createTwoFAMessageTemplate(CreateTwoFAMessageTemplateResource $resource): array
    {
        Validator::validateResource($resource);

        $endpoint = sprintf(
            '2fa/2/applications/%s/messages',
            $resource->getAppId()
        );

        return $this->client->post($endpoint, $resource->payload());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/sms/get-2fa-message-template
     */
    public function getTwoFAMessageTemplate(GetTwoFAMessageTemplateResource $resource): array
    {
        $endpoint = sprintf(
            '2fa/2/applications/%s/messages/%s',
            $resource->getAppId(),
            $resource->getMsgId()
        );

        return $this->client->get($endpoint);
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/sms/update-2fa-message-template
     * @throws InfobipValidationException
     */
    public function updateTwoFAMessageTemplate(UpdateTwoFAMessageTemplateResource $resource): array
    {
        Validator::validateResource($resource);

        $endpoint = sprintf(
            '2fa/2/applications/%s/messages/%s',
            $resource->getAppId(),
            $resource->getMsgId()
        );

        return $this->client->put($endpoint, $resource->payload());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/sms/send-2fa-pin-code-over-sms
     */
    public function sendTwoFAPinCodeOverSMS(SendTwoFAPinCodeOverSMSResource $resource): array
    {
        return $this->client->post('2fa/2/pin', $resource->payload(), $resource->queryOptions());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/sms/resend-2fa-pin-code-over-sms
     */
    public function resendTwoFAPinCodeOverSMS(ResendTwoFAPinCodeOverSMSResource $resource): array
    {
        $endpoint = sprintf(
            '2fa/2/pin/%s/resend',
            $resource->getPinId()
        );

        return $this->client->post($endpoint, $resource->payload());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/sms/send-2fa-pin-code-over-voice
     */
    public function sendTwoFAPinCodeOverVoice(SendTwoFAPinCodeOverVoiceResource $resource): array
    {
        return $this->client->post('2fa/2/pin/voice', $resource->payload());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/sms/resend-2fa-pin-code-over-voice
     */
    public function resendTwoFAPinCodeOverVoice(ResendTwoFAPinCodeOverVoiceResource $resource): array
    {
        $endpoint = sprintf(
            '2fa/2/pin/%s/resend/voice',
            $resource->getPinId()
        );

        return $this->client->post($endpoint, $resource->payload());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/sms/verify-2fa-phone-number
     */
    public function verifyPhoneNumber(VerifyPhoneNumberResource $resource): array
    {
        $endpoint = sprintf(
            '2fa/2/pin/%s/verify',
            $resource->getPinId()
        );

        return $this->client->post($endpoint, $resource->payload());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/sms/get-2fa-verification-status
     */
    public function getTwoFAVerificationStatus(GetTwoFAVerificationStatusResource $resource): array
    {
        $endpoint = sprintf(
            '2fa/2/applications/%s/verifications',
            $resource->getAppId()
        );

        return $this->client->get($endpoint, $resource->queryOptions());
    }
}
