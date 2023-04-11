<?php

declare(strict_types=1);

namespace Zorachka\Environment;

enum EnvironmentName: string
{
    case PRODUCTION = 'production';
    case DEVELOPMENT = 'development';
    case TEST = 'test';
}
