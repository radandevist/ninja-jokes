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

    public function success()
    {
        return ['content' => 'registersuccess.html.php', 'title' => 'registration successful'];
    }


    // public function showForm()
    // {

    // }



}