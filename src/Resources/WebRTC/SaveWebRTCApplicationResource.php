<?php

declare(strict_types=1);

namespace Infobip\Resources\WebRTC;

use Infobip\Resources\ResourcePayloadInterface;
use Infobip\Resources\ResourceValidationInterface;
use Infobip\Resources\WebRTC\Models\Android;
use Infobip\Resources\WebRTC\Models\Ios;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\MaxLengthRule;

/**
 * @link https://www.infobip.com/docs/api#channels/webrtc/save-webrtc-application
 */
final class SaveWebRTCApplicationResource implements ResourcePayloadInterface, ResourceValidationInterface
{
    /** @var string */
    private $name;

    /** @var string|null */
    private $description = null;

    /** @var Ios|null */
    private $ios = null;

    /** @var Android|null */
    private $android = null;

    /** @var bool */
    private $appToApp = false;

    /** @var bool */
    private $appToConversations = false;

    /** @var bool */
    private $appToPhone = false;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function setIos(?Ios $ios): self
    {
        $this->ios = $ios;
        return $this;
    }

    public function setAndroid(?Android $android): self
    {
        $this->android = $android;
        return $this;
    }

    public function setAppToApp(bool $appToApp): self
    {
        $this->appToApp = $appToApp;
        return $this;
    }

    public function setAppToConversations(bool $appToConversations): self
    {
        $this->appToConversations = $appToConversations;
        return $this;
    }

    public function setAppToPhone(bool $appToPhone): self
    {
        $this->appToPhone = $appToPhone;
        return $this;
    }

    public function payload(): array
    {
        return array_filter_recursive([
            'name' => $this->name,
            'description' => $this->description,
            'ios' => $this->ios ? $this->ios->toArray() : null,
            'android' => $this->android ? $this->android->toArray() : null,
            'appToApp' => $this->appToApp,
            'appToConversations' => $this->appToConversations,
            'appToPhone' => $this->appToPhone,
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new MaxLengthRule('description', $this->description, 160));
    }
}
