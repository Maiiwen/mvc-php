<?php

namespace App\Model;

use Core\Manager;

class CommentManager extends Manager
{

    public static function getAllByArticleId(int $id)
    {
        $pdo = parent::getPdoInstance();
        $className = str_replace('Manager', '', get_called_class());

        $sql = "SELECT * FROM " . lcfirst($className) . " WHERE article_id = :id ORDER BY created_at DESC";
        $query = $pdo->prepare($sql);
        $query->execute(compact('id'));

        return self::hydrateCollection($query->fetchAll(), Comment::class);
    }
}
