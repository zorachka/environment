<?php

declare(strict_types=1);

namespace Zorachka\Environment\Tests\Unit;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Zorachka\Environment\CurrentEnvironment;
use Zorachka\Environment\EnvironmentName;

/**
 * @internal
 */
final class CurrentEnvironmentTest extends TestCase
{
    /**
     * @test
     */
    public function shouldHaveAGivenName(): void
    {
        $environment = new CurrentEnvironment(
            name: EnvironmentName::DEVELOPMENT,
        );

        Assert::assertTrue($environment->isA(EnvironmentName::DEVELOPMENT));
    }
}
