<?php

namespace App\Controller;

use Core\Controller;
use Core\View;

class HomeController extends Controller
{
    public static function index()
    {
        (new View('home', 'index'))->render();
    }
}
