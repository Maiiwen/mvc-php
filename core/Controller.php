<?php
require_once '../src/model/ArticleManager.php';
require_once '../src/model/CommentManager.php';
require_once '../core/View.php';
abstract class Controller
{
    public abstract static function index();
}
