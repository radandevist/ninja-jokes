<?php

function loadTemplate($contentFileName, $variables = [])
{
    extract($variables);

    ob_start();
    include_once __DIR__.'/../views/contents/'.$contentFileName;
    $content = ob_get_clean();
}

try {
    include_once __DIR__.'/../includes/databaseConnection.php';
    // include_once __DIR__.'/../functions/databaseFunctions.php';
    include_once __DIR__.'/../classes/DatabaseTable.php';
    include_once __DIR__.'/../controllers/JokeController.php';

    $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
    $authorsTable = new DatabaseTable($pdo, 'author', 'id');

    $jokeController = new JokeController($jokesTable, $authorsTable);

    $action = $_GET['action'] ?? 'home';
    $page = $jokeController->$action();

    $title = $page['title'];

    if (isset($pages['variables'])){
        loadTemplate($page['content'], $page['variables']);
    } else {
        loadTemplate(($page['content']));
    }

} catch (\Throwable $th) {
    $title = 'Error';

    $content = 'An error has occured: '.$th->getMessage().' in '.$th->getfile().' at line '.$th->getLine();
}

include_once __DIR__.'/../views/layouts/main.html.php';