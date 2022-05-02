<?php

namespace App\FormType;

use Core\Form;
use App\DTO\ArticleDTO;
use Core\FormType\TextType;
use Core\FormType\HiddenType;
use Core\FormType\SubmitType;
use Core\FormType\TextAreaType;

class ArticleFormtype
{
    public static function getForm(?ArticleDTO $article = null)
    {
        $form = new Form($article ? '/blog/update/' . $article->getId() : '/blog/new', [
            new TextType('title', $article ? $article->getTitle() : '', 'Titre'),
            new TextAreaType('content', $article ? $article->getRawContent() : '', 'Contenu', 'textarea'),
            new HiddenType('id', $article ? $article->getId() : 'new'),
            new SubmitType('submit', 'submit', 'Ajouter')
        ]);
        return $form;
    }
}
