<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Database;

class NewCompanyBlock
{
    public function render()
    {
        require_once APP_ROOT . '/view/template/newcompany.phtml';
    }

    public function addCompany()
    {
            $db = new Database();
            $connection = $db->getConnection();
            $sql = "insert into company set `name` = :name, `type` = :type, `address` = :address";
            $query = $connection->prepare($sql);
        try {
            $query->execute(array(
                'name'    => $_POST['name'],
                'type'    => $_POST['type'],
                'address' => $_POST['address'],
            ));
        } catch (\Exception $exception) {
            $exception->getMessage();
        }
    }
}
