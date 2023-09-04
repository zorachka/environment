<?php

declare(strict_types=1);

namespace Zorachka\Environment;

use Psr\Container\ContainerInterface;
use RuntimeException;
use Zorachka\Container\ServiceProvider;

final class EnvironmentServiceProvider implements ServiceProvider
{
    public static function getDefinitions(): array
    {
        return [
            Environment::class => static function (ContainerInterface $container) {
                /** @var EnvironmentConfig $config */
                $config = $container->get(EnvironmentConfig::class);

                $environment = new EnvironmentValues(
                    $config->environmentName(),
                );

                if ($config->requiredFields()) {
                    $requiredFields = [];
                    foreach ($config->requiredFields() as $requiredField) {
                        $isExists = $environment->get($requiredField);

                        if (!$isExists) {
                            $requiredFields[] = $requiredField;
                        }
                    }

                    if (!empty($requiredFields)) {
                        $fieldsToDefined = \implode(', ', $requiredFields);

                        throw new RuntimeException('These fields must be defined: ' . $fieldsToDefined);
                    }
                }

                return $environment;
            },
            EnvironmentConfig::class => static fn () => EnvironmentConfig::withDefaults(),
        ];
    }

    public static function getExtensions(): array
    {
        return [];
    }
}
