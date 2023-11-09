<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Company;
use App\Model\Resource\CompanyResource;
use Laminas\Di\Di;

class CompaniesBlock extends AbstractAdminBlock
{
    public function __construct(Di $di)
    {
        $this->di = $di;
    }

    public function renderTemplate()
    {
        require APP_ROOT . '/view/template/companies.phtml';
    }

    /**
     * @return Company[]
     */
    public function getAllCompanies(): array
    {
        $companyResource = $this->di->get(CompanyResource::class, ['di' => $this->di]);
        return $companyResource->getAll();
    }
}
