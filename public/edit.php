<?php
include_once __DIR__.'/../includes/databaseConnection.php';
include_once __DIR__.'/../functions/databaseFunctions.php';

try {

    if(isset($_POST['joke']['joketext'])) {

        $default_author_id = 1;

        $records = $_POST['joke'];
        $records['authorid'] = $default_author_id;
        $records['jokedate'] = new DateTime();

        save($pdo, 'joke', $records, 'id');

        header('location: /list.php');

        exit;

    } else {
        $title = 'addJoke';

        if (isset($_GET['id'])) {
            $title = 'editJoke';
            $joke = findById($pdo, 'joke', 'id', $_GET['id']);
        }

        ob_start();
        include_once __DIR__.'/../views/layouts/edit.html.php';
        $content = ob_get_clean();

    }

} catch (\Throwable $th) {
    $title = 'Error';
    $content = 'An error has occured: '.$th->getMessage().' in '.$th->getfile().' at line '.$th->getLine();
}

include_once __DIR__.'/../views/main.html.php';