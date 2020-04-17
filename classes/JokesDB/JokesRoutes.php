<?php
namespace JokesDB;

use \NinjaFramework\DatabaseTable,
    \JokesDB\Controllers\Joke,
    \JokesDB\Controllers\Register;

class JokesRoutes
{
    public function callAction($route)
    {
        include_once __DIR__.'/../../includes/databaseConnection.php';

        $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
        $authorsTable = new DatabaseTable($pdo, 'author', 'id');

        if ($route === 'joke/list') {
            $controller = new Joke($jokesTable, $authorsTable);
            $page = $controller->list();
        } elseif ($route === 'joke/home' || $route === '') {
            $controller = new Joke($jokesTable,$authorsTable);
            $page = $controller->home();
        } elseif ($route === 'joke/edit') {
            $controller = new Joke($jokesTable,$authorsTable);
            $page = $controller->edit();
        } elseif ($route === 'joke/delete') {
            $controller = new Joke($jokesTable,$authorsTable);
            $page = $controller->delete();
        } elseif ($route === 'register') {
            $controller = new Register($authorsTable);
            $page = $controller->showForm();
        }

        return $page;
    }
}