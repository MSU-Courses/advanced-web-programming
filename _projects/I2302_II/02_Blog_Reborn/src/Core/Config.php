<?php

namespace App\Core;

class Config
{
    /**
     * Directory separator
     */
    public const sep = DIRECTORY_SEPARATOR;

    /**
     * Path to the root directory
     */
    public const rootDir = __DIR__ . self::sep . ".." . self::sep . ".." . self::sep;

    /**
     * Path to the public directory
     */
    public const publicDir = self::rootDir . "public" . self::sep;
}
