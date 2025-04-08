<?php

declare(strict_types=1);

namespace core;

use function file_exists;

/**
 * View Class
 *
 * This class is responsible for rendering views with optional parameters
 * and a specified layout. It ensures the existence of view files before
 * attempting to load them and allows dynamic content injection.
 */
class View
{
    /**
     * Parameters passed to the view.
     *
     * @var array
     */
    private array $params;

    /**
     * Path to the view file.
     *
     * @var string
     */
    private string $path;

    /**
     * Layout file used for rendering views.
     *
     * @var string
     */
    public string $layout;

    /**
     * Initializes the View class with a default layout.
     */
    public function __construct()
    {
        $this->layout = 'layouts/default';
    }

    /**
     * Renders the specified view file with optional parameters.
     *
     * @param string $path   The view file path relative to the views directory.
     * @param array  $params Data to be extracted and used within the view.
     *
     * @return void
     */
    public function render(string $path, array $params = []): void
    {
        $fullPath = "views/$path.php";

        if (!file_exists($fullPath)) {
            die("No such view file: $fullPath");
        }

        $this->params = $params;
        $this->path = $fullPath;
        $this->renderView();
    }

    /**
     * Processes the view rendering, including extracting parameters
     * and requiring the appropriate layout.
     *
     * @return void
     */
    private function renderView(): void
    {
        // Extract parameters as variables
        extract($this->params);
        unset($this->params);

        $viewFile = $this->path;
        $layoutFile = "views/{$this->layout}.php";

        if (!file_exists($layoutFile)) {
            die("No such view layout file: $layoutFile");
        }

        require $layoutFile;
    }
}
