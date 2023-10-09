<?php

declare(strict_types=1);

namespace Zorachka\Environment;

use RuntimeException;

use function file_exists;
use function mb_strtolower;
use function trim;

final class EnvironmentValuesUsingGetenv implements Environment
{
    private const VALUE_MAP = [
        'true' => true,
        '(true)' => true,
        'false' => false,
        '(false)' => false,
        'empty' => '',
    ];

    private function normalize(bool|int|string $value): bool|int|string
    {
        $alias = mb_strtolower((string)$value);
        if (isset(self::VALUE_MAP[$alias])) {
            return self::VALUE_MAP[$alias];
        }

        return $value;
    }

    public function get(string $name, bool|int|null|string $default = null): bool|int|string
    {
        $value = getenv($name);

        if ($value !== false) {
            return $this->normalize($value);
        }

        $filePath = getenv($name . '_FILE');

        if ($filePath !== false) {
            $fileExists = file_exists($filePath);
            $fileContent = file_get_contents($filePath);

            if ($fileExists && $fileContent && $trimmedContent = trim($fileContent)) {
                return $trimmedContent;
            }
        }

        if ($default !== null) {
            return $default;
        }

        throw new RuntimeException('Undefined env ' . $name);
    }
}
