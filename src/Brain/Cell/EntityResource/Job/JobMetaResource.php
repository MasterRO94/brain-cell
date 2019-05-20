<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\Transfer\AbstractResource;

/**
 * {@inheritdoc}
 */
final class JobMetaResource extends AbstractResource implements
    JobMetaResourceInterface
{
    /** @var mixed[]|null */
    protected $data;

    /** @var string|null */
    protected $group;

    /** @var string|null */
    protected $note;

    /**
     * {@inheritdoc}
     */
    public function getUnstructuredFields(): array
    {
        return [
            'data',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getData(): ?array
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function setData(?array $data): void
    {
        $this->data = $data;
    }

    public function getGroup(): ?string
    {
        return $this->group;
    }

    public function setGroup(?string $group): void
    {
        $this->group = $group;
    }

    /**
     * {@inheritdoc}
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): void
    {
        $this->note = $note;
    }
}
