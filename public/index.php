<?php

function loadTemplate($contentFileName, $variables = [])
{
    extract($variables);

    ob_start();
    include_once __DIR__.'/../views/contents/'.$contentFileName;
    return ob_get_clean();
}

try {
    include_once __DIR__.'/../includes/databaseConnection.php';
    // include_once __DIR__.'/../functions/databaseFunctions.php';
    include_once __DIR__.'/../classes/DatabaseTable.php';
    // include_once __DIR__.'/../controllers/JokeController.php';

    $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
    $authorsTable = new DatabaseTable($pdo, 'author', 'id');

    // $jokeController = new JokeController($jokesTable, $authorsTable);

    // $action = $_GET['action'] ?? 'home';
    $route = $_GET['r'] ?? 'joke/home';

    // if ($action == strtolower($action))
    // {
    //     $page = $jokeController->$action();
    // } else {
    //     http_response_code(301);
    //     header('location: index.php?action='.strtolower($action));
    // }
    if ($route == strtolower($route)) {
        if ($route === 'joke/list') {
            include __DIR__ .'/../classes/controllers/JokeController.php';
            $controller = new JokeController($jokesTable, $authorsTable);
            $page = $controller->list();
        } elseif ($route === 'joke/home') {
            include __DIR__ .'/../classes/controllers/JokeController.php';
            $controller = new JokeController($jokesTable,$authorsTable);
            $page = $controller->home();
        } elseif ($route === 'joke/edit') {
            include __DIR__ .'/../classes/controllers/JokeController.php';
            $controller = new JokeController($jokesTable,$authorsTable);
            $page = $controller->edit();
        } elseif ($route === 'joke/delete') {
            include __DIR__ .'/../classes/controllers/JokeController.php';
            $controller = new JokeController($jokesTable,$authorsTable);
            $page = $controller->delete();
        } elseif ($route === 'register') {
            include __DIR__ .'/../classes/controllers/RegisterController.php';
            $controller = new RegisterController($authorsTable);
            $page = $controller->showForm();
        }
    } else {
        http_response_code(301);
        header('location: index.php?route=' . strtolower($route));
    }

    $title = $page['title'];

    if (isset($page['variables'])){
        $content = loadTemplate($page['content'], $page['variables']);
    } else {
        $content = loadTemplate(($page['content']));
    }

} catch (\Throwable $th) {
    $title = 'Error';

    $content = 'An error has occured: '.$th->getMessage().' in '.$th->getfile().' at line '.$th->getLine();
}

include_once __DIR__.'/../views/layouts/main.html.php';