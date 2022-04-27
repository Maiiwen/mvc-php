<?php

namespace App\Controller;

use Core\Controller;
use App\Services\ArticleService;
use App\Services\CommentService;
use Core\View;

class BlogController extends Controller
{
    public static function index()
    {
        $articles = ArticleService::getAll();
        $indexView = new View('blog', 'index', compact('articles'));
        $indexView->render('index', compact('articles'));
    }
    public static function article()
    {
        if (!empty($_GET['id'])) {
            $article = ArticleService::getAllById($_GET['id']);
            $comments = CommentService::getAllByArticleId($_GET['id']);
            $commentForm = CommentService::getForm($_GET['id']);
            $dataList = ['article', 'comments', 'commentForm'];
            $articleView = new View('blog', 'article', compact($dataList));
            $articleView->render('article', compact('article', 'comments'));
        } else {
            header('Location: /');
            exit;
        }
    }

    public static function comment()
    {
        if (!empty($_POST['content']) && !empty($_POST['article_id'])) {
            if (!empty($_POST['author'])) {
                if (!empty($_POST['content'])) {
                    CommentService::add($_POST);
                    header('Location: /blog/article/' . $_POST['article_id']);
                    exit;
                } else {
                    $message = 'Veuillez ajouter un commentaire';
                    header('Location: /');
                    exit;
                }
            } else {
                $message = 'Veuillez renseigner votre nom';
                header('Location: /');
                exit;
            }
        } else {
            header('Location: /');
            exit;
        }
    }

    public static function delcomment()
    {
        if (!empty($_POST['id'])) {
            CommentService::delete($_POST['id']);
            header('Location: /blog/article/' . $_POST['article_id']);
            exit;
        } else {
            header('Location: /');
            exit;
        }
    }
    public static function delarticle()
    {
        if (!empty($_POST['id'])) {
            ArticleService::delete($_POST['id']);
            header('Location: /blog');
            exit;
        } else {
            header('Location: /');
            exit;
        }
    }

    public static function edit()
    {
        if (!empty($_GET['id'])) {
            if ($_GET['id'] === 'new') {
                $form = ArticleService::getForm();
                $articleView = new View('blog', 'edit', compact('form'));
                $articleView->render('edit');
            } else {
                $article = ArticleService::getAllById($_GET['id']);
                $form = ArticleService::getForm($article);
                $articleView = new View('blog', 'edit', compact('form'));
                $articleView->render('edit', compact('article'));
            }
        } else {
            header('Location: /');
            exit;
        }
    }

    public static function new()
    {
        if (!empty($_POST['submit'])) {
            $id = ArticleService::add($_POST);
            header('Location: /blog/article/' . $id);
        } else {
            header('Location: /blog/edit/new');
        }
    }
    public static function update()
    {
        if (!empty($_POST['submit'])) {
            ArticleService::update($_POST);
            header('Location: /blog/article/' . $_POST['id']);
        } else {
            header('Location: /blog/edit/new');
        }
    }
}
