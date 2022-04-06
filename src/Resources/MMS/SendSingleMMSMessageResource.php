<?php

declare(strict_types=1);

namespace Infobip\Resources\MMS;

use Infobip\Resources\ResourcePayloadInterface;
use Infobip\Resources\MMS\Models\ExternallyHostedMedia;
use Infobip\Resources\MMS\Models\Head;
use Infobip\Resources\ResourceValidationInterface;
use Infobip\Validations\Rules;

/**
 * @link https://www.infobip.com/docs/api#channels/mms/send-mms-single-message
 */
final class SendSingleMMSMessageResource implements ResourcePayloadInterface, ResourceValidationInterface
{
    /**
     * @var Head|null
     */
    private $head = null;

    /** @var string|null */
    private $text = null;

    /** @var string|null */
    private $media = null;

    /** @var ExternallyHostedMedia|null */
    private $externallyHostedMedia = null;

    /** @var string|null */
    private $smil = null;

    public function setHead(?Head $head): self
    {
        $this->head = $head;

        return $this;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function setMedia(?string $media): self
    {
        $this->media = $media;

        return $this;
    }

    public function setExternallyHostedMedia(?ExternallyHostedMedia $externallyHostedMedia): self
    {
        $this->externallyHostedMedia = $externallyHostedMedia;

        return $this;
    }

    public function setSmil(?string $smil): self
    {
        $this->smil = $smil;

        return $this;
    }

    public function payload(): array
    {
        return array_filter_recursive([
            'head' => $this->head ? $this->head->toArray() : null,
            'text' => $this->text,
            'media' => $this->media,
            'externallyHostedMedia' => $this->externallyHostedMedia ? $this->externallyHostedMedia->toArray() : null,
            'smil' => $this->smil,
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addModelRules($this->head)
            ->addModelRules($this->externallyHostedMedia);
    }
}
