<?php

namespace App\Controller;

use Core\Controller;
use Core\View;

class HomeController extends Controller
{
    public static function index()
    {
        $indexView = new View('home', 'index');
        $indexView->render();
    }
}
