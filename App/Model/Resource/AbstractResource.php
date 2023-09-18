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
}
