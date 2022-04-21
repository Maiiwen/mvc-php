<?php
require_once '../model/ArticleManager.php';
require_once '../model/CommentManager.php';
require_once '../view/View.php';
abstract class Controller
{
    public abstract static function index();
}
