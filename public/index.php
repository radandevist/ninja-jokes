<?php

try {
    include_once __DIR__.'/../includes/databaseConnection.php';
    // include_once __DIR__.'/../functions/databaseFunctions.php';
    include_once __DIR__.'/../ninja-framework/DatabaseTable.php';

    $jokesTable = new DatabaseTable($pdo, 'joke', 'id');

    $totaljoke = $jokesTable->totalCount();

    $title = 'home';

    ob_start();
    include_once __DIR__.'/../views/contents/home.html.php';
    $content = ob_get_clean();

} catch (\Throwable $th) {
    $title = 'Error';

    $content = 'An error has occured: '.$th->getMessage().' in '.$th->getfile().' at line '.$th->getLine();
}

include_once __DIR__.'/../views/layouts/main.html.php';