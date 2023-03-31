<?php

namespace App\Models;

use Core\Engine\Model;

class Bank extends Model
{
    public function getAll()
    {
        return $this->db->query("
            SELECT
                *
            FROM
                bank
        ");
    }

}
