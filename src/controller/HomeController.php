<?php
require_once '../core/Controller.php';
class HomeController extends Controller
{
    public static function index()
    {
        $indexView = new View('home', 'index');
        $indexView->render('index');
    }
}
