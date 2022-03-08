<?php

declare(strict_types=1);

namespace Infobip\Resources\WebRTC\Models;

use Infobip\Resources\ModelInterface;

final class Android implements ModelInterface
{
    /** @var string */
    private $apnsCertificateFileName;

    /** @var string */
    private $apnsCertificateFileContent;

    /** @var string|null */
    private $apnsCertificatePassword = null;

    public function __construct(
        string $apnsCertificateFileName,
        string $apnsCertificateFileContent
    ) {
        $this->apnsCertificateFileName = $apnsCertificateFileName;
        $this->apnsCertificateFileContent = $apnsCertificateFileContent;
    }

    public function setApnsCertificatePassword(?string $apnsCertificatePassword): self
    {
        $this->apnsCertificatePassword = $apnsCertificatePassword;
        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'apnsCertificateFileName' => $this->apnsCertificateFileName,
            'apnsCertificateFileContent' => $this->apnsCertificateFileContent,
            'apnsCertificatePassword' => $this->apnsCertificatePassword,
        ]);
    }
}
