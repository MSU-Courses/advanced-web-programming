<?php
class TemplateEngine
{
    private string $templatesDir;
    private string $layout;

    public function __construct(string $templatesDir, string $layout = "")
    {
        $this->templatesDir = rtrim($templatesDir, '/\\') . DIRECTORY_SEPARATOR;
    }

    /**
     * Renders a partial template file with the given variables.
     *
     * @param string $templateFile The name of the template file to render.
     * @param array $vars An associative array of variables to be extracted and used within the template.
     * @return string The rendered template content.
     * @throws Exception If the template file does not exist.
     */
    public function renderPartial(string $templateFile, array $vars = []): string
    {
        $fullPath = $this->templatesDir . $templateFile;
        if (!file_exists($fullPath)) {
            throw new Exception("Файл шаблона $fullPath не найден");
        }
        extract($vars);
        ob_start();
        include $fullPath;
        return ob_get_clean();
    }


    /**
     * Renders a template file with the given variables.
     *
     * This method processes the specified template file, replacing placeholders
     * with the provided variables. If a layout is set, it will render the layout
     * with the content of the template file.
     *
     * @param string $templateFile The path to the template file to be rendered.
     * @param array $vars An associative array of variables to be used within the template.
     * @return string The rendered content of the template file, optionally wrapped in a layout.
     */
    public function render(string $templateFile, array $vars = [], string $layout = "layout.php"): string
    {
        $html = $this->renderPartial($templateFile, $vars);

        $html = $this->renderPartial($layout, [
            'content' => $html,
        ]);

        return $html;
    }
}
