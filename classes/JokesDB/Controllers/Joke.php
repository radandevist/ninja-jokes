<?php
namespace JokesDB\Controllers;

use NinjaFramework\Auth;
use \NinjaFramework\DatabaseTable;

class Joke
{
    private $authorsTable;
    private $jokesTable;

    private $auth;

    public function __construct(
        DatabaseTable $jokesTable,
        DatabaseTable $authorsTable,
        Auth $authentication
    )
    {
        $this->jokesTable = $jokesTable;
        $this->authorsTable = $authorsTable;
        $this->auth = $authentication;
    }

    public function home()
    {
        $totaljoke = $this->jokesTable->totalCount();

        $title = 'home';

        $content = 'home.html.php';

        return [
            'content' => $content,
            'title' => $title,
            'variables' => ['totaljoke' => $totaljoke]
        ];
    }

    public function list()
    {
        $result = $this->jokesTable->getAll();

        $jokes = [];
        foreach ($result as $joke) {
            $author = $this->authorsTable->getById($joke['authorid']);
            $jokes[] = [
                'id' => $joke['id'],
                'joketext' => $joke['joketext'],
                'jokedate' => $joke['jokedate'],
                'name' => $author['name'],
                'email' => $author['email'],
                'authorId' => $author['id']
            ];
        }

        $author = $this->auth->getUser();

        $title = 'listJokes';

        $content = 'list.html.php';

        return [
            'content' => $content,
            'title' => $title,
            'variables' => [
                'jokes' => $jokes,
                'userId' => $author['id'] ?? null
            ]
        ];
    }

    public function edit()
    {
        $author = $this->auth->getUser();

        $title = 'addJoke';

        if (isset($_GET['id'])) {
            $title = 'editJoke';
            $joke = $this->jokesTable->getById($_GET['id']);
        }

        // var_dump($joke);

        $content = 'edit.html.php';
            
        return [
            'content' => $content,
            'title' => $title,
            'variables' => [
                'joke' => $joke ?? null,
                'userId' => $author['id']
            ]
        ];
    }

    public function saveEdit()
    {
        $author = $this->auth->getUser();

        if (isset($_GET['id'])) {
            $joke = $this->jokesTable->getById($_GET['id']);

            if ($joke['authorid'] != $author['id']) {
                return;
            }
        }

        $records = $_POST['joke'];
        $records['authorid'] = $author['id'];
        $records['jokedate'] = new \DateTime();

        $this->jokesTable->save($records);

        http_response_code(301);
        header('location: /joke/list');

        exit;
    }

    public function delete()
    {
        $author = $this->auth->getUser();

        if (isset($_GET['id'])) {
            $joke = $this->jokesTable->getById($_GET['id']);

            if ($joke['authorid'] != $author['id']) {
                return;
            }
        }

        $this->jokesTable->delete($_POST['id']);

        http_response_code(301);
        header('location: /joke/list');

        exit;
    }
}