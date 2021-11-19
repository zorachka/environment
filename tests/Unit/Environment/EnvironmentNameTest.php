<?php

declare(strict_types=1);

use Zorachka\Framework\Environment\EnvironmentName;

test('EnvironmentName should contain values', function () {
    expect(EnvironmentName::PRODUCTION)->toBeString();
    expect(EnvironmentName::PRODUCTION)->not()->toBeEmpty();

    expect(EnvironmentName::DEVELOPMENT)->toBeString();
    expect(EnvironmentName::DEVELOPMENT)->not()->toBeEmpty();

    expect(EnvironmentName::TEST)->toBeString();
    expect(EnvironmentName::TEST)->not()->toBeEmpty();
});
