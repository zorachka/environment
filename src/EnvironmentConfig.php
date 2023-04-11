<?php

declare(strict_types=1);

namespace Zorachka\Environment;

use Webmozart\Assert\Assert;

final class EnvironmentConfig
{
    private function __construct(
        private EnvironmentName $environmentName,
        /**
         * @var array<string>
         */
        private array $requiredFields,
    ) {
    }

    /**
     * @param array<string> $requiredFields
     * @return static
     */
    public static function withDefaults(
        EnvironmentName $environmentName = EnvironmentName::PRODUCTION,
        array $requiredFields = [],
    ): self {
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

    /**
     * @return string[]|null
     */
    public function requiredFields(): ?array
    {
        return $this->requiredFields;
    }

    public function withEnvironmentName(EnvironmentName $environmentName): self
    {
        Assert::notEmpty($environmentName);

        $new = clone $this;
        $new->environmentName = $environmentName;

        return $new;
    }

    public function environmentName(): EnvironmentName
    {
        return $this->environmentName;
    }
}
