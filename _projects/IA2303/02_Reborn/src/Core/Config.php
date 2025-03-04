<?php

namespace Core;

class Config
{
    /**
     * Directory separator
     */
    public const sep = DIRECTORY_SEPARATOR;

    /**
     * Root directory of the project
     */
    public const rootDir = __DIR__ . self::sep  . '..' . self::sep . '..';

    /**
     * Configuration directory
     */
    private const configDir = self::rootDir . self::sep . 'config';

    /**
     * Configuration of the application
     */
    private static $config = [];

    public static function loadConfig()
    {
        $configFiles = scandir(self::configDir);

        foreach ($configFiles as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            $key = pathinfo($file, PATHINFO_FILENAME);

            self::$config[$key] = require_once self::configDir . self::sep . $file;
        }
    }
}
