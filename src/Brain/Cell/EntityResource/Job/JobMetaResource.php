<?php

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\Transfer\AbstractResource;

class JobMetaResource extends AbstractResource
{
    /**
     * @var array $data
     */
    protected $data;

    /**
     * @var string $group
     */
    protected $group;

    /**
     * @var string $note
     */
    protected $note;

    /**
     * {@inheritdoc}
     */
    public function getUnstructuredFields()
    {
        return [
            'data',
        ];
    }

    /**
     * @return array
     */
    public function getData(): ?array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getGroup(): ?string
    {
        return $this->group;
    }

    /**
     * @param string $group
     */
    public function setGroup(string $group)
    {
        $this->group = $group;
    }

    /**
     * @return string
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * @param string $note
     */
    public function setNote(string $note)
    {
        $this->note = $note;
    }

}
