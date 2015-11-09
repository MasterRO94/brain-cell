<?php

namespace Brain\Cell\Tests\Transformer\Encoder;

use Brain\Cell\Exception\RuntimeException;
use Brain\Cell\Tests\BaseTestCase;
use Brain\Cell\Tests\Mock\Association\SimpleResourceCollectionAssociationMock;
use Brain\Cell\Tests\Mock\SimpleResourceMock;
use Brain\Cell\Transformer\ArrayEncoder;

/**
 * @group cell
 * @group transformer
 * @group transformer-encoder
 */
class ArrayEncoderTest extends BaseTestCase
{

    /** @var ArrayEncoder */
    protected $encoder;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->encoder = new ArrayEncoder;
    }

    /**
     * @test
     */
    public function encoderPopulatesMissingCollections()
    {
        $resource = SimpleResourceCollectionAssociationMock::create(10);

        $expected = [
            'id' => 10,
            'associations' => ['data' => []]
        ];

        $response = $this->encoder->encode($resource);
        $this->assertEquals($expected, $response);

    }

    /**
     * @test
     *
     * @expectedException RuntimeException
     * @expectedExceptionMessage Was not expected EntityResource at "name" of "Brain\Cell\Tests\Mock\SimpleResourceMock"
     */
    public function encoderRefusesToEncodeInvalidEntityResourceProperties()
    {
        $internal = SimpleResourceMock::create(1, 'Tony Stark');
        $resource = SimpleResourceMock::create(2, $internal);

        $this->encoder->encode($resource);

    }

}
