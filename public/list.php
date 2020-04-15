<?php

try {
    include_once __DIR__.'/../includes/databaseConnection.php';
    // include_once __DIR__.'/../functions/databaseFunctions.php';
    include_once __DIR__.'/../ninja-framework/DatabaseTable.php';

    $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
    $authorsTable = new DatabaseTable($pdo, 'author', 'id');

    $result = $jokesTable->getAll();
    // print_r($result);

    $jokes = [];
    foreach ($result as $joke) {
        $author = $authorsTable->getById($joke['authorid']);
        $jokes[] = [
            'id' => $joke['id'],
            'joketext' => $joke['joketext'],
            'jokedate' => $joke['jokedate'],
            'name' => $author['name'],
            'email' => $author['email']
        ];
    }

    // print_r($jokes);

    $title = 'listJokes';

    ob_start();
    include_once __DIR__.'/../views/contents/list.html.php';
    $content = ob_get_clean();

} catch (\Throwable $th) {
    $title = 'Error';

    $content = 'An error has occured: '.$th->getMessage().' in '.$th->getfile().' at line '.$th->getLine();
}

include_once __DIR__.'/../views/layouts/main.html.php';