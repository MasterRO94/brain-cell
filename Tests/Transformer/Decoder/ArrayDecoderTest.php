<?php

namespace Brain\Cell\Tests\Transformer\Decoder;

use Brain\Cell\Tests\BaseTestCase;
use Brain\Cell\Tests\Mock\SimpleResourceMock;
use Brain\Cell\Transformer\ArrayDecoder;

/**
 * @group cell
 * @group transformer
 * @group transformer-decoder
 */
class ArrayDecoderTest extends BaseTestCase
{

    /** @var ArrayDecoder */
    protected $decoder;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->decoder = new ArrayDecoder;
    }

    /**
     * @test
     */
    public function decoderWillIgnoreExtraProperties()
    {

        $data = [
            'id' => 100,
            'name' => 'Tony Stark',
            'occupation' => 'Marvelous Super Hero'
        ];

        /** @var SimpleResourceMock $resource */
        $resource = $this->decoder->decode(new SimpleResourceMock, $data);

        $this->assertEquals(100, $resource->getId());
        $this->assertEquals('Tony Stark', $resource->getName());

    }

}
