<?php

namespace Brain\Cell\Tests\Transformer;

use Brain\Cell\Tests\BaseTestCase;
use Brain\Cell\Tests\Mock\SimpleResourceMock;
use Brain\Cell\Transfer\EntityResourceFactory;

/**
 * @group cell
 * @group transformer
 */
class EntityFactoryTest extends BaseTestCase
{

    /** @var EntityResourceFactory */
    protected $factory;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->factory = new EntityResourceFactory;
    }

    /**
     * @test
     */
    public function factoryConstructsNewTransferEntities()
    {

        /** @var SimpleResourceMock $response */
        $response = $this->factory->create(SimpleResourceMock::CLASS);
        $this->assertNull($response->getId(), 'The id should not have been set on construction');

        $response = $this->factory->create(SimpleResourceMock::CLASS, 1);
        $this->assertEquals(1, $response->getId(), 'The id should have been set on construction');

    }

}
