<?php

declare(strict_types=1);

namespace Zorachka\Environment;

interface Environment
{
    /**
     * Return environment name.
     */
    public function name(): string;

    /**
     * Get environment variable value.
     * @param bool|int|string $default
     */
    public function get(string $name, bool|int|null|string $default = null): bool|int|string;
}
