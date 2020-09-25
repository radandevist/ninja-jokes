<?php
namespace JokesDB\Controllers;

use NinjaFramework\DatabaseTable;

class Register
{
    private $authorsTable;

    public function __construct(DatabaseTable $authorsTable)
    {
        $this->authorsTable = $authorsTable;
    }

    public function registrationForm()
    {
        return ['content' => 'register.html.php', 'title' => 'Register an account'];
    }

    public function registerUser()
    {
        $author = $_POST['author'];

        $valid = true;
        $errors= [];
        
        if (empty($author['name'])) {
            $valid = false;
            $errors[] = 'Name cannot be blank';
        }

        if (empty($author['email'])) {
            $valid = false;
            $errors[] = 'Email cannot be blank';
        } elseif (filter_var($author['email'], FILTER_VALIDATE_EMAIL) === false) {
            $valid = false;
            $errors[] = 'Invalid email address';
        } else {
            $author['email'] = strtolower($author['email']);
            if (count($this->authorsTable->find('email', $author['email'])) > 0) {
                $valid = false;
                $errors[] = 'This email address is already registered';
            }
        }

        if (empty($author['password'])) {
            $valid = false;
            $errors[] = 'Pasword cannot be blank';
        }

        if ($valid === true) {
            $author['password'] = password_hash($author['password'], PASSWORD_DEFAULT);
            $this->authorsTable->save($author);
            header('location: /author/success');
            http_response_code(301);
        } else {
            return [
                'content' => 'register.html.php',
                'title' => 'Register an account',
                'variables' => [
                    'errors' => $errors,
                    'author' => $author
                ]
            ];
        }

    }

    public function success()
    {
        return ['content' => 'registersuccess.html.php', 'title' => 'registration successful'];
    }

}