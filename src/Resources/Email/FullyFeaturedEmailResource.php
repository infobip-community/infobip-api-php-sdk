<?php

declare(strict_types=1);

namespace Infobip\Resources\Email;

use Infobip\Resources\ResourcePayloadInterface;
use Infobip\Resources\ResourceValidationInterface;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\EmailRule;
use Infobip\Validations\Rules\UrlRule;
use Infobip\Validations\Rules\MaxLengthRule;

/**
 * @link https://www.infobip.com/docs/api#channels/email/send-email
 */
final class FullyFeaturedEmailResource implements ResourcePayloadInterface, ResourceValidationInterface
{
    /** @var string */
    private $from;

    /** @var string */
    private $to;

    /** @var string|null */
    private $cc = null;

    /** @var string|null */
    private $bcc = null;

    /** @var string */
    private $subject;

    /** @var string|null */
    private $text = null;

    /** @var string|null */
    private $bulkId = null;

    /** @var string|null */
    private $messageId = null;

    /** @var int|null */
    private $templateId = null;

    /** @var string|null */
    private $attachment = null;

    /** @var string|null */
    private $inlineImage = null;

    /** @var string|null */
    private $html = null;

    /** @var string|null */
    private $replyTo = null;

    /** @var string|null */
    private $defaultPlaceholders = null;

    /** @var bool */
    private $preserveRecipients = false;

    /** @var string|null */
    private $trackingUrl = null;

    /** @var bool */
    private $trackClicks = false;

    /** @var bool */
    private $trackOpens = false;

    /** @var bool */
    private $track = false;

    /** @var string|null */
    private $callbackData = null;

    /** @var bool */
    private $intermediateReport = false;

    /** @var string|null */
    private $notifyUrl = null;

    /** @var string|null */
    private $notifyContentType = null;

    /** @var string|null */
    private $sendAt = null;

    /** @var string|null */
    private $landingPagePlaceholders = null;

    /** @var string|null */
    private $landingPageId = null;

    public function __construct(
        string $from,
        string $to,
        string $subject
    ) {
        $this->from = $from;
        $this->to = $to;
        $this->subject = $subject;
    }

    public function setCc(?string $cc): self
    {
        $this->cc = $cc;

        return $this;
    }

    public function setBcc(?string $bcc): self
    {
        $this->bcc = $bcc;

        return $this;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function setBulkId(?string $bulkId): self
    {
        $this->bulkId = $bulkId;

        return $this;
    }

    public function setMessageId(?string $messageId): self
    {
        $this->messageId = $messageId;

        return $this;
    }

    public function setTemplateId(?int $templateId): self
    {
        $this->templateId = $templateId;

        return $this;
    }

    public function setAttachment(?string $attachment): self
    {
        $this->attachment = $attachment;

        return $this;
    }

    public function setInlineImage(?string $inlineImage): self
    {
        $this->inlineImage = $inlineImage;

        return $this;
    }

    public function setHtml(?string $html): self
    {
        $this->html = $html;

        return $this;
    }

    public function setReplyTo(?string $replyTo): self
    {
        $this->replyTo = $replyTo;

        return $this;
    }

    public function setDefaultPlaceholders(?string $defaultPlaceholders): self
    {
        $this->defaultPlaceholders = $defaultPlaceholders;

        return $this;
    }

    public function enablePreserveRecipients(): self
    {
        $this->preserveRecipients = true;

        return $this;
    }

    public function disablePreserveRecipients(): self
    {
        $this->preserveRecipients = false;

        return $this;
    }

    public function setTrackingUrl(?string $trackingUrl): self
    {
        $this->trackingUrl = $trackingUrl;

        return $this;
    }

    public function enableTrackClicks(): self
    {
        $this->trackClicks = true;

        return $this;
    }

    public function disableTrackClicks(): self
    {
        $this->trackClicks = false;

        return $this;
    }

    public function enableTrackOpens(): self
    {
        $this->trackOpens = true;

        return $this;
    }

    public function disableTrackOpens(): self
    {
        $this->trackOpens = false;

        return $this;
    }

    public function enableTrack(): self
    {
        $this->track = true;

        return $this;
    }

    public function disableTrack(): self
    {
        $this->track = false;

        return $this;
    }

    public function setCallbackData(?string $callbackData): self
    {
        $this->callbackData = $callbackData;

        return $this;
    }

    public function enableIntermediateReport(): self
    {
        $this->intermediateReport = true;

        return $this;
    }

    public function disableIntermediateReport(): self
    {
        $this->intermediateReport = false;

        return $this;
    }

    public function setNotifyUrl(?string $notifyUrl): self
    {
        $this->notifyUrl = $notifyUrl;

        return $this;
    }

    public function setNotifyContentType(?string $notifyContentType): self
    {
        $this->notifyContentType = $notifyContentType;

        return $this;
    }

    public function setSendAt(?string $sendAt): self
    {
        $this->sendAt = $sendAt;

        return $this;
    }

    public function setLandingPagePlaceholders(?string $landingPagePlaceholders): self
    {
        $this->landingPagePlaceholders = $landingPagePlaceholders;

        return $this;
    }

    public function setLandingPageId(?string $landingPageId): self
    {
        $this->landingPageId = $landingPageId;

        return $this;
    }

    public function payload(): array
    {
        return array_filter_recursive([
            'from' => $this->from,
            'to' => $this->to,
            'cc' => $this->cc,
            'bcc' => $this->bcc,
            'subject' => $this->subject,
            'text' => $this->text,
            'bulkId' => $this->bulkId,
            'messageId' => $this->messageId,
            'templateid' => $this->templateId,
            'attachment' => $this->attachment,
            'inlineImage' => $this->inlineImage,
            'HTML' => $this->html,
            'replyto' => $this->replyTo,
            'defaultplaceholders' => $this->defaultPlaceholders,
            'preserverecipients' => $this->preserveRecipients,
            'trackingUrl' => $this->trackingUrl,
            'trackclicks' => $this->trackClicks,
            'trackopens' => $this->trackOpens,
            'track' => $this->track,
            'callbackData' => $this->callbackData,
            'intermediateReport' => $this->intermediateReport,
            'notifyUrl' => $this->notifyUrl,
            'notifyContentType' => $this->notifyContentType,
            'sendAt' => $this->sendAt,
            'landingPagePlaceholders' => $this->landingPagePlaceholders,
            'landingPageId' => $this->landingPageId,
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new EmailRule('replyTo', $this->replyTo))
            ->addRule(new UrlRule('trackingUrl', $this->trackingUrl))
            ->addRule(new UrlRule('notifyUrl', $this->notifyUrl))
            ->addRule(new MaxLengthRule('callbackData', $this->callbackData, 4000));
    }
}
