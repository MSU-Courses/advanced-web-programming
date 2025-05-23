<?php

namespace App\Core;

class Config
{
    /**
     * @var string directory separator
     */
    public const sep = DIRECTORY_SEPARATOR;

    /**
     * @var string root directory path
     */
    public const rootDir = __DIR__ . self::sep . '..' . self::sep . '..' . self::sep;

    /**
     * @var string public directory path
     */
    public const publicDir = self::rootDir . 'public' . self::sep;

    /**
     * @var string route directory path
     */
    public const routeDir = self::rootDir . 'routes' . self::sep;
}
