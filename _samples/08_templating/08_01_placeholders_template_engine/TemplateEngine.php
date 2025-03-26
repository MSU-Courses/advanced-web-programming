<?php

/**
 * Class TemplateEngine
 * 
 * A simple template engine that replaces placeholders in templates with provided variables.
 */
class TemplateEngine
{
    /**
     * @var string $templateDir The directory where templates are stored.
     */
    private $templateDir;

    /**
     * @var array $modifiers The prefix and suffix used to identify placeholders in templates.
     */
    private const modifiers = [
        'prefix' => '{{',
        'suffix' => '}}',
    ];

    /**
     * TemplateEngine constructor.
     * 
     * @param string $templateDir The directory where templates are stored.
     */
    public function __construct(string $templateDir)
    {
        $this->templateDir = $templateDir;
    }

    /**
     * Renders a template with the provided variables.
     * 
     * @param string $templatePath The path to the template file, relative to the template directory.
     * @param array $vars An associative array of variables to replace in the template.
     * 
     * @return string The rendered template with placeholders replaced by the provided variables.
     */
    public function render(string $templatePath, array $vars = [], string $layout = 'layout.tpl')
    {
        $template = $this->loadTemplate($templatePath);
        $layout = $this->loadTemplate($layout);

        $output = $this->replacePlaceholders($template, $vars);
        $output = $this->replacePlaceholders($layout, ['content' => $output]);

        return $output;
    }

    /**
     * Loads a template file from the template directory.
     * 
     * @param string $templatePath The path to the template file, relative to the template directory.
     * 
     * @return string The contents of the template file.
     */
    private function loadTemplate(string $templatePath)
    {
        $templateFile = $this->templateDir . DIRECTORY_SEPARATOR . $templatePath;
        if (!file_exists($templateFile)) {
            throw new Exception("Template file not found: $templateFile");
        }

        return file_get_contents($templateFile);
    }

    /**
     * Replaces placeholders in a template with the provided variables.
     * 
     * @param string $template The template content with placeholders.
     * @param array $vars An associative array of variables to replace in the template.
     * 
     * @return string The template content with placeholders replaced by the provided variables.
     */
    private function replacePlaceholders(string $template, array $vars)
    {
        $prefix = self::modifiers['prefix'];
        $suffix = self::modifiers['suffix'];

        foreach ($vars as $key => $value) {
            $placeholder = $prefix . $key . $suffix;
            $template = str_replace($placeholder, $value, $template);
        }

        return $template;
    }
}
