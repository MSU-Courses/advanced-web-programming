<?php

namespace Core;

/**
 * Configuration class
 * 
 * This class is responsible for loading all configuration files
 * and providing an easy way to access configuration values.
 */
class Config
{
    /**
     * Directory separator
     * 
     * @var string
     */
    private const sep = DIRECTORY_SEPARATOR;

    /**
     * Root directory
     * 
     * @var string
     */
    private const rootDir = __DIR__ . self::sep . '..' . self::sep . '..';

    /**
     * Configuration directory
     */
    private const configDir = self::rootDir . self::sep .  'config';

    /**
     * All configuration values
     * 
     * @var array
     */
    protected static array $config = [];

    /**
     * Load all configuration files
     */
    public static function load()
    {
        $configFiles = scandir(__DIR__ . '/../../config');

        foreach ($configFiles as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            $key = pathinfo($file, PATHINFO_FILENAME);

            static::$config[$key] = require_once self::configDir . self::sep . $file;
        }
    }

    /**
     * Get a configuration value
     * 
     * e.g. app.name
     */
    public static function  get(string $key)
    {
        $keys = explode('.', $key);

        $config = self::$config;

        foreach ($keys as $key) {
            $config = $config[$key];
        }

        return $config;
    }
}
