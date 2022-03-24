<?php

declare(strict_types=1);

namespace Infobip\Resources\MMS\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\ResourceValidationInterface;
use Infobip\Validations\RuleCollection;
use Infobip\Validations\Rules\UrlRule;

final class ExternallyHostedMedia implements ModelInterface, ResourceValidationInterface
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

    public function validationRules(): RuleCollection
    {
        return (new RuleCollection())
            ->add(new UrlRule('externallyHostedMedia.contentUrl', $this->contentUrl));
    }
}
