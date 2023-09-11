<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\EditCompanyBlock;

class UpdateCompanyController extends AbstractController
{
    public function execute()
    {
        $id = (int)$this->getQueryParam('id');
        if ($this->isPost()) {
            $postParams = $this->getPostParams();
            $post = [
                'name'    => $postParams['name'],
                'type'    => $postParams['type'],
                'address' => $postParams['address'],
            ];

            (new EditCompanyBlock($id))->updateCompany($post);
        }

        $this->redirectTo("Location: /companies");
    }
}
