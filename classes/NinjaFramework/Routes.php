<?php
namespace NinjaFramework;

use NinjaFramework\Auth;

interface Routes
{
    public function getRoutes(): array;
    public function getAuth(): Auth;
}