<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Company;
use App\Model\Resource\CompanyResource;
use App\Model\Session;
use Laminas\Di\Di;

class CompaniesBlock extends AbstractAdminBlock
{
    protected $companyResource;

    public function __construct(Di $di, CompanyResource $companyResource, Session $session)
    {
        parent::__construct($di, $session);
        $this->companyResource = $companyResource;
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
        return $this->companyResource->getAll();
    }
}
