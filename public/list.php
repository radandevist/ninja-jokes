<?php
include_once __DIR__.'/../includes/databaseConnection.php';
include_once __DIR__.'/../functions/databaseFunctions.php';

try {
    $title = 'listJokes';

    // $jokes = allJokes($pdo);
    $result = findAll($pdo, 'joke');

    $jokes = [];
    foreach ($result as $joke) {
        $author = findById($pdo, 'author', 'id',
        $joke['authorid']);
        $jokes[] = [
            'id' => $joke['id'],
            'joketext' => $joke['joketext'],
            'jokedate' => $joke['jokedate'],
            'name' => $author['name'],
            'email' => $author['email']
        ];
    }

    // print_r($jokes);

    ob_start();
    include_once __DIR__.'/../views/layouts/list.html.php';
    $content = ob_get_clean();

} catch (\Throwable $th) {
    $title = 'Error';

    $content = 'An error has occured: '.$th->getMessage().' in '.$th->getfile().' at line '.$th->getLine();
}

include_once __DIR__.'/../views/main.html.php';