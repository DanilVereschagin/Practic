<?php

declare(strict_types=1);

namespace App\Model\Resource;

use App\Model\Database;
use Laminas\Di\Di;

class AbstractResource
{
    protected string $table = '';
    protected $di;
    protected $connection;

    public function __construct(Di $di, Database $connection)
    {
        $this->di = $di;
        $this->connection = $connection->getConnection();
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $entityModel = 'App\\Model\\' . ucfirst($this->table);
        $rowset = $this->connection->query('Select * from ' . $this->table);

        $entities = [];
        foreach ($rowset as $row) {
            $entity = $this->di->get($entityModel, ['data' => $row]);
            $entities[] = $entity;
        }

        return $entities;
    }

    public function getById(?int $id)
    {
        $entityModel = 'App\\Model\\' . ucfirst($this->table);
        $sql = 'select * from ' . $this->table . ' where `id` = :ID;';
        $query = $this->connection->prepare($sql);
        $query->execute(['ID' => $id]);
        $info = $query->fetch();

        $entity = $this->di->get($entityModel, ['data' => $info]);

        return $entity;
    }

    public function delete(int $id)
    {
        $sql = 'delete from ' . $this->table . ' where `id` = :ID';
        $query = $this->connection->prepare($sql);
        $query->bindValue('ID', $id, \PDO::PARAM_INT);
        $query->execute();
    }
}
