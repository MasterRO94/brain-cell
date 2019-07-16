<?php

declare(strict_types=1);

namespace Brain\Cell\Tests\Unit\EntityResource\Job;

use Brain\Cell\EntityResource\Job\JobResource;
use Brain\Cell\Transformer\ArrayDecoder;

use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @group unit
 * @group resource
 *
 * @covers \Brain\Cell\EntityResource\Job\JobResource
 */
class JobResourceTest extends TestCase
{
    /**
     * @test
     *
     * @throws ReflectionException
     */
    public function canTransformWeightFromPayload(): void
    {
        $payload = [
            'weight' => [
                'value' => 100,
                'unit' => 'something',
            ],
        ];

        $resource = new JobResource();

        $decoder = new ArrayDecoder();
        $decoder->decode($resource, $payload);

        $weight = $resource->getWeight();

        self::assertEquals(100, $weight->getValue());
        self::assertEquals('something', $weight->getUnit());
    }
}
