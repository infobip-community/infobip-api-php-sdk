<?php

declare(strict_types=1);

namespace Infobip\Resources\WebRTC;

use Infobip\Resources\ResourcePayloadInterface;
use Infobip\Resources\ResourceValidationInterface;
use Infobip\Resources\WebRTC\Models\Capabilities;
use Infobip\Validations\RuleCollection;
use Infobip\Validations\Rules\BetweenLengthRule;
use Infobip\Validations\Rules\MaxNumberRule;

/**
 * @link https://www.infobip.com/docs/api#channels/webrtc/generate-webrtc-token
 */
final class GenerateWebRTCTokenResource implements ResourcePayloadInterface, ResourceValidationInterface
{
    /** @var string */
    private $identity;

    /** @var string|null */
    private $applicationId = null;

    /** @var string|null */
    private $displayName = null;

    /** @var Capabilities|null */
    private $capabilities = null;

    /** @var int|null */
    private $timeToLive;

    public function __construct(string $identity)
    {
        $this->identity = $identity;
    }

    public function setApplicationId(?string $applicationId): self
    {
        $this->applicationId = $applicationId;
        return $this;
    }

    public function setDisplayName(?string $displayName): self
    {
        $this->displayName = $displayName;
        return $this;
    }

    public function setCapabilities(?Capabilities $capabilities): self
    {
        $this->capabilities = $capabilities;
        return $this;
    }

    public function setTimeToLive(?int $timeToLive): self
    {
        $this->timeToLive = $timeToLive;
        return $this;
    }

    public function payload(): array
    {
        return array_filter_recursive([
            'identity' => $this->identity,
            'applicationId' => $this->applicationId,
            'displayName' => $this->displayName,
            'capabilities' => $this->capabilities ? $this->capabilities->toArray() : null,
            'timeToLive' => $this->timeToLive,
        ]);
    }

    public function validationRules(): RuleCollection
    {
        return (new RuleCollection())
            ->add(new BetweenLengthRule('identity', $this->identity, 3, 64))
            ->add(new BetweenLengthRule('displayName', $this->displayName, 5, 50))
            ->add(new MaxNumberRule('timeToLive', $this->timeToLive, 60 * 60 * 24));
    }
}
