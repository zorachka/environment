<?php

declare(strict_types=1);

namespace Zorachka\Environment;

final class CurrentEnvironment
{
    public function __construct(
        private readonly EnvironmentName $name,
    ) {
    }

    public function isA(EnvironmentName $environmentName): bool
    {
        return $this->name->value === $environmentName->value;
    }
}
