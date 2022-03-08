<?php

declare(strict_types=1);

namespace Infobip\Resources\WebRTC;

/**
 * @link https://www.infobip.com/docs/api#channels/webrtc/get-webrtc-application
 */
final class GetWebRTCApplicationResource
{
    /** @var string */
    private $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
