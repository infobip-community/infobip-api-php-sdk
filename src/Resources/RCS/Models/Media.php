<?php

declare(strict_types=1);

namespace Infobip\Resources\RCS\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\RCS\Enums\Height;

final class Media implements ModelInterface
{
    /** @var File */
    private $file;

    /** @var Height */
    private $height;

    /** @var Thumbnail|null */
    private $thumbnail = null;

    public function __construct(
        File $file,
        Height $height
    ) {
        $this->file = $file;
        $this->height = $height;
    }

    public function setThumbnail(?Thumbnail $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'file' => $this->file,
            'height' => $this->height->getValue(),
            'thumbnail' => $this->thumbnail ? $this->thumbnail->toArray() : null,
        ]);
    }
}
