<?php
namespace JokesDB;

use \NinjaFramework\DatabaseTable;
use \JokesDB\Controllers\Joke;
use JokesDB\Controllers\Register;
use \NinjaFramework\Auth;
use JokesDB\Controllers\Login;

class JokesRoutes implements \NinjaFramework\Routes
{
    private $authorsTable;
    private $jokesTable;

    private $authentication;

    public function __construct()
    {
        include __DIR__.'/../../includes/databaseConnection.php';

        $this->jokesTable = new DatabaseTable($pdo, 'joke', 'id');
        $this->authorsTable = new DatabaseTable($pdo, 'author', 'id');
        
        $this->authentication = new Auth($this->authorsTable, 'email', 'password');
    }

    public function getRoutes(): array
    {
        $jokeController = new Joke($this->jokesTable, $this->authorsTable);
        $authorController = new Register($this->authorsTable);
        $loginController = new Login($this->authentication);

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
                ],
                'login' => true
            ],
            'joke/delete' => [
                'POST' => [
                    'controller' => $jokeController,
                    'action' => 'delete'
                ],
                'login' => true
            ],
            'author/register' => [
                'POST' => [
                    'controller' => $authorController,
                    'action' => 'registerUser'
                ],
                'GET' => [
                    'controller' => $authorController,
                    'action' => 'registrationForm'
                ]
            ],
            'author/success' => [
                'GET' => [
                    'controller' => $authorController,
                    'action' => 'success'
                ]
            ],
            'login/error' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'error'
                ]
            ],
            'login'   => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'loginForm'
                ],
                'POST' => [
                    'controller' => $loginController,
                    'action' => 'loginProcess'
                ]
            ],
            'login/success' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'success'
                ],
                'login' => true
            ]
        ];

        return $routes;
    }

    public function getAuth(): Auth
    {
        return $this->authentication;
    }
}
