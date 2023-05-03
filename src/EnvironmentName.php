<?php

declare(strict_types=1);

namespace Zorachka\Environment;

enum EnvironmentName: string
{
    case PRODUCTION = 'prod';
    case DEVELOPMENT = 'dev';
    case TEST = 'test';
}
