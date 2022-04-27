<?php

namespace Core;

abstract class Service
{
    protected static function getInfos()
    {
        $className = str_replace('Service', '', explode('\\', get_called_class())[2]);
        $entity = 'App\\Entity\\' . $className;
        $manager = 'App\\Model\\' . $className . 'Manager';
        $dto = 'App\\DTO\\' . $className . 'DTO';
        return (compact('className', 'manager', 'dto', 'entity'));
    }

    public static function getAll()
    {
        extract(self::getInfos());
        $articles = $manager::getAll();
        $articlesDTO = [];
        foreach ($articles as $article) {
            $articlesDTO[] = new $dto($article);
        }
        return $articlesDTO;
    }
    public static function getAllById(int $id)
    {
        extract(self::getInfos());

        $article = $manager::getById($id);
        $articleDTO = new $dto($article);
        return $articleDTO;
    }
    public static function getItems(array $items)
    {
        extract(self::getInfos());
        $articles = $manager::getItems($items);
        $articlesDTO = [];
        foreach ($articles as $article) {
            $articlesDTO[] = new $dto($article);
        }
        return $articlesDTO;
    }
    public static function getItemsById(int $id, array $items)
    {
        extract(self::getInfos());
        $article = $manager::getItemsById($id, $items);
        $articleDTO = new $dto($article);
        return $articleDTO;
    }
    public static function add(array $data)
    {
        var_dump($data);
        extract(self::getInfos());
        if (!is_int($data['id'])) {
            unset($data['id']);
        }
        $data['created_at'] = (new \DateTime('now'))->format('Y-m-d H:i:s');
        $object = new $entity($data);
        $id = $manager::add($object);
        return $id;
    }
    public static function update(array $data)
    {
        extract(self::getInfos());
        $object = new $entity($data);
        $manager::update($object);
    }
    public static function delete(int $id)
    {
        extract(self::getInfos());
        $manager::delete($id);
    }
}
