<?php

declare(strict_types=1);

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Zorachka\Environment\EnvironmentValues;

/**
 * @internal
 */
final class EnvironmentValuesTest extends TestCase
{
    /**
     * @test
     */
    public function throwsExceptionIfEnvironmentNameIsEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new EnvironmentValues(
            name: '',
        );
    }

    /**
     * @test
     */
    public function shouldReturnCorrectValues(): void
    {
        putenv("KEY=value");

        $environment = new EnvironmentValues(
            name: 'dev',
        );

        Assert::assertEquals('value', $environment->get('KEY'));
        Assert::assertEquals('default', $environment->get('KEY_NOT_EXISTS_WITH_DEFAULT', 'default'));
    }

    /**
     * @test
     */
    public function shouldReadValueFromFileAndTrimContent(): void
    {
        $filePath = implode(DIRECTORY_SEPARATOR, [dirname(__FILE__), 'db_password']);
        putenv("DB_PASSWORD_FILE=" . $filePath);

        $environment = new EnvironmentValues(
            name: 'dev',
        );

        Assert::assertEquals('secret', $environment->get('DB_PASSWORD'));
    }

    /**
     * @test
     */
    public function shouldThrowExceptionIfValueDoesntExists(): void
    {
        $environment = new EnvironmentValues(
            name: 'dev',
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
            name: 'dev',
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
    public function shouldHaveAName(): void
    {
        $environment = new EnvironmentValues(
            name: 'dev',
        );

        Assert::assertEquals('dev', $environment->name());
    }
}
