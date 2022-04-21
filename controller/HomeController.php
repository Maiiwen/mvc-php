<?php
require_once '../controller/Controller.php';
class HomeController extends Controller
{
    public static function index()
    {
        $indexView = new View('home', 'index');
        $indexView->render('index');
    }
}
