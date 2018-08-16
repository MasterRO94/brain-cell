<?php

namespace Brain\Cell\Tests\Unit\Transfer;

use Brain\Cell\Tests\Mock\Association\SimpleResourceAssociationMock;
use Brain\Cell\Tests\Mock\SimpleResourceMock;
use Brain\Cell\Transfer\ResourceCollection;

use PHPUnit\Framework\TestCase;

/**
 * @group cell
 * @group transfer
 *
 * @covers \Brain\Cell\Transfer\ResourceCollection
 */
final class ResourceCollectionTest extends TestCase
{
    /** @var ResourceCollection */
    protected $collection;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->collection = new ResourceCollection();
    }

    /**
     * @test
     *
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Missing entity class for collection
     */
    public function getEntityClassOrThrowWillThrow()
    {
        $this->collection->getEntityClassOrThrow();
    }

    /**
     * @test
     *
     * @expectedException \RuntimeException
     * @expectedExceptionMessage ResourceCollection::add() only accepts instances of TransferEntityInterface
     */
    public function collectionRestrictsAddedEntriesToInstancesOfTransferEntityInterface()
    {
        $resource = new SimpleResourceMock();

        $this->collection->add($resource);
        $this->assertCount(1, $this->collection, 'Resource was not added to the ResourceCollection');

        /** @var SimpleResourceMock $resource */
        $resource = (object) [];

        $this->collection->add($resource);
        $this->fail('Collection should not accept anything but TransferEntityInterface');
    }

    /**
     * @test
     *
     * @expectedException \RuntimeException
     * @expectedExceptionMessage ResourceCollection::add() only accepts instances of "Brain\Cell\Tests\Mock\SimpleResourceMock"
     */
    public function collectionOptionallyRestrictsAddedEntriesToInstancesOfSetEntityClass()
    {
        $resource = new SimpleResourceMock();

        //  Setting this should now tell the collection to be super strict on added resources.
        $this->collection->setEntityClass(SimpleResourceMock::class);

        //  Lets try it out.
        $this->collection->add($resource);
        $this->assertCount(1, $this->collection, 'Resource was not added to the ResourceCollection');

        $this->collection->add(new SimpleResourceAssociationMock());
        $this->fail('Collection should not accept anything but the set entity class (SimpleResourceMock)');
    }
}
