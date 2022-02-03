<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;

final class Org implements ModelInterface
{
    /** @var string|null */
    private $company = null;

    /** @var string|null */
    private $department = null;

    /** @var string|null */
    private $title = null;

    public function setCompany(?string $company): self
    {
        $this->company = $company;
        return $this;
    }

    public function setDepartment(?string $department): self
    {
        $this->department = $department;
        return $this;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'company' => $this->company,
            'department' => $this->department,
            'title' => $this->title,
        ]);
    }
}
