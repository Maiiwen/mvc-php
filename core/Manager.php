<?php

namespace Core;

use PDO;
use PDOException;
use DateTime;
use App\Entity\Article;
use App\Entity\Comment;

abstract class Manager
{
    private static ?PDO $pdo = null;

    public static function getPdoInstance()
    {
        if (self::$pdo === null) {
            try {
                self::$pdo = new PDO('mysql:host=localhost;dbname=mvc-blog', 'root', 'root', [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $pe) {
                die("Error : " . $pe->getMessage());
            }
        }
        return self::$pdo;
    }
    public static function hydrateCollection(array $data, string $className)
    {
        $collection = [];
        $className = 'App\\Entity\\' . $className;
        foreach ($data as $key => $value) {
            $collection[] = new $className($value);
        }
        return $collection;
    }

    protected static function getClassName()
    {
        $className = str_replace('Manager', '', explode('\\', get_called_class())[2]);
        return $className;
    }
    public static function getAll()
    {
        $pdo = self::getPdoInstance();
        $className = self::getClassName();
        $sql = "SELECT * FROM " . lcfirst($className);
        $query = $pdo->query($sql);
        return self::hydrateCollection($query->fetchAll(), $className);
    }

    public static function getById(int $id)
    {
        $pdo = self::getPdoInstance();
        $className = self::getClassName();
        $sql = "SELECT * FROM " . lcfirst($className)  . " WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->execute(compact('id'));
        return self::hydrateCollection([$query->fetch()], $className)[0];
    }

    public static function getItems(array $items)
    {
        $pdo = self::getPdoInstance();
        $className = self::getClassName();
        $sql = "SELECT * FROM " . lcfirst($className) . " WHERE id IN (" . implode(',', $items) . ")";
        $query = $pdo->query($sql);
        return self::hydrateCollection($query->fetchAll(), $className);
    }

    public static function getItemsById(int $id, array $items)
    {
        $pdo = self::getPdoInstance();
        $className = self::getClassName();
        $sql = "SELECT * FROM " . lcfirst($className) . " WHERE id = :id AND id IN (" . implode(',', $items) . ")";
        $query = $pdo->prepare($sql);
        $query->execute(compact('id'));
        return self::hydrateCollection([$query->fetch()], $className)[0];
    }

    public static function add(Object $object)
    {
        $data = $object->getAllVars();
        unset($data['id']);
        $data['created_at'] = (new DateTime('now'))->format('Y-m-d H:i:s');
        $pdo = self::getPdoInstance();
        $className = self::getClassName();
        $sql = "INSERT INTO " . lcfirst($className) . " (";
        $sql .= implode(', ', array_keys($data));
        $sql .= ") VALUES (";
        $sql .= ":" . implode(', :', array_keys($data));
        $sql .= ")";
        $query = $pdo->prepare($sql);
        $query->execute($data);
        $object->setId($pdo->lastInsertId());
        return $object->getId();
    }

    public static function delete(int $id)
    {
        $pdo = self::getPdoInstance();
        $className = self::getClassName();
        $sql = "DELETE FROM " . lcfirst($className) . " WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->execute(compact('id'));
    }

    public static function update(Object $object)
    {
        $data = $object->getAllVars();
        $data['created_at'] = (new DateTime('now'))->format('Y-m-d H:i:s');
        $id = $data['id'];
        unset($data['id']);
        $pdo = self::getPdoInstance();
        $className = self::getClassName();
        $sql = "UPDATE " . lcfirst($className) . " SET ";
        foreach ($data as $key => $value) {
            $sql .= $key . " = :" . $key . ", ";
        }
        $sql = substr($sql, 0, -2);
        $sql .= " WHERE id = :id";

        $query = $pdo->prepare($sql);
        $query->execute($data + compact('id'));
    }
}
