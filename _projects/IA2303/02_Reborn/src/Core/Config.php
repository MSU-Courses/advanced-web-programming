<?php

namespace Core;

/**
 * Class Config
 *
 * This class provides methods to load and retrieve configuration settings for the application.
 * It defines constants for directory separators and paths, and uses a static array to store
 * configuration values loaded from files in the configuration directory.
 *
 * @package Core
 */
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

    /**
     * Loads configuration files from the configuration directory.
     *
     * This method scans the configuration directory for files, excluding the current
     * and parent directory entries ('.' and '..'). For each configuration file found,
     * it extracts the filename (without extension) to use as the configuration key,
     * and then includes the file to load its contents into the configuration array.
     *
     * @return void
     */
    public static function loadConfig()
    {
        $configFiles = array_diff(scandir(self::configDir), ['.', '..']);

        foreach ($configFiles as $file) {
            $key = pathinfo($file, PATHINFO_FILENAME);
            self::$config[$key] = require_once self::configDir . self::sep . $file;
        }
    }


    /**
     * Retrieves a configuration value based on a dot-notated key.
     *
     * This method allows accessing nested configuration values using a dot-separated string.
     * For example, a key of 'database.host' will retrieve the 'host' value from the 'database' array.
     *
     * @param string $key The dot-notated key to retrieve the configuration value for.
     * 
     * @return mixed The configuration value associated with the provided key.
     */
    public static function get(string $key)
    {
        $keys = explode('.', $key);

        $config = self::$config;

        foreach ($keys as $key) {
            $config = $config[$key];
        }

        return $config;
    }
}
