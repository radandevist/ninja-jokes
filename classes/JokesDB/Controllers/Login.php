<?php
namespace JokesDB\Controllers;

use NinjaFramework\Auth;

class Login
{
    private $_authentication;

    public function __construct(Auth $authentication)
    {
        $this->_authentication = $authentication;
    }

    public function error()
    {
        return [
            'content' => 'loginerror.html.php',
            'title' => 'You are not logged in'
        ];
    }

    public function loginForm()
    {
        return ['content' => 'login.html.php', 'title' => 'Login'];
    }

    public function loginProcess()
    {
        // $errors = [];
        // $isvalid = true;

        // if (empty($_POST['username'])) {
        //     $isvalid = false;
        //     $errors[] = 'empty username';
        // }
        // if (empty($_POST['email'])) {
        //     $isvalid = false;
        //     $errors[] = 'empty email';
        // }
        // if (empty($_POST['password'])) {
        //     $isvalid = false;
        //     $errors[] = 'empty password';
        // }

        // if ($isvalid) {
            if ($this->_authentication->login($_POST['email'], $_POST['password'])) {
                header('location: /login/success');
            } else {
                return [
                    'content' => 'login.html.php',
                    'title' => 'login',
                    'variables' => [
                        'errors' => ['Invalid username/password']
                    ]
                ];
            }
        // } else {
        //     return [
        //         'content' => 'login.html.php',
        //         'title' => 'login',
        //         'variables' => [
        //             'errors' => $errors
        //         ]
        //     ];
        // }
    }

    public function success()
    {
        return [
            'content' => 'loginsuccess.html.php',
            'title' => 'Login successful'
        ];
    }
}
