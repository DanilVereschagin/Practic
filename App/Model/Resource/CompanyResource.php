<?php

declare(strict_types=1);

namespace App\Model\Resource;

use App\Model\Company;
use App\Model\Database;

class CompanyResource
{
    /**
     * @return Company[]
     */
    public function getAll(): array
    {
        $db = new Database();
        $connection = $db->getConnection();
        $rowset = $connection->query('select * from company;');

        $companies = [];
        foreach ($rowset as $row) {
            $company = new Company($row);
            $companies[] = $company;
        }

        return $companies;
    }

    /**
     * @param int|null $id
     * @return Company
     */
    public function getById(?int $id): Company
    {
        $db = new Database();
        $connection = $db->getConnection();
        $sql = 'select * from company where company.id = :ID;';
        $query = $connection->prepare($sql);
        $query->execute(['ID' => $id]);
        $companyInfo = $query->fetch();

        $company = new Company($companyInfo);

        return $company;
    }

    /**
     * @param string|null $name
     * @return Company
     */
    public function getByName(?string $name): Company
    {
        $db = new Database();
        $connection = $db->getConnection();
        $sql = 'select * from company where company.name = :name;';
        $query = $connection->prepare($sql);
        $query->execute(['name' => $name]);
        $companyInfo = $query->fetch();

        $company = new Company($companyInfo);

        return $company;
    }

    public function add(array $post)
    {
        $db = new Database();
        $connection = $db->getConnection();
        $sql = "insert into company set `name` = :name, `type` = :type, `address` = :address";
        $query = $connection->prepare($sql);
        $this->prepareDataOfCompany($query, $post);
        $query->execute();
    }

    public function update(array $post)
    {
        $db = new Database();
        $connection = $db->getConnection();
        $sql = "update company set `name` = :name, `type` = :type, `address` = :address
                where company.id = :ID;";
        $query = $connection->prepare($sql);
        $this->prepareDataOfCompany($query, $post);
        $query->execute();
    }

    protected function prepareDataOfCompany(\PDOStatement $query, array $post)
    {
        $query->bindValue('name', $post['name'], \PDO::PARAM_STR);
        $query->bindValue('type', $post['type'], \PDO::PARAM_INT);
        $query->bindValue('address', $post['address'], \PDO::PARAM_STR);
        if ($post['id'] != null) {
            $query->bindValue('ID', $post['id'], \PDO::PARAM_INT);
        }
    }
}
