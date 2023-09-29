<?php

declare(strict_types=1);

namespace Zorachka\Environment\Tests\Unit;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Zorachka\Environment\CurrentEnvironment;
use Zorachka\Environment\Environment;
use Zorachka\Environment\EnvironmentConfig;
use Zorachka\Environment\EnvironmentServiceProvider;

/**
 * @internal
 */
final class EnvironmentServiceProviderTest extends TestCase
{
    /**
     * @test
     */
    public function shouldContainDefinitions(): void
    {
        Assert::assertEquals([
            Environment::class,
            CurrentEnvironment::class,
            EnvironmentConfig::class,
        ], array_keys(EnvironmentServiceProvider::getDefinitions()));
    }
}
