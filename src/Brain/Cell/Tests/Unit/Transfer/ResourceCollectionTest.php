<?php

declare(strict_types=1);

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
    /**
     * @test
     *
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Missing entity class for collection
     */
    public function getEntityClassOrThrowWillThrow(): void
    {
        (new ResourceCollection())->getEntityClassOrThrow();
    }

    /**
     * @test
     *
     * @expectedException \RuntimeException
     * @expectedExceptionMessage ResourceCollection::add() only accepts instances of TransferEntityInterface
     */
    public function collectionRestrictsAddedEntriesToInstancesOfTransferEntityInterface(): void
    {
        $resource = new SimpleResourceMock();

        $collection = new ResourceCollection();
        $collection->add($resource);
        self::assertCount(1, $collection, 'Resource was not added to the ResourceCollection');

        /** @var SimpleResourceMock $resource */
        $resource = (object) [];

        $collection->add($resource);
        self::fail('Collection should not accept anything but TransferEntityInterface');
    }

    /**
     * @test
     *
     * @expectedException \RuntimeException
     * @expectedExceptionMessage ResourceCollection::add() only accepts instances of "Brain\Cell\Tests\Mock\SimpleResourceMock"
     */
    public function collectionOptionallyRestrictsAddedEntriesToInstancesOfSetEntityClass(): void
    {
        $resource = new SimpleResourceMock();

        $collection = new ResourceCollection();

        // Setting this should now tell the collection to be super strict on added resources.
        $collection->setEntityClass(SimpleResourceMock::class);

        // Lets try it out.
        $collection->add($resource);
        self::assertCount(1, $collection, 'Resource was not added to the ResourceCollection');

        $collection->add(new SimpleResourceAssociationMock());
        self::fail('Collection should not accept anything but the set entity class (SimpleResourceMock)');
    }
}
