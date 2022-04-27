<?php

namespace App\Services;

use App\DTO\CommentDTO;
use Core\Service;
use App\Form\Form;
use Core\FormType\TextareaType;
use Core\FormType\TextType;
use Core\FormType\SubmitType;
use Core\FormType\HiddenType;

class CommentService extends Service
{

    public static function getAllByArticleId(int $id)
    {
        extract(parent::getInfos());
        $comments = $manager::getAllByArticleId($id);
        $commentsDTO = [];
        foreach ($comments as $comment) {
            $commentsDTO[] = new $dto($comment);
        }
        return $commentsDTO;
    }

    public static function getForm(int $articleId, ?CommentDTO $comment = null)
    {
        $form = new Form(
            $comment ? '/blog/comment/edit' . $comment->getId() : '/blog/comment/',
            [
                new TextType('author', $comment ? $comment->getAuthor() : '', 'Votre nom'),
                new TextType('content', $comment ? $comment->getContent() : '', 'Votre commentaire'),
                new HiddenType('article_id', $articleId),
                new SubmitType('submit', 'submit', 'Ajouter')
            ]
        );
        return $form;
    }
}
