<?php

declare(strict_types=1);

use Zorachka\Framework\Environment\Environment;
use Zorachka\Framework\Environment\EnvironmentConfig;
use Zorachka\Framework\Environment\EnvironmentServiceProvider;

test('EnvironmentServiceProvider should contain definitions', function () {
    expect(
        array_keys(EnvironmentServiceProvider::getDefinitions())
    )->toMatchArray([
        Environment::class,
        EnvironmentConfig::class,
    ]);
});
