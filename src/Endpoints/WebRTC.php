<?php

declare(strict_types=1);

namespace Infobip\Endpoints;

use Infobip\Exceptions\InfobipValidationException;
use Infobip\Resources\WebRTC\DeleteWebRTCApplicationResource;
use Infobip\Resources\WebRTC\GetWebRTCApplicationResource;
use Infobip\Resources\WebRTC\SaveWebRTCApplicationResource;
use Infobip\Resources\WebRTC\UpdateWebRTCApplicationResource;
use Infobip\Resources\WebRTC\GenerateWebRTCTokenResource;
use Infobip\Validations\Validator;

final class WebRTC extends BaseEndpoint
{
    /**
     * @link https://www.infobip.com/docs/api#channels/webrtc/generate-webrtc-token
     * @throws InfobipValidationException
     */
    public function generateWebRTCToken(GenerateWebRTCTokenResource $resource): array
    {
        Validator::validateResource($resource);

        return $this->client->post('/webrtc/1/token', $resource->payload());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/webrtc/get-webrtc-applications
     */
    public function getWebRTCApplications(): array
    {
        return $this->client->get('/webrtc/1/applications');
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/webrtc/save-webrtc-application
     * @throws InfobipValidationException
     */
    public function saveWebRTCApplication(SaveWebRTCApplicationResource $resource): array
    {
        Validator::validateResource($resource);

        return $this->client->post('/webrtc/1/applications', $resource->payload());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/webrtc/get-webrtc-application
     */
    public function getWebRTCApplication(GetWebRTCApplicationResource $resource): array
    {
        $endpoint = sprintf(
            '/webrtc/1/applications/%s',
            $resource->getId()
        );

        return $this->client->get($endpoint);
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/webrtc/update-webrtc-application
     * @throws InfobipValidationException
     */
    public function updateWebRTCApplication(UpdateWebRTCApplicationResource $resource): array
    {
        Validator::validateResource($resource);

        $endpoint = sprintf(
            '/webrtc/1/applications/%s',
            $resource->getId()
        );

        return $this->client->put($endpoint, $resource->payload());
    }

    /**
     * @link https://www.infobip.com/docs/api#channels/webrtc/delete-webrtc-application
     */
    public function deleteWebRTCApplication(DeleteWebRTCApplicationResource $resource): array
    {
        $endpoint = sprintf(
            '/webrtc/1/applications/%s',
            $resource->getId()
        );

        return $this->client->delete($endpoint);
    }
}
