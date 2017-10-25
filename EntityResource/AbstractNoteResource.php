<?php


namespace Brain\Cell\EntityResource;

use Brain\Cell\Transfer\AbstractResource;

class AbstractNoteResource extends AbstractResource
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var \DateTime
     */
    protected $created;

    /**
     * @var \DateTime
     */
    protected $updated;

    /**
     * @var  ClientResource
     */
    protected $origin;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            'origin' => ClientResource::class,
        ];
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @return ClientResource
     */
    public function getOrigin()
    {
        return $this->origin;
    }

}
