<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Company;
use App\Model\Database;
use App\Model\Resource\CompanyResource;

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

    /**
     * @return Company
     */
    public function getCompanyInfo(): Company
    {
        $companyResource = new CompanyResource();
        return $companyResource->getById($this->id);
    }
}
