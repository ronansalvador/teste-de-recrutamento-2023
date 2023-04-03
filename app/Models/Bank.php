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

    public function getTypeAccount()
    {
        return $this->db->query("
            SELECT
                *
            FROM
                type_account
        ");
    }

    public function getTypeAccountByName($typeAccount)
    {
        return $this->db->query("
            SELECT
                type_account_id
            FROM
                type_account
            WHERE
                name='$typeAccount'
        ");
    }

    public function getBankByName($banco)
    {
        return $this->db->query("
            SELECT
                bank_id
            FROM
                bank
            WHERE
                name='$banco'
        ");
    }    

    public function createAccount($typeAccountId, $bancoId, $user, $agencia, $conta)
    {

        return $this->db->query("
        INSERT INTO bank_account (customer_id, bank_id, type_account_id, agencia, conta)
        VALUES ($user, $bancoId, $typeAccountId, '$agencia', '$conta');
        ");
    }

    public function getAccountsByUser($user)
    {
        return $this->db->query("
        SELECT ba.*, b.name AS bank_name, ta.name AS type_account_name
        FROM bank_account ba
        JOIN bank b ON ba.bank_id = b.bank_id
        JOIN type_account ta ON ba.type_account_id = ta.type_account_id
        JOIN customer c ON ba.customer_id = c.customer_id
        WHERE c.customer_id= $user;
    "); 
    }

}
