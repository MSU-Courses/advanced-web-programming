<?php

namespace App\Core\Templater;

use App\Core\Config;

class Template
{
    public static function render(string $template, array $data = [])
    {
        ob_start();
        extract($data);
        require Config::templateDir . "/pages/$template.php";
        $content = ob_get_clean();
        require Config::templateDir . "/layouts/default.layout.php";
    }
}
