<?php

declare(strict_types=1);

namespace Zorachka\Framework\Environment;

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

    public function withRequiredFields(array $requiredFields)
    {
        $new = clone $this;
        $new->requiredFields = $requiredFields;

        return $new;
    }

    public function requiredFields(): array
    {
        return $this->requiredFields;
    }
}
