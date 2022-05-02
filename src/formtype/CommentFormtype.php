<?php

namespace App\FormType;

use Core\Form;
use App\DTO\CommentDTO;
use Core\FormType\TextType;
use Core\FormType\HiddenType;
use Core\FormType\SubmitType;


class CommentFormtype
{
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
