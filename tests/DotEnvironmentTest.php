<?php

declare(strict_types=1);

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Zorachka\Environment\DotEnvironment;

/**
 * @internal
 */
final class DotEnvironmentTest extends TestCase
{
    /**
     * @test
     */
    public function throwsExceptionIfEnvironmentNameIsEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new DotEnvironment(
            name: '',
            values: [
                'KEY' => 'value',
            ],
        );
    }

    /**
     * @test
     */
    public function throwsExceptionIfArrayOfValuesIsEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new DotEnvironment(
            name: 'development',
            values: [],
        );
    }

    /**
     * @test
     */
    public function shouldBeCreatedFromArrayOfValues(): void
    {
        $environment = new DotEnvironment(
            name: 'development',
            values: [
                'KEY' => 'value',
            ],
        );

        Assert::assertEquals('value', $environment->get('KEY'));
        Assert::assertNull($environment->get('KEY_NOT_EXISTS'));
        Assert::assertEquals('default', $environment->get('KEY_NOT_EXISTS_WITH_DEFAULT', 'default'));
    }

    /**
     * @test
     */
    public function shouldMapValues(): void
    {
        $environment = new DotEnvironment(
            name: 'development',
            values: [
                'BOOLEAN_TRUE' => 'true',
                'BOOLEAN_TRUE()' => '(true)',
                'BOOLEAN_FALSE' => 'false',
                'BOOLEAN_FALSE()' => '(false)',
                'EMPTY' => 'empty',
            ],
        );

        Assert::assertTrue($environment->get('BOOLEAN_TRUE'));
        Assert::assertTrue($environment->get('BOOLEAN_TRUE()'));
        Assert::assertFalse($environment->get('BOOLEAN_FALSE'));
        Assert::assertFalse($environment->get('BOOLEAN_FALSE()'));
        Assert::assertEmpty($environment->get('EMPTY'));
    }

    /**
     * @test
     */
    public function shouldHaveAName(): void
    {
        $environment = new DotEnvironment(
            name: 'development',
            values: [
                'KEY' => 'value',
            ],
        );

        Assert::assertEquals('development', $environment->name());
    }
}
