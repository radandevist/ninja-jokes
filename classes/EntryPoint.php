<?php

class EntryPoint
{
    private $route;

    public function __construct($route)
    {
        $this->route = $route;
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
        include_once __DIR__.'/../views/contents/'.$contentFileName;
        return ob_get_clean();
    }

    private function callAction()
    {
        include_once __DIR__.'/../includes/databaseConnection.php';
        include_once __DIR__.'/../classes/DatabaseTable.php';

        $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
        $authorsTable = new DatabaseTable($pdo, 'author', 'id');

        if ($this->route === 'joke/list') {
            include_once __DIR__ .'/../classes/controllers/JokeController.php';
            $controller = new JokeController($jokesTable, $authorsTable);
            $page = $controller->list();
        } elseif ($this->route === 'joke/home' || $this->route === '') {
            include_once __DIR__ .'/../classes/controllers/JokeController.php';
            $controller = new JokeController($jokesTable,$authorsTable);
            $page = $controller->home();
        } elseif ($this->route === 'joke/edit') {
            include_once __DIR__ .'/../classes/controllers/JokeController.php';
            $controller = new JokeController($jokesTable,$authorsTable);
            $page = $controller->edit();
        } elseif ($this->route === 'joke/delete') {
            include_once __DIR__ .'/../classes/controllers/JokeController.php';
            $controller = new JokeController($jokesTable,$authorsTable);
            $page = $controller->delete();
        } elseif ($this->route === 'register') {
            include_once __DIR__ .'/../classes/controllers/RegisterController.php';
            $controller = new RegisterController($authorsTable);
            $page = $controller->showForm();
        }

        return $page;
    }

    public function run()
    {
        $page = $this->callAction();

        $title = $page['title'];

        if (isset($page['variables'])){
            $content = $this->loadTemplate($page['content'], $page['variables']);
        } else {
            $content = $this->loadTemplate(($page['content']));
        }

        include_once __DIR__.'/../views/layouts/main.html.php';
    }
}