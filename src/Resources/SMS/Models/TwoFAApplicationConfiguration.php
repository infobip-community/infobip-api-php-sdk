<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS\Models;

use Infobip\Resources\ModelInterface;

final class TwoFAApplicationConfiguration implements ModelInterface
{
    /** @var bool|null */
    private $allowMultiplePinVerifications;

    /** @var int|null */
    private $pinAttempts;

    /** @var string|null */
    private $pinTimeToLive;

    /** @var string|null */
    private $sendPinPerApplicationLimit;

    /** @var string|null */
    private $sendPinPerPhoneNumberLimit;

    /** @var string|null */
    private $verifyPinLimit;

    public function setAllowMultiplePinVerifications(?bool $allowMultiplePinVerifications): self
    {
        $this->allowMultiplePinVerifications = $allowMultiplePinVerifications;

        return $this;
    }

    public function setPinAttempts(?int $pinAttempts): self
    {
        $this->pinAttempts = $pinAttempts;

        return $this;
    }

    public function setPinTimeToLive(?string $pinTimeToLive): self
    {
        $this->pinTimeToLive = $pinTimeToLive;

        return $this;
    }

    public function setSendPinPerApplicationLimit(?string $sendPinPerApplicationLimit): self
    {
        $this->sendPinPerApplicationLimit = $sendPinPerApplicationLimit;

        return $this;
    }

    public function setSendPinPerPhoneNumberLimit(?string $sendPinPerPhoneNumberLimit): self
    {
        $this->sendPinPerPhoneNumberLimit = $sendPinPerPhoneNumberLimit;

        return $this;
    }

    public function setVerifyPinLimit(?string $verifyPinLimit): self
    {
        $this->verifyPinLimit = $verifyPinLimit;

        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'allowMultiplePinVerifications' => $this->allowMultiplePinVerifications,
            'pinAttempts' => $this->pinAttempts,
            'pinTimeToLive' => $this->pinTimeToLive,
            'sendPinPerApplicationLimit' => $this->sendPinPerApplicationLimit,
            'sendPinPerPhoneNumberLimit' => $this->sendPinPerPhoneNumberLimit,
            'verifyPinLimit' => $this->verifyPinLimit,
        ]);
    }
}
