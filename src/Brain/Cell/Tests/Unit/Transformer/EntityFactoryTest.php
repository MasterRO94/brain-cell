<?php

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
    public function factoryConstructsNewTransferEntities()
    {
        /** @var SimpleResourceMock $response */
        $response = $this->factory->create(SimpleResourceMock::class);
        $this->assertNull($response->getId(), 'The id should not have been set on construction');

        $response = $this->factory->create(SimpleResourceMock::class, 1);
        $this->assertEquals(1, $response->getId(), 'The id should have been set on construction');
    }
}
