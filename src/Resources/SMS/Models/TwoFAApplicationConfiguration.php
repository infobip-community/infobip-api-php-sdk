<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS\Models;

use Infobip\Resources\ModelInterface;

final class TwoFAApplicationConfiguration implements ModelInterface
{
    /** @var bool */
    private $allowMultiplePinVerifications = true;

    /** @var int */
    private $pinAttempts = 10;

    /** @var string */
    private $pinTimeToLive = '15m';

    /** @var string */
    private $sendPinPerApplicationLimit = '10000/1d';

    /** @var string */
    private $sendPinPerPhoneNumberLimit = '3/1d';

    /** @var string */
    private $verifyPinLimit = '1/3s';

    public function setAllowMultiplePinVerifications(bool $allowMultiplePinVerifications): self
    {
        $this->allowMultiplePinVerifications = $allowMultiplePinVerifications;

        return $this;
    }

    public function setPinAttempts(int $pinAttempts): self
    {
        $this->pinAttempts = $pinAttempts;

        return $this;
    }

    public function setPinTimeToLive(string $pinTimeToLive): self
    {
        $this->pinTimeToLive = $pinTimeToLive;

        return $this;
    }

    public function setSendPinPerApplicationLimit(string $sendPinPerApplicationLimit): self
    {
        $this->sendPinPerApplicationLimit = $sendPinPerApplicationLimit;

        return $this;
    }

    public function setSendPinPerPhoneNumberLimit(string $sendPinPerPhoneNumberLimit): self
    {
        $this->sendPinPerPhoneNumberLimit = $sendPinPerPhoneNumberLimit;

        return $this;
    }

    public function setVerifyPinLimit(string $verifyPinLimit): self
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
