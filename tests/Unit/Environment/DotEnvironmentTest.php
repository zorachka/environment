<?php

declare(strict_types=1);

use Zorachka\Framework\Environment\DotEnvironment;

test('EnvironmentVariables throws exception if array of values is empty', function () {
    new DotEnvironment(
        name: 'development',
        values: [],
    );
})->throws(InvalidArgumentException::class);

test('EnvironmentVariables should be created from array of values', function () {
    $environment = new DotEnvironment(
        name: 'development',
        values: [
            'KEY' => 'value'
        ],
    );

    expect($environment->get('KEY'))->toBe('value');
    expect($environment->get('KEY_NOT_EXISTS'))->toBeNull();
    expect($environment->get('KEY_NOT_EXISTS_WITH_DEFAULT', 'default'))->toBe('default');
});

test('EnvironmentVariables should map values', function () {
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

    expect($environment->get('BOOLEAN_TRUE'))->toBeTrue();
    expect($environment->get('BOOLEAN_TRUE()'))->toBeTrue();
    expect($environment->get('BOOLEAN_FALSE'))->toBeFalse();
    expect($environment->get('BOOLEAN_FALSE()'))->toBeFalse();
    expect($environment->get('EMPTY'))->toBeEmpty();
});

test('EnvironmentVariables should have a name', function () {
    $environment = new DotEnvironment(
        name: 'development',
        values: [
            'KEY' => 'value'
        ],
    );

    expect($environment->name())->toBe('development');
});
