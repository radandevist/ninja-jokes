<?php
include_once __DIR__.'/../includes/databaseConnection.php';
include_once __DIR__.'/../functions/databaseFunctions.php';

try {
    $title = 'home';

    $totaljoke = total($pdo, 'joke');

    ob_start();
    include_once __DIR__.'/../views/layouts/home.html.php';
    $content = ob_get_clean();

} catch (\Throwable $th) {
    $title = 'Error';

    $content = 'An error has occured: '.$th->getMessage().' in '.$th->getfile().' at line '.$th->getLine();
}

include_once __DIR__.'/../views/main.html.php';