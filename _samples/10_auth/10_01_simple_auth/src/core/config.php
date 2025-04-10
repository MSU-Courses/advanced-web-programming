<?php

/**
 * Loads configuration files from a specified directory and returns an associative array
 * where the keys are the file names (without the `.php` extension) and the values are
 * the contents of the included files.
 *
 * @param string $configDir The directory containing the configuration files.
 *                          The path will be normalized to include a trailing slash.
 *
 * @return array An associative array of configuration data, where each key corresponds
 *               to a configuration file name and its value is the content of the file.
 */
function loadConfig(string $configDir)
{
    // Normalize the config directory path to ensure it ends with a slash
    $configDir = rtrim($configDir, '/\\') . '/';

    // Find all PHP files in the directory using a glob pattern
    $configFiles = glob($configDir . '*.php');

    // Initialize the configuration array
    $config = [];

    // Loop through each found config file
    foreach ($configFiles as $file) {
        // Extract the filename without the extension to use as a config key
        $fileName = basename($file, '.php');

        // Load the config file and assign its returned array to the config array under the corresponding key
        $config[$fileName] = require_once $file;
    }

    // Return the fully assembled configuration array
    return $config;
}

/**
 * Retrieves a configuration value based on a dot-notated key.
 *
 * This function loads the configuration data once and caches it for subsequent calls.
 * The configuration data is expected to be an associative array loaded from a specified directory.
 * The key is a string that uses dot notation to access nested configuration values.
 *
 * @param string $key The dot-notated key to retrieve the configuration value (e.g., 'database.host').
 * 
 * @return mixed The configuration value corresponding to the provided key, or null if the key does not exist.
 */
function config(string $key = "")
{
    // Declare a static variable to cache the configuration array across function calls
    static $config = null;

    // Load the configuration only once, the first time the function is called
    if ($config === null) {
        $config = loadConfig(__DIR__ . '/../../config/');
    }

    // Split the key by '.' to support nested access like 'database.connections.mysql'
    $key = explode('.', $key);

    // Start with the full configuration array
    $value = $config;


    // Traverse the configuration array using each part of the key
    foreach ($key as $part) {
        // If the current part exists in the current level of the array
        if (isset($value[$part])) {
            // Move down to the next level of the array
            $value = $value[$part];
            continue;
        } 
        return null; // If the part does not exist, return null
    }


    // Return the final resolved value
    return $value;
}
