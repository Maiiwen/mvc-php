<?php

namespace App\Services;

use Core\Service;


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
}
