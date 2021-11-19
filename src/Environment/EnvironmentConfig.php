<?php

declare(strict_types=1);

namespace Zorachka\Framework\Environment;

use Webmozart\Assert\Assert;

final class EnvironmentConfig
{
    private function __construct(
        private string $environmentName,
        private array $requiredFields,
    ) {}

    public static function withDefaults(
        string $environmentName = EnvironmentName::PRODUCTION,
        array $requiredFields = [],
    ) {
        Assert::notEmpty($environmentName);

        return new self($environmentName, $requiredFields);
    }

    public function withRequiredField(string $name): self
    {
        Assert::notEmpty($name);

        $new = clone $this;
        $new->requiredFields[] = $name;

        return $new;
    }

    public function requiredFields(): ?array
    {
        return $this->requiredFields;
    }

    public function withEnvironmentName(string $environmentName): self
    {
        Assert::notEmpty($environmentName);

        $new = clone $this;
        $new->environmentName = $environmentName;

        return $new;
    }

    /**
     * @return string
     */
    public function environmentName(): string
    {
        return $this->environmentName;
    }
}
