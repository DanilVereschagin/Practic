<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Company;
use App\Model\Resource\CompanyResource;
use App\Model\Session;
use Laminas\Di\Di;

class EditCompanyBlock extends AbstractAdminBlock
{
    protected ?int $id;
    protected $companyResource;

    public function __construct(?int $id, CompanyResource $companyResource, Session $session)
    {
        parent::__construct($session);
        $this->id = $id;
        $this->companyResource = $companyResource;
    }

    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/edit-company.phtml';
    }

    public function getCompanyInfo(): Company
    {
        return $this->companyResource->getById($this->id);
    }
}
