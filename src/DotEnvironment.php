<?php

declare(strict_types=1);

namespace Zorachka\Environment;

use Webmozart\Assert\Assert;

use function mb_strtolower;

final class DotEnvironment implements Environment
{
    private const VALUE_MAP = [
        'true' => true,
        '(true)' => true,
        'false' => false,
        '(false)' => false,
        'empty' => '',
    ];

    private string $name;
    /**
     * @var array<int|string, bool|int|string|null>
     */
    private array $values = [];

    /**
     * @param array<int|string, bool|int|string|null> $values
     */
    public function __construct(
        string $name,
        array $values,
    ) {
        Assert::notEmpty($name);
        Assert::notEmpty($values);

        $this->name = $name;
        foreach ($values as $key => $value) {
            $this->values[$key] = $this->normalize($value);
        }
    }

    private function normalize(bool|int|null|string $value): bool|int|null|string
    {
        $alias = mb_strtolower((string)$value);
        if (isset(self::VALUE_MAP[$alias])) {
            return self::VALUE_MAP[$alias];
        }

        return $value;
    }

    public function name(): string
    {
        return $this->name;
    }

    /**
     * @param bool|int|string|null $default
     */
    public function get(string $name, bool|int|null|string $default = null): bool|int|null|string
    {
        if (isset($this->values[$name])) {
            return $this->values[$name];
        }

        return $default;
    }
}
