<?php

declare(strict_types=1);

namespace Zorachka\Framework\Environment;

use Dotenv\Dotenv;
use Psr\Container\ContainerInterface;
use Zorachka\Container\ServiceProvider;
use Zorachka\Framework\Directories\Directories;
use Zorachka\Framework\Directories\DirectoryAlias;

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
                    $directories->get(DirectoryAlias::ROOT)
                );

                $environment = new DotEnvironment(
                    $config->environmentName(),
                    $dotenv->load(),
                );

                if (!\empty($config->requiredFields())) {
                    $dotenv->required(
                        $config->requiredFields()
                    );
                }

                return $environment;
            },
            EnvironmentConfig::class => fn() => EnvironmentConfig::withDefaults(),
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
