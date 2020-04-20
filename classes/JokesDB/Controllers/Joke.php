<?php
namespace JokesDB\Controllers;

use \NinjaFramework\DatabaseTable;

class Joke
{
    private $authorsTable;
    private $jokesTable;

    public function __construct(DatabaseTable $jokesTable, DatabaseTable $authorsTable)
    {
        $this->jokesTable = $jokesTable;
        $this->authorsTable = $authorsTable;
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
                'email' => $author['email']
            ];
        }

        $title = 'listJokes';

        $content = 'list.html.php';

        return [
            'content' => $content,
            'title' => $title,
            'variables' => ['jokes' => $jokes]
        ];
    }

    public function edit()
    {
        // if(isset($_POST['joke']['joketext'])) {

            // $default_author_id = 3;//temporary

            // $records = $_POST['joke'];
            // $records['authorid'] = $default_author_id;
            // $records['jokedate'] = new \DateTime();

            // $this->jokesTable->save($records);

            // http_response_code(301);
            // header('location: /joke/list');

            // exit;

        // } else {
            $title = 'addJoke';

            if (isset($_GET['id'])) {
                $title = 'editJoke';
                $joke = $this->jokesTable->getById($_GET['id']);
            }

            $content = 'edit.html.php';
        // }

        return [
            'content' => $content,
            'title' => $title,
            'variables' => ['joke' => $joke ?? null]
        ];
    }

    public function saveEdit()
    {
        $default_author_id = 3;//temporary

        $records = $_POST['joke'];
        $records['authorid'] = $default_author_id;
        $records['jokedate'] = new \DateTime();

        $this->jokesTable->save($records);

        http_response_code(301);
        header('location: /joke/list');

        exit;
    }

    public function delete()
    {
        $this->jokesTable->delete($_POST['id']);

        http_response_code(301);
        header('location: /joke/list');

        exit;
    }
}