<?php
namespace JokesDB;

use \NinjaFramework\DatabaseTable;
use \JokesDB\Controllers\Joke;
// use \JokesDB\Controllers\Register;

class JokesRoutes implements \NinjaFramework\Routes
{
    public function getRoutes()
    {
        include_once __DIR__.'/../../includes/databaseConnection.php';

        $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
        $authorsTable = new DatabaseTable($pdo, 'author', 'id');

        $jokeController = new Joke($jokesTable, $authorsTable);

        $routes = [
            '' => [
                'GET' => [
                    'controller' => $jokeController,
                    'action' => 'home'
                ]
            ],
            'joke/list' => [
                'GET' => [
                    'controller' => $jokeController,
                    'action' => 'list'
                ]
            ],
            'joke/edit' => [
                'POST' => [
                    'controller' => $jokeController,
                    'action' => 'saveEdit'
                ],
                'GET' => [
                    'controller' => $jokeController,
                    'action' => 'edit'
                ]
            ],
            'joke/delete' => [
                'POST' => [
                    'controller' => $jokeController,
                    'action' => 'delete'
                ]
            ]
        ];

        return $routes;
    }
}