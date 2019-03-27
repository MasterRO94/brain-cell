<?php

declare(strict_types=1);

namespace Brain\Cell\Tests\Unit\Exception\Request;

use Brain\Cell\Exception\Request\PayloadViolationException;

use PHPUnit\Framework\TestCase;

/**
 * {@inheritdoc}
 */
class PayloadViolationExceptionTest extends TestCase
{
    /**
     * @test
     *
     * @group unit
     * @group exception
     *
     * @covers \Brain\Cell\Exception\Request\PayloadViolationException
     */
    public function noViolationsEmptyArray(): void
    {
        $payload = [
            'error' => [],
        ];

        $exception = new PayloadViolationException('message', [], $payload);

        self::assertEquals([], $exception->getViolations());
    }

    /**
     * @test
     *
     * @group unit
     * @group exception
     *
     * @covers \Brain\Cell\Exception\Request\PayloadViolationException
     */
    public function withViolationsCorrectArray(): void
    {
        $payload = [
            'error' => [],
            'violations' => [
                'foo' => 'bar',
            ],
        ];

        $exception = new PayloadViolationException('message', [], $payload);

        $expected = [
            'foo' => 'bar',
        ];

        self::assertEquals($expected, $exception->getViolations());
    }
}
