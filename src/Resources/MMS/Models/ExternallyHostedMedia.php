<?php

declare(strict_types=1);

namespace Infobip\Resources\MMS\Models;

use Infobip\Resources\ModelInterface;

final class ExternallyHostedMedia implements ModelInterface
{
    /** @var string */
    private $contentType;

    /** @var string */
    private $contentId;

    /** @var string */
    private $contentUrl;

    public function __construct(
        string $contentType,
        string $contentId,
        string $contentUrl
    ) {
        $this->contentType = $contentType;
        $this->contentId = $contentId;
        $this->contentUrl = $contentUrl;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'contentType' => $this->contentType,
            'contentId' => $this->contentId,
            'contentUrl' => $this->contentUrl,
        ]);
    }
}
