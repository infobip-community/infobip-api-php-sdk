<?php

declare(strict_types=1);

namespace Infobip\Resources\MMS\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\ModelValidationInterface;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\UrlRule;

final class ExternallyHostedMedia implements ModelInterface, ModelValidationInterface
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

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new UrlRule('externallyHostedMedia.contentUrl', $this->contentUrl));
    }
}
