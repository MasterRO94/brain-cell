<?php

declare(strict_types=1);

namespace Brain\Cell\Tests\Unit\Transformer\Encoder;

use Brain\Cell\Tests\Mock\Association\SimpleResourceAssociationMock;
use Brain\Cell\Tests\Mock\Association\SimpleResourceCollectionAssociationMock;
use Brain\Cell\Tests\Mock\SimpleResourceMock;
use Brain\Cell\Transfer\ResourceCollection;
use Brain\Cell\TransferEntityInterface;
use Brain\Cell\Transformer\ArrayEncoder;

use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * @group cell
 * @group transformer
 * @group transformer-encoder
 *
 * @covers \Brain\Cell\Transformer\ArrayEncoder
 */
final class ArrayEncoderTest extends TestCase
{
    /**
     * @test
     *
     * @expectedException RuntimeException
     * @expectedExceptionMessage Unexpected TransferEntityInterface
     */
    public function encoderWillThrowOnInvalidTransferEntityInterface(): void
    {
        /** @var TransferEntityInterface $entity */
        $entity = $this->createMock(TransferEntityInterface::class);

        (new ArrayEncoder())->encode($entity);
    }

    /**
     * @test
     */
    public function encodeSimpleResources(): void
    {
        $resource = SimpleResourceMock::create('some-id', 'string');

        $expected = [
            'id' => 'some-id',
            'name' => 'string',
        ];

        $response = (new ArrayEncoder())->encode($resource);
        self::assertEquals($expected, $response);
    }

    /**
     * @test
     */
    public function encodeSimpleResourcesWithAssociations(): void
    {
        $resource = SimpleResourceMock::create('some-id', 'string');

        $parent = SimpleResourceAssociationMock::create('another-id');
        $parent->setAssociatedResource($resource);

        $expected = [
            'id' => 'another-id',
            'associated_resource' => 'some-id',
        ];

        $response = (new ArrayEncoder())->encode($parent);
        self::assertEquals($expected, $response);
    }

    /**
     * @test
     */
    public function encodeSimpleResourceCollections(): void
    {
        $collection = new ResourceCollection();
        $collection->add(SimpleResourceMock::create('some-id', 'one'));
        $collection->add(SimpleResourceMock::create('another-id', 'two'));

        $expected = [
            'some-id',
            'another-id',
        ];

        $response = (new ArrayEncoder())->encode($collection);
        self::assertEquals($expected, $response);
    }

    /**
     * @test
     */
    public function encodeSimpleResourceCollectionsAsAssociations(): void
    {
        $collection = new ResourceCollection();
        $collection->add(SimpleResourceMock::create('id-1', 'one'));
        $collection->add(SimpleResourceMock::create('id-2', 'two'));
        $collection->add(SimpleResourceMock::create('id-3', 'three'));

        $resource = SimpleResourceCollectionAssociationMock::create('id-4');
        $resource->setAssociatedCollection($collection);

        $expected = [
            'id' => 'id-4',
            'associated_collection' => [
                'id-1',
                'id-2',
                'id-3',
            ],
        ];

        $response = (new ArrayEncoder())->encode($resource);
        self::assertEquals($expected, $response);
    }
}
