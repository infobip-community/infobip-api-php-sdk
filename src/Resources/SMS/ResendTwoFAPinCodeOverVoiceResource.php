<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS;

use Infobip\Resources\ResourcePayloadInterface;
use Infobip\Resources\SMS\Collections\PlaceholderCollection;
use Infobip\Resources\SMS\Models\Placeholder;

/**
 * @link https://www.infobip.com/docs/api#channels/sms/resend-2fa-pin-code-over-voice
 */
final class ResendTwoFAPinCodeOverVoiceResource implements ResourcePayloadInterface
{
    /** @var string */
    private $pinId;

    /** @var PlaceholderCollection */
    private $placeholders;

    public function __construct(string $pinId)
    {
        $this->pinId = $pinId;
        $this->placeholders = new PlaceholderCollection();
    }

    public function getPinId(): string
    {
        return $this->pinId;
    }

    public function addPlaceholder(Placeholder $placeholder): self
    {
        $this->placeholders->add($placeholder);

        return $this;
    }

    public function payload(): array
    {
        return array_filter_recursive([
            'placeholders' => $this->placeholders->toArray(),
        ]);
    }
}
