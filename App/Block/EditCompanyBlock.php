<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Company;
use App\Model\Resource\CompanyResource;
use Laminas\Di\Di;

class EditCompanyBlock extends AbstractAdminBlock
{
    protected ?int $id;

    public function __construct(?int $id, Di $di)
    {
        $this->id = $id;
    }

    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/edit-company.phtml';
    }

    public function getCompanyInfo(): Company
    {
        $companyResource = $this->di->get(CompanyResource::class, ['di' => $this->di]);
        return $companyResource->getById($this->id);
    }
}
