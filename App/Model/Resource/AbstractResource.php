<?php

declare(strict_types=1);

namespace App\Model\Resource;

use App\Model\Database;

class AbstractResource
{
    /**
     * @param string $tableName
     * @return array
     */
    public function getAll(string $tableName): array
    {
        $entityModel = 'App\\Model\\' . ucfirst($tableName);
        $connection = Database::getInstance();
        $rowset = $connection->query('Select * from ' . $tableName);

        $entities = [];
        foreach ($rowset as $row) {
            $entity = new $entityModel($row);
            $entities[] = $entity;
        }

        return $entities;
    }

    public function getById(?int $id, string $tableName)
    {
        $entityModel = 'App\\Model\\' . ucfirst($tableName);
        $connection = Database::getInstance();
        $sql = 'select * from ' . $tableName . ' where `id` = :ID;';
        $query = $connection->prepare($sql);
        $query->execute(['ID' => $id]);
        $info = $query->fetch();

        $entity = new $entityModel($info);

        return $entity;
    }

    public function delete(int $id, string $tableName)
    {
        $connection = Database::getInstance();
        $sql = "delete from " . $tableName . " where `id` = :ID";
        $query = $connection->prepare($sql);
        $query->bindValue('ID', $id, \PDO::PARAM_INT);
        $query->execute();
    }
}
