<?php
namespace NinjaFramework;

class EntryPoint
{
    private $route;
    private $routes;

    public function __construct($route, $routes)
    {
        $this->route = $route;
        $this->routes = $routes;
        $this->checkURL();
    }

    private function checkURL()
    {
        if($this->route !== strtolower($this->route)){
            http_response_code(301);
            header('location: '.strtolower($this->route));
        }
    }

    private function loadTemplate($contentFileName, $variables = [])
    {
        extract($variables);

        ob_start();
        include_once __DIR__.'/../../views/contents/'.$contentFileName;
        return ob_get_clean();
    }

    // moved callAction()

    public function run()
    {
        $page = $this->routes->callAction($this->route);

        $title = $page['title'];

        if (isset($page['variables'])){
            $content = $this->loadTemplate($page['content'], $page['variables']);
        } else {
            $content = $this->loadTemplate(($page['content']));
        }

        include_once __DIR__.'/../../views/layouts/main.html.php';
    }
}