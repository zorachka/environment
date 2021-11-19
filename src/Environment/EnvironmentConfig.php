<?php

declare(strict_types=1);

namespace Zorachka\Framework\Environment;

use Webmozart\Assert\Assert;

final class EnvironmentConfig
{
    private array $requiredFields;

    private function __construct(array $requiredFields)
    {
        $this->requiredFields = $requiredFields;
    }

    public static function withDefaults(array $requiredFields = [])
    {
        return new self($requiredFields);
    }

    public function withRequiredField(string $key): self
    {
        Assert::notEmpty($key);

        $new = clone $this;
        $new->requiredFields[] = $key;

        return $new;
    }

    public function requiredFields(): array
    {
        return $this->requiredFields;
    }
}
