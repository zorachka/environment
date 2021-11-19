<?php

declare(strict_types=1);

namespace Zorachka\Framework\Environment;

interface Environment
{
    /**
     * Return environment name.
     * @return string
     */
    public function name(): string;

    /**
     * Get environment variable value.
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function get(string $name, mixed $default = null): mixed;
}
