<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Database;

class EditCompanyBlock extends AbstractAdminBlock
{
    protected ?int $id;

    public function __construct(?int $id)
    {
        $this->id = $id;
    }

    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/edit-company.phtml';
    }

    public function getCompanyInfo(): array
    {
        $db = new Database();
        $connection = $db->getConnection();
        $sql = 'Select * from company where company.id = :ID;';
        $query = $connection->prepare($sql);
        $query->execute(['ID' => $this->id]);
        $company = $query->fetchAll();
        return $company;
    }

    public function updateCompany(array $post)
    {
            $db = new Database();
            $connection = $db->getConnection();
            $sql = "update company set `name` = :name, `type` = :type, `address` = :address
                    where company.name = :Name;
                    ";
            $query = $connection->prepare($sql);
        try {
            $this->prepareDataOfCompany($query, $post);
            $query->execute();
        } catch (\Exception $exception) {
            $exception->getMessage();
        }
    }

    protected function prepareDataOfCompany(\PDOStatement $query, array $post)
    {
        $query->bindValue('name', $post['name'], \PDO::PARAM_STR);
        $query->bindValue('type', $post['type'], \PDO::PARAM_INT);
        $query->bindValue('address', $post['address'], \PDO::PARAM_STR);
        $query->bindValue('Name', $post['name'], \PDO::PARAM_STR);
    }
}
