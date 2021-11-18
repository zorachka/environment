<?php

declare(strict_types=1);

namespace Zorachka\Framework\Environment;

interface Environment
{
    /**
     * Get environment value.
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function get(string $name, $default = null): mixed;

    /**
     * Return environment name.
     * @return string
     */
    public function name(): string;
}
