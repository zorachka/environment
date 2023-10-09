<?php

declare(strict_types=1);

namespace Zorachka\Environment\Tests\Unit;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Zorachka\Environment\EnvironmentValuesUsingGetenv;

/**
 * @internal
 */
final class EnvironmentValuesUsingEnvTest extends TestCase
{
    /**
     * @test
     */
    public function shouldReturnCorrectValues(): void
    {
        $_ENV['KEY'] = 'value';

        $environment = new EnvironmentValuesUsingGetenv();

        Assert::assertEquals('value', $environment->get('KEY'));
        Assert::assertEquals('default', $environment->get('KEY_NOT_EXISTS_WITH_DEFAULT', 'default'));
    }

    /**
     * @test
     */
    public function shouldReadValueFromFileAndTrimContent(): void
    {
        $filePath = implode(DIRECTORY_SEPARATOR, [dirname(__FILE__), '..', 'Datasets', 'db_password']);
        $_ENV['DB_PASSWORD_FILE'] = $filePath;

        $environment = new EnvironmentValuesUsingGetenv();

        Assert::assertEquals('secret', $environment->get('DB_PASSWORD'));
    }

    /**
     * @test
     */
    public function shouldThrowExceptionIfValueDoesntExists(): void
    {
        $environment = new EnvironmentValuesUsingGetenv();

        $this->expectException(RuntimeException::class);
        /* @phpstan-ignore-next-line */
        Assert::assertNull($environment->get('KEY_NOT_EXISTS'));
    }
}
