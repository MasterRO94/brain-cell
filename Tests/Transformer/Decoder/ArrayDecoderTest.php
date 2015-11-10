<?php

namespace Brain\Cell\Tests\Transformer\Decoder;

use Brain\Cell\Exception\RuntimeException;
use Brain\Cell\Tests\BaseTestCase;
use Brain\Cell\Tests\Mock\SimpleResourceMock;
use Brain\Cell\Transfer\ResourceCollection;
use Brain\Cell\TransferEntityInterface;
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
     *
     * @expectedException RuntimeException
     * @expectedExceptionMessage The given $data must be an array
     */
    public function decoderWillThrowOnInvalidData()
    {
        $this->decoder->decode(new SimpleResourceMock, null);
    }

    /**
     * @test
     *
     * @expectedException RuntimeException
     * @expectedExceptionMessage Unexpected TransferEntityInterface
     */
    public function decoderWillThrowOnInvalidTransferEntityInterface()
    {

        /** @var TransferEntityInterface $entity */
        $entity = $this->getMock(TransferEntityInterface::CLASS);

        $this->decoder->decode($entity, []);

    }

    /**
     * @test
     *
     * @expectedException RuntimeException
     * @expectedExceptionMessage The ResourceCollection $data is not formatted correctly
     */
    public function decoderWillThrowWithInvalidCollectionData()
    {
        $this->decoder->decode(new ResourceCollection, [1, 2, 3]);
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
