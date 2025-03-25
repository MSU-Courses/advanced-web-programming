<?php

namespace App\Core\Templater;

/**
 * Class Templater
 * 
 * This class is responsible for rendering templates and including layouts.
 */
class Templater
{
    /**
     * @var string $templateDirectory The directory where templates are stored.
     */
    protected string $templateDirectory;

    /**
     * Templater constructor.
     * 
     * @param string $templateDirectory The directory where templates are stored.
     */
    public function __construct(string $templateDirectory)
    {
        $this->templateDirectory = $templateDirectory;
    }

    /**
     * Renders a template with the given data.
     * 
     * @param string $template The template file to render.
     * @param array $data The data to pass to the template.
     */
    public function render(string $template, array $data = [])
    {
        $page = $this->includeWithParams($template, $data);
        $this->includeLayout($page);
    }

    /**
     * Renders a page template with the provided data.
     *
     * @param string $template The name of the template file to render, located in the 'pages' directory.
     * @param array $data An associative array of data to be passed to the template. Default is an empty array.
     */
    public function renderPage(string $template, array $data = [])
    {
        $this->render('pages/' . $template, $data);
    }

    /**
     * Renders a component template with the provided data.
     * 
     * @param string $componentName The name of the component file to render, located in the 'components' directory.
     * @param array $data An associative array of data to be passed to the component. Default is an empty array.
     * 
     */
    public function renderComponent(string $componentName, array $data = [])
    {
        echo $this->includeWithParams('components/' . $componentName, $data);
    }

    /**
     * Includes a layout file and passes the content to it.
     * 
     * @param string $content The content to include in the layout.
     * @param string $layout The layout file to include. Defaults to "default".
     * 
     * @throws \Exception If the content is empty.
     */
    public function includeLayout(string $content, string $layout = "default")
    {
        if ($content) {
            require_once $this->templateDirectory . 'layouts/' . $layout . ".layout.php";
            return;
        }

        throw new \Exception("Content is empty");
    }

    /**
     * Includes a template file with the given data and returns the output.
     * 
     * @param string $template The template file to include.
     * @param array $data The data to pass to the template.
     * 
     * @return string The output of the template.
     */
    public function includeWithParams(string $template, array $data = [])
    {
        ob_start();
        extract($data);
        require_once $this->templateDirectory . $template . ".php";
        return ob_get_clean();
    }
}
