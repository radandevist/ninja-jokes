<?php

try {
//     var_dump($_SERVER);

    include_once __DIR__.'/../includes/autoload.php';

    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
    $method = $_SERVER['REQUEST_METHOD'];
    $jokeRoutes = new \JokesDB\JokesRoutes();
    $entryPoint = new \NinjaFramework\EntryPoint($route, $method, $jokeRoutes);
    $entryPoint->run();

} catch (\Throwable $th) {
    $title = 'Error';

    $content = 'An error has occured: '.$th->getMessage().' in '.$th->getfile().' at line '.$th->getLine();

    include_once __DIR__.'/../views/layouts/main.html.php';
}
