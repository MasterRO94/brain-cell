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
    /** @var EntityResourceFactory */
    protected $factory;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->factory = new EntityResourceFactory();
    }

    /**
     * @test
     */
    public function factoryConstructsNewTransferEntities(): void
    {
        /** @var SimpleResourceMock $response */
        $response = $this->factory->create(SimpleResourceMock::class);
        $this->assertNull($response->getId(), 'The id should not have been set on construction');

        /** @var SimpleResourceMock $response */
        $response = $this->factory->create(SimpleResourceMock::class, 'some-id');
        $this->assertEquals('some-id', $response->getId(), 'The id should have been set on construction');
    }
}
