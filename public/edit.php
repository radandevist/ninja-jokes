<?php

try {
    include_once __DIR__.'/../includes/databaseConnection.php';
    // include_once __DIR__.'/../functions/databaseFunctions.php';
    include_once __DIR__.'/../classes/DatabaseTable.php';

    $jokesTable = new DatabaseTable($pdo, 'joke', 'id');

    if(isset($_POST['joke']['joketext'])) {

        $default_author_id = 3;

        $records = $_POST['joke'];
        $records['authorid'] = $default_author_id;
        $records['jokedate'] = new DateTime();

        $jokesTable->save($records);

        header('location: /list.php');

        exit;

    } else {
        $title = 'addJoke';

        if (isset($_GET['id'])) {
            $title = 'editJoke';
            $joke = $jokesTable->getById($_GET['id']);
        }

        ob_start();
        include_once __DIR__.'/../views/contents/edit.html.php';
        $content = ob_get_clean();

    }

} catch (\Throwable $th) {
    $title = 'Error';
    $content = 'An error has occured: '.$th->getMessage().' in '.$th->getfile().' at line '.$th->getLine();
}

include_once __DIR__.'/../views/layouts/main.html.php';