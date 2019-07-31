<?php

declare(strict_types=1);

namespace Brain\Cell\Tests\Unit\Transformer\Decoder;

use Brain\Cell\Exception\RuntimeException;
use Brain\Cell\Tests\Mock\Association\SimpleResourceAssociationMock;
use Brain\Cell\Tests\Mock\Association\SimpleResourceCollectionAssociationMock;
use Brain\Cell\Tests\Mock\SimpleResourceMock;
use Brain\Cell\Transfer\ResourceCollection;
use Brain\Cell\TransferEntityInterface;
use Brain\Cell\Transformer\ArrayDecoder;

use PHPUnit\Framework\TestCase;

/**
 * @group cell
 * @group transformer
 * @group transformer-decoder
 *
 * @covers \Brain\Cell\Transformer\ArrayDecoder
 */
final class ArrayDecoderTest extends TestCase
{
    /**
     * @test
     *
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Unexpected TransferEntityInterface
     */
    public function decoderWillThrowOnInvalidTransferEntityInterface(): void
    {
        /** @var TransferEntityInterface $entity */
        $entity = $this->createMock(TransferEntityInterface::class);

        (new ArrayDecoder())->decode($entity, []);
    }

    /**
     * @test
     *
     * @expectedException \RuntimeException
     * @expectedExceptionMessage The ResourceCollection has no entity class set
     */
    public function decoderWillThrowWithCollectionMissingEntityClass(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Missing entity class for collection');

        (new ArrayDecoder())->decode(new ResourceCollection(), [1, 2, 3]);
    }

    /**
     * @test
     */
    public function decodingSimpleResources(): void
    {
        $data = [
            'id' => 'some-id',
            'name' => 'string',
        ];

        /** @var SimpleResourceMock $response */
        $response = (new ArrayDecoder())->decode(new SimpleResourceMock(), $data);

        self::assertEquals($data['id'], $response->getId());
        self::assertEquals($data['name'], $response->getName());
    }

    /**
     * @test
     */
    public function decoderWillNotThrowWithAdditionalData(): void
    {
        $data = [
            'id' => 'some-id',
            'name' => 'Tony Stark',
            'occupation' => 'Marvelous Super Hero',
        ];

        /** @var SimpleResourceMock $resource */
        $resource = (new ArrayDecoder())->decode(new SimpleResourceMock(), $data);

        self::assertEquals('some-id', $resource->getId());
        self::assertEquals('Tony Stark', $resource->getName());
    }

    public function decoderWillThrowWithMissingProperties(): void
    {
        $data = [
            'id' => 'some-id',
        ];

        (new ArrayDecoder())->decode(new SimpleResourceMock(), $data);
    }

    /**
     * @test
     */
    public function decodeSimpleResourcesWithAssociations(): void
    {
        $data = [
            'id' => 'some-id',
            'associatedResource' => [
                'id' => 'another-id',
                'name' => 'string',
            ],
        ];

        /** @var SimpleResourceAssociationMock $response */
        $response = (new ArrayDecoder())->decode(new SimpleResourceAssociationMock(), $data);

        self::assertEquals($data['id'], $response->getId());

        $association = $response->getAssociatedResource();
        self::assertArrayHasKey('associatedResource', $data);
        self::assertEquals($data['associatedResource']['id'], $association->getId());
        self::assertEquals($data['associatedResource']['name'], $association->getName());
    }

    /**
     * @test
     */
    public function decodeSimpleResourceCollections(): void
    {
        $data = [
            ['id' => 'some-id', 'name' => 'one'],
            ['id' => 'another-id', 'name' => 'two'],
        ];

        $collection = new ResourceCollection();
        $collection->setEntityClass(SimpleResourceMock::class);

        /** @var ResourceCollection $collection */
        $collection = (new ArrayDecoder())->decode($collection, $data);

        foreach ($collection as $resource) {
            self::assertNotNull($resource->getId());
        }
    }

    /**
     * @test
     */
    public function decodeSimpleResourceCollectionsAsAssociations(): void
    {
        $data = [
            'id' => 'some-id',
            'associatedCollection' => [
                ['id' => 'id-1', 'name' => 'one'],
                ['id' => 'id-2', 'name' => 'two'],
                ['id' => 'id-3', 'name' => 'three'],
            ],
        ];

        /** @var SimpleResourceCollectionAssociationMock $response */
        $response = (new ArrayDecoder())->decode(new SimpleResourceCollectionAssociationMock(), $data);

        self::assertEquals($data['id'], $response->getId());

        $collection = $response->getAssociatedCollection();

        foreach ($collection as $resource) {
            self::assertNotNull($resource->getId());
        }
    }
}
