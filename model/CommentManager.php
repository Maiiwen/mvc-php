<?php
require_once '../model/Manager.php';
class CommentManager extends Manager
{
    private const TABLE = 'comment';

    public static function getAll()
    {
        $pdo = parent::getPdoInstance();

        $sql = "SELECT * FROM " . self::TABLE;
        $query = $pdo->query($sql);
        return $query->fetchAll();
    }

    public static function getAllByArticleId(int $id)
    {
        $pdo = parent::getPdoInstance();

        $sql = "SELECT * FROM " . self::TABLE . " WHERE article_id = :id";
        $query = $pdo->prepare($sql);
        $query->execute(compact('id'));

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

    public static function add(array $comment)
    {
        $pdo = parent::getPdoInstance();

        $sql = "INSERT INTO " . self::TABLE . " (content, author , article_id, created_at) VALUES (:content, :author, :article_id, NOW())";
        $query = $pdo->prepare($sql);
        $query->execute($comment);
    }
}
