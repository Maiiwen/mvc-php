<?php

namespace App\Services;

use Core\Service;

use App\DTO\ArticleDTO;
use App\Form\Form;
use Core\FormType\TextareaType;
use Core\FormType\TextType;
use Core\FormType\SubmitType;
use Core\FormType\HiddenType;

class ArticleService extends Service
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
