<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Database;

class CompaniesBlock extends AbstractAdminBlock
{
    public function renderTemplate()
    {
        require APP_ROOT . '/view/template/companies.phtml';
    }

    public function getAllCompanies(): \PDOStatement
    {
        $db = new Database();
        $connection = $db->getConnection();
        $companies = $connection->query('Select * from company');
        return $companies;
    }
}
