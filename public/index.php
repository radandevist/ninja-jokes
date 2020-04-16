<?php

try {
    include_once __DIR__.'/../classes/EntryPoint.php';

    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');

    $entryPoint = new EntryPoint($route);
    $entryPoint->run();

} catch (\Throwable $th) {
    $title = 'Error';

    $content = 'An error has occured: '.$th->getMessage().' in '.$th->getfile().' at line '.$th->getLine();

    include_once __DIR__.'/../views/layouts/main.html.php';
}
