<?php

declare(strict_types=1);

namespace Infobip\Resources\RCS\Models;

use Infobip\Resources\RCS\Contracts\MessageContentInterface;
use Infobip\Resources\RCS\Enums\MessageContentType;
use Infobip\Validations\Rules;

final class FileMessageContent implements MessageContentInterface
{
    /** @var MessageContentType */
    private $type;

    /** @var File */
    private $file;

    /** @var Thumbnail|null */
    private $thumbnail = null;

    public function __construct(File $file)
    {
        $this->file = $file;
        $this->type = new MessageContentType(MessageContentType::FILE);
    }

    public function setThumbnail(?Thumbnail $thumbnail): void
    {
        $this->thumbnail = $thumbnail;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'type' => $this->type->getValue(),
            'file' => $this->file->toArray(),
            'thumbnail' => $this->thumbnail ? $this->thumbnail->toArray() : null,
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addModelRules($this->thumbnail);
    }
}
