<?php

declare(strict_types=1);

namespace Zorachka\Environment;

interface Environment
{
    /**
     * Get environment variable value.
     */
    public function get(string $name, bool|int|null|string $default = null): bool|int|string|null;
}
