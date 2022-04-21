<?php
require_once '../model/Manager.php';
class ArticleManager extends Manager
{
    private const TABLE = 'article';

    public static function getAll()
    {
        $pdo = parent::getPdoInstance();

        $sql = "SELECT * FROM " . self::TABLE;
        $query = $pdo->query($sql);
        return $query->fetchAll();
    }

    public static function getById(int $id)
    {
        $pdo = parent::getPdoInstance();

        $sql = "SELECT * FROM " . self::TABLE . " WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->execute(compact('id'));

        return $query->fetch();
    }
}
