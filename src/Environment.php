<?php

declare(strict_types=1);

namespace Zorachka\Environment;

interface Environment
{
    /**
     * Return environment name.
     */
    public function name(): EnvironmentName;

    /**
     * Get environment variable value.
     * @param bool|int|string|null $default
     */
    public function get(string $name, bool|int|null|string $default = null): bool|int|string|null;

    /**
     * Check if current environment is a given name.
     */
    public function isA(EnvironmentName $environmentName): bool;
}
