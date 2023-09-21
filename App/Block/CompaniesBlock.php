<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Company;
use App\Model\Resource\CompanyResource;

class CompaniesBlock extends AbstractAdminBlock
{
    public function renderTemplate()
    {
        require APP_ROOT . '/view/template/companies.phtml';
    }

    /**
     * @return Company[]
     */
    public function getAllCompanies(): array
    {
        $companyResource = new CompanyResource();
        return $companyResource->getAll();
    }
}
