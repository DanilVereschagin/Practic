<?php

declare(strict_types=1);

namespace App\Model\Resource;

use App\Model\Database;

class AbstractResource
{
    protected string $table = '';

    /**
     * @return array
     */
    public function getAll(): array
    {
        $entityModel = 'App\\Model\\' . ucfirst($this->table);
        $connection = Database::getInstance();
        $rowset = $connection->query('Select * from ' . $this->table);

        $entities = [];
        foreach ($rowset as $row) {
            $entity = new $entityModel($row);
            $entities[] = $entity;
        }

        return $entities;
    }

    public function getById(?int $id)
    {
        $entityModel = 'App\\Model\\' . ucfirst($this->table);
        $connection = Database::getInstance();
        $sql = 'select * from ' . $this->table . ' where `id` = :ID;';
        $query = $connection->prepare($sql);
        $query->execute(['ID' => $id]);
        $info = $query->fetch();

        $entity = new $entityModel($info);

        return $entity;
    }

    public function delete(int $id)
    {
        $connection = Database::getInstance();
        $sql = "delete from " . $this->table . " where `id` = :ID";
        $query = $connection->prepare($sql);
        $query->bindValue('ID', $id, \PDO::PARAM_INT);
        $query->execute();
    }
}
