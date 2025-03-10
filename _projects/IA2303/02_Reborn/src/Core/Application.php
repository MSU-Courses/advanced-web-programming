<?php

namespace Core;

class Application {
    /**
     * Application entry point
     */
    public function run() {
        // Load configuration
        Config::loadConfig();

    }
}