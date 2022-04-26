<?php

namespace App\Controller;

use Core\Controller;
use App\Entity\Comment;
use App\Entity\Article;
use App\Model\ArticleManager;
use App\Model\CommentManager;
use Core\View;
use DateTime;

class BlogController extends Controller
{
    public static function index()
    {
        $articles = ArticleManager::getAll();
        $indexView = new View('blog', 'index', compact('articles'));
        $indexView->render('index', compact('articles'));
    }
    public static function article()
    {
        if (!empty($_GET['id'])) {
            $article = ArticleManager::getById($_GET['id']);
            $comments = CommentManager::getAllByArticleId($_GET['id']);
            $dataList = ['article', 'comments'];
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
                    $comment = new Comment($_POST);
                    CommentManager::add($comment);
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
            CommentManager::delete($_POST['id']);
            header('Location: /blog/article/' . $_POST['article_id']);
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
                $article = new Article([
                    'title' => '',
                    'content' => '',
                    'created_at' => (new DateTime('now'))->format('Y-m-d H:i:s'),
                ]);
                $articleView = new View('blog', 'edit', compact('article'));
                $articleView->render('edit', compact('article'));
            } else {
                $article = ArticleManager::getById($_GET['id']);
                $articleView = new View('blog', 'edit', compact('article'));
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
            $article = new Article($_POST);
            ArticleManager::add($article);
            header('Location: /blog/article/' . $article->getId());
        } else {
            header('Location: /blog/edit/new');
        }
    }
    public static function update()
    {
        if (!empty($_POST['submit'])) {
            $article = new Article($_POST);
            ArticleManager::update($article);


            header('Location: /blog/article/' . $article->getId());
        } else {
            header('Location: /blog/edit/new');
        }
    }
}
