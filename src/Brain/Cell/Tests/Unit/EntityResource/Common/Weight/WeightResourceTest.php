<?php

declare(strict_types=1);

namespace Brain\Cell\Tests\Unit\EntityResource\Common\Weight;

use Brain\Cell\EntityResource\Common\Weight\WeightResource;
use Brain\Cell\EntityResource\Common\Weight\WeightResourceInterface;
use Brain\Cell\Transformer\ArrayDecoder;

use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @group unit
 * @group resource
 *
 * @covers \Brain\Cell\EntityResource\Common\Weight\WeightResource
 */
final class WeightResourceTest extends TestCase
{
    /**
     * @test
     *
     * @throws ReflectionException
     */
    public function withEmptyPayloadUseDefaults(): void
    {
        $payload = [];

        $resource = new WeightResource();

        $decoder = new ArrayDecoder();
        $decoder->decode($resource, $payload);

        self::assertEquals(0, $resource->getValue());
        self::assertEquals(WeightResourceInterface::UNIT_GRAMS, $resource->getUnit());
    }

    /**
     * @test
     *
     * @throws ReflectionException
     */
    public function canTransformFromPayload(): void
    {
        $payload = [
            'value' => 100,
            'unit' => 'something',
        ];

        $resource = new WeightResource();

        $decoder = new ArrayDecoder();
        $decoder->decode($resource, $payload);

        self::assertEquals(100, $resource->getValue());
        self::assertEquals('something', $resource->getUnit());
    }
}
