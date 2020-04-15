<?php

class JokeControllers
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

        ob_start();
        include_once __DIR__.'/../views/contents/home.html.php';
        $content = ob_get_clean();
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

        // print_r($jokes);

        $title = 'listJokes';

        ob_start();
        include_once __DIR__.'/../views/contents/list.html.php';
        $content = ob_get_clean();
    }

     public function edit()
    {
        if(isset($_POST['joke']['joketext'])) {

            $default_author_id = 3;//temporary

            $records = $_POST['joke'];
            $records['authorid'] = $default_author_id;
            $records['jokedate'] = new DateTime();

            $this->jokesTable->save($records);

            header('location: /list.php');

            exit;

        } else {
            $title = 'addJoke';

            if (isset($_GET['id'])) {
                $title = 'editJoke';
                $joke = $this->jokesTable->getById($_GET['id']);
            }

            ob_start();
            include_once __DIR__.'/../views/contents/edit.html.php';
            $content = ob_get_clean();

        }
    }

    public function delete()
    {
        $this->jokesTable->delete($_POST['id']);

        header('location: /list.php');

        exit;
    }
}