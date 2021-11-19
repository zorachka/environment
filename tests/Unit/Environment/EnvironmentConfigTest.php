<?php

declare(strict_types=1);

use Zorachka\Framework\Environment\EnvironmentConfig;

test('EnvironmentConfig should be able to be created with defaults', function () {
    $defaultConfig = EnvironmentConfig::withDefaults();
    $requiredFields = $defaultConfig->requiredFields();

    expect($requiredFields)->toBeArray();
    expect($requiredFields)->toBeEmpty();
});

test('EnvironmentConfig throws exception when with required field key is empty', function () {
    $defaultConfig = EnvironmentConfig::withDefaults();

    $newConfig = $defaultConfig->withRequiredField('');
})->throws(InvalidArgumentException::class);

test('EnvironmentConfig should be able to add required field', function () {
    $defaultConfig = EnvironmentConfig::withDefaults();

    $newConfig = $defaultConfig->withRequiredField('ENV_NAME');
    expect($newConfig->requiredFields())->toMatchArray([
        'ENV_NAME'
    ]);

    $newConfig = $newConfig->withRequiredField('ANOTHER_VARIABLE');
    expect($newConfig->requiredFields())->toMatchArray([
        'ENV_NAME',
        'ANOTHER_VARIABLE',
    ]);
});
