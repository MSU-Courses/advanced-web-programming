<?php

class Templater
{
    protected $templatePath;
    protected $publicPath;

    public function __construct(string $templatePath, string $publicPath)
    {
        $this->templatePath = $templatePath;
        $this->publicPath = $publicPath;
    }

    public function getStyles()
    {
        // todo: make config
        $styles = scandir($this->publicPath . '/assets/styles');

        $styles = array_filter($styles, function (string $style) {
            return strpos($style, '.css') !== false;
        });

        return $styles;
    }

    public function renderStyles()
    {
        $styles = $this->getStyles();

        $html = "";

        foreach ($styles as $style) {
            $html .= "<link rel='stylesheet' href='/assets/styles/{$style}'>";
        }

        return $html;
    }

    public function render(string $template, array $args = [])
    {
        $this->renderWithLayout($template, $args);
        return;
    }

    public function renderPage(string $template, array $args = [])
    {
        $this->renderWithLayout("/pages" . $template, $args);
        return;
    }

    public function renderWithLayout(string $template,  array $args = [], string $layout = 'layout')
    {
        $content = $this->getContent($template, $args);
        require_once $this->templatePath . "/{$layout}.php";
        return;
    }

    public function getContent(string $template, array $args = [])
    {
        extract($args);
        ob_start();
        require_once $this->templatePath . "/{$template}.php";
        return ob_get_clean();
    }
}
