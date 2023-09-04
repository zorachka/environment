<?php

declare(strict_types=1);

namespace Zorachka\Environment\Tests\Unit;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Zorachka\Environment\EnvironmentName;
use Zorachka\Environment\EnvironmentValues;

/**
 * @internal
 */
final class EnvironmentValuesTest extends TestCase
{
    /**
     * @test
     */
    public function shouldReturnCorrectValues(): void
    {
        putenv("KEY=value");

        $environment = new EnvironmentValues(
            name: EnvironmentName::DEVELOPMENT,
        );

        Assert::assertEquals('value', $environment->get('KEY'));
        Assert::assertEquals('default', $environment->get('KEY_NOT_EXISTS_WITH_DEFAULT', 'default'));
    }

    /**
     * @test
     */
    public function shouldReadValueFromFileAndTrimContent(): void
    {
        $filePath = implode(DIRECTORY_SEPARATOR, [dirname(__FILE__), '..', 'Datasets', 'db_password']);
        putenv("DB_PASSWORD_FILE=" . $filePath);

        $environment = new EnvironmentValues(
            name: EnvironmentName::DEVELOPMENT,
        );

        Assert::assertEquals('secret', $environment->get('DB_PASSWORD'));
    }

    /**
     * @test
     */
    public function shouldThrowExceptionIfValueDoesntExists(): void
    {
        $environment = new EnvironmentValues(
            name: EnvironmentName::DEVELOPMENT,
        );

        $this->expectException(RuntimeException::class);
        /* @phpstan-ignore-next-line */
        Assert::assertNull($environment->get('KEY_NOT_EXISTS'));
    }

    /**
     * @test
     */
    public function shouldMapValues(): void
    {
        putenv("BOOLEAN_TRUE=true");
        putenv("BOOLEAN_(TRUE)=(true)");
        putenv("BOOLEAN_FALSE=false");
        putenv("BOOLEAN_(FALSE)=(false)");
        putenv("EMPTY=");

        $environment = new EnvironmentValues(
            name: EnvironmentName::DEVELOPMENT,
        );

        Assert::assertTrue($environment->get('BOOLEAN_TRUE'));
        Assert::assertTrue($environment->get('BOOLEAN_(TRUE)'));
        Assert::assertFalse($environment->get('BOOLEAN_FALSE'));
        Assert::assertFalse($environment->get('BOOLEAN_(FALSE)'));
        Assert::assertEmpty($environment->get('EMPTY'));
    }

    /**
     * @test
     */
    public function shouldHaveANameWithValue(): void
    {
        $environment = new EnvironmentValues(
            name: EnvironmentName::DEVELOPMENT,
        );

        Assert::assertEquals('dev', $environment->name()->value);
    }

    /**
     * @test
     */
    public function shouldHaveAGivenName(): void
    {
        $environment = new EnvironmentValues(
            name: EnvironmentName::DEVELOPMENT,
        );

        Assert::assertTrue($environment->isA(EnvironmentName::DEVELOPMENT));
    }
}
