<?php

namespace Brain\Cell\EntityResource\Product;

use Brain\Cell\EntityResource\Change\ChangeSetResource;
use Brain\Cell\Transfer\AbstractResource;

/**
 * {@inheritdoc}
 */
class ProductResource extends AbstractResource
{
    protected $id;

    protected $name;

    /**
     * @var ChangeSetResource|null
     */
    protected $changeSet;

    /**
     * @var ProductGroupResource|null
     */
    protected $productGroup;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            'changeSet' => ChangeSetResource::class,
            'productGroup' => ProductGroupResource::class,
        ];
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return ChangeSetResource|null
     */
    public function getChangeSet()
    {
        return $this->changeSet;
    }

    /**
     * @param ChangeSetResource $changeSet
     */
    public function setChangeSet($changeSet)
    {
        $this->changeSet = $changeSet;
    }

    /**
     * @return ProductGroupResource|null
     */
    public function getProductGroup()
    {
        return $this->productGroup;
    }

    /**
     * @param ProductGroupResource $productGroup
     */
    public function setProductGroup($productGroup)
    {
        $this->productGroup = $productGroup;
    }

}
