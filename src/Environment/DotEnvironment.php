<?php

declare(strict_types=1);

namespace Zorachka\Framework\Environment;

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
    private array $values = [];

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

    /**
     * @param mixed $value
     * @return mixed
     */
    private function normalize(mixed $value): mixed
    {
        $alias = mb_strtolower($value);
        if (isset(self::VALUE_MAP[$alias])) {
            return self::VALUE_MAP[$alias];
        }

        return $value;
    }

    /**
     * @inheritDoc
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function get(string $name, mixed $default = null): mixed
    {
        if (isset($this->values[$name])) {
            return $this->values[$name];
        }

        return $default;
    }
}
