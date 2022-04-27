<?php

namespace App\Model;

use Core\Manager;

class CommentManager extends Manager
{

    public static function getAllByArticleId(int $id)
    {
        $pdo = parent::getPdoInstance();
        $className = parent::getClassName();
        $sql = "SELECT * FROM " . lcfirst($className) . " WHERE article_id = :id ORDER BY created_at DESC";
        $query = $pdo->prepare($sql);
        $query->execute(compact('id'));
        return self::hydrateCollection($query->fetchAll(), $className);
    }
}
