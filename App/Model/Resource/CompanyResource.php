<?php

declare(strict_types=1);

namespace App\Model\Resource;

use App\Factory\EntityFactory;
use App\Model\Company;
use App\Model\Database;
use Laminas\Di\Di;

class CompanyResource extends AbstractResource
{
    protected string $table = 'company';
    protected $entityFactory;

    public function __construct(Di $di, EntityFactory $entityFactory)
    {
        parent::__construct($di);
        $this->entityFactory = $entityFactory;
    }

    /**
     * @param string|null $name
     * @return Company
     */
    public function getByName(?string $name): Company
    {
        $connection = Database::getInstance();
        $sql = 'select * from company where company.name = :name;';
        $query = $connection->prepare($sql);
        $query->execute(['name' => $name]);
        $companyInfo = $query->fetch();

        $company = $this->entityFactory->create('company', ['data' => $companyInfo]);

        return $company;
    }

    public function add(array $post)
    {
        $connection = Database::getInstance();
        $sql = 'insert into company set `name` = :name, `type` = :type, `address` = :address';
        $query = $connection->prepare($sql);
        $this->prepareDataOfCompany($query, $post);
        $query->execute();
    }

    public function update(array $post)
    {
        $connection = Database::getInstance();
        $sql = 'update company set `name` = :name, `type` = :type, `address` = :address
                where company.id = :ID;';
        $query = $connection->prepare($sql);
        $this->prepareDataOfCompany($query, $post);
        $query->execute();
    }

    protected function prepareDataOfCompany(\PDOStatement $query, array $post)
    {
        $query->bindValue('name', $post['name'], \PDO::PARAM_STR);
        $query->bindValue('type', $post['type'], \PDO::PARAM_INT);
        $query->bindValue('address', $post['address'], \PDO::PARAM_STR);
        if (array_key_exists('id', $post)) {
            $query->bindValue('ID', $post['id'], \PDO::PARAM_INT);
        }
    }
}
