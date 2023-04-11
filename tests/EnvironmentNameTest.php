<?php

declare(strict_types=1);

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Zorachka\Environment\EnvironmentName;

/**
 * @internal
 */
final class EnvironmentNameTest extends TestCase
{
    /**
     * @test
     */
    public function shouldContainValues(): void
    {
        Assert::assertIsString(EnvironmentName::PRODUCTION->value);
        Assert::assertNotEmpty(EnvironmentName::PRODUCTION->value);

        Assert::assertIsString(EnvironmentName::DEVELOPMENT->value);
        Assert::assertNotEmpty(EnvironmentName::DEVELOPMENT->value);

        Assert::assertIsString(EnvironmentName::TEST->value);
        Assert::assertNotEmpty(EnvironmentName::TEST->value);
    }
}
