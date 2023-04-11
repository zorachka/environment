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
     * @param mixed $default
     */
    public function get(string $name, mixed $default = null): mixed;
}
