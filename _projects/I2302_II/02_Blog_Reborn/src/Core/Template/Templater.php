<?php

class Templater
{
    public function render(string $template, array $args = [])
    {
        // e.g. $template = 'index'
        // e.g. $args = ['title' => 'My Blog']
        extract($args);
        // e.g. $title = 'My Blog'
        require_once "../templates/pages/$template.php";
        return;
    }
}
