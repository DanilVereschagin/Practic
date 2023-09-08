<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Database;

class NewCompanyBlock extends AbstractAdminBlock
{
    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/newcompany.phtml';
    }

    public function addCompany(array $post)
    {
        $db = new Database();
        $connection = $db->getConnection();
        $sql = "insert into company set `name` = :name, `type` = :type, `address` = :address";
        $query = $connection->prepare($sql);
        try {
            $query->execute([
                'name'    => $post['name'],
                'type'    => $post['type'],
                'address' => $post['address'],
                ]);
        } catch (\Exception $exception) {
            $exception->getMessage();
        }
    }
}
