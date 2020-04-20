<?php
namespace NinjaFramework;

class EntryPoint
{
    private $route;
    private $method;
    private $routes;

    public function __construct(string $route, string $method, \NinjaFramework\Routes $routes)
    {
        $this->route = $route;
        $this->method = $method;
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
        $routes = $this->routes->getRoutes();

        $controller = $routes[$this->route][$this->method]['controller'];
        $action = $routes[$this->route][$this->method]['action'];

        $page = $controller->$action();

        $title = $page['title'];

        if (isset($page['variables'])){
            $content = $this->loadTemplate($page['content'], $page['variables']);
        } else {
            $content = $this->loadTemplate(($page['content']));
        }

        include_once __DIR__.'/../../views/layouts/main.html.php';
    }
}