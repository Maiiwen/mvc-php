<?php
require_once '../controller/Controller.php';

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
            $articleView = new View('blog', 'article', compact('article', 'comments'));
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
                    $comment = $_POST;
                    CommentManager::add($comment);
                    header('Location: /?controller=blog&action=article&id=' . $_POST['article_id']);
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
}
