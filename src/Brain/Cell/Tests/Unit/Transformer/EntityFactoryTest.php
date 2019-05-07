<?php

declare(strict_types=1);

namespace Brain\Cell\Tests\Unit\Transformer;

use Brain\Cell\Tests\Mock\SimpleResourceMock;
use Brain\Cell\Transfer\EntityResourceFactory;

use PHPUnit\Framework\TestCase;

/**
 * @group cell
 * @group transformer
 *
 * @covers \Brain\Cell\Transfer\EntityResourceFactory
 */
final class EntityFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function factoryConstructsNewTransferEntities(): void
    {
        /** @var SimpleResourceMock $resource */
        $resource = (new EntityResourceFactory())->create(SimpleResourceMock::class);

        self::assertNull($resource->getId());
    }

    /**
     * @test
     */
    public function factoryConstructsNewTransferEntitiesWithId(): void
    {
        /** @var SimpleResourceMock $resource */
        $resource = (new EntityResourceFactory())->create(SimpleResourceMock::class, 'some-id');

        self::assertEquals('some-id', $resource->getId());
    }
}
