<?php
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
        foreach ($data as $key => $value) {
            $collection[] = new $className($value);
        }
        return $collection;
    }

    public static function getAll()
    {
        $pdo = self::getPdoInstance();
        $className = str_replace('Manager', '', get_called_class());
        $sql = "SELECT * FROM " . lcfirst($className);
        $query = $pdo->query($sql);
        return self::hydrateCollection($query->fetchAll(), $className);
    }

    public static function getById(int $id)
    {
        $pdo = self::getPdoInstance();
        $className = str_replace('Manager', '', get_called_class());
        $sql = "SELECT * FROM " . lcfirst($className)  . " WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->execute(compact('id'));

        return new $className($query->fetch());
    }

    public static function add(Object $object)
    {
        $data = $object->getAllVars();
        unset($data['id']);
        $data['created_at'] = (new DateTime('now'))->format('Y-m-d H:i:s');
        $pdo = self::getPdoInstance();
        $className = str_replace('Manager', '', get_called_class());
        $sql = "INSERT INTO " . lcfirst($className) . " (";
        $sql .= implode(', ', array_keys($data));
        $sql .= ") VALUES (";
        $sql .= ":" . implode(', :', array_keys($data));
        $sql .= ")";
        var_dump($sql);
        exit;
        $query = $pdo->prepare($sql);
        $query->execute($data);
    }

    public static function delete(int $id)
    {
        $pdo = self::getPdoInstance();
        $className = str_replace('Manager', '', get_called_class());
        $sql = "DELETE FROM " . lcfirst($className) . " WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->execute(compact('id'));
    }

    public static function update(Object $object)
    {
        $data = $object->getAllVars();
        $pdo = self::getPdoInstance();
        $className = str_replace('Manager', '', get_called_class());
        $sql = "UPDATE " . lcfirst($className) . " SET ";
        $sql .= implode(' = :', array_keys($data));
        $sql .= " = :" . implode(' = :', array_keys($data));
        $sql .= " WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->execute($data);
    }
}
