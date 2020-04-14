<?php
include_once __DIR__.'/../includes/databaseConnection.php';
include_once __DIR__.'/../functions/databaseFunctions.php';

try {

    delete($pdo, 'joke', 'id', $_POST['id']);

    header('location: /list.php');

    exit;

} catch (\Throwable $th) {
    $content = 'An error has occured: '.$th->getMessage().' in '.$th->getfile().' at line '.$th->getLine();
}

include_once __DIR__.'/../views/main.html.php';