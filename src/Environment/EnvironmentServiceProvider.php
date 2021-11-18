<?php

declare(strict_types=1);

namespace Zorachka\Framework\Environment;

use Dotenv\Dotenv;
use Psr\Container\ContainerInterface;
use Zorachka\Framework\Container\ServiceProvider;
use Zorachka\Framework\Directories\Directories;

final class EnvironmentServiceProvider implements ServiceProvider
{
    /**
     * @inheritDoc
     */
    public static function getDefinitions(): array
    {
        return [
            Environment::class => static function(ContainerInterface $container) {
                /** @var EnvironmentConfig $config */
                $config = $container->get(EnvironmentConfig::class);

                /** @var Directories $directories */
                $directories = $container->get(Directories::class);

                $dotenv = Dotenv::createImmutable(
                    $directories->get(Directories::ROOT)
                );

                $variables = new EnvironmentVariables($dotenv->load());

                $dotenv->required(
                    $config->requiredFields()
                );

                return $variables;
            },
            EnvironmentConfig::class => EnvironmentConfig::withDefaults([
                EnvironmentVariables::ENVIRONMENT_KEY_NAME
            ]),
        ];
    }

    /**
     * @inheritDoc
     */
    public static function getExtensions(): array
    {
        return [];
    }
}
