<?php
namespace JokesDB\Controllers;

class Login
{
    public function error()
    {
        return [
            'content' => 'loginerror.html.php',
            'title' => 'You are not logged in'
        ];
    }
}
