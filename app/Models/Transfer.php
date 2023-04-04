<?php

namespace App\Models;

use Core\Engine\Model;

class Transfer extends Model
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
    #INSERT INTO `transfer` (`customer_id`, `bank_account_id`, `amount`, `status`)
    #VALUES (1, 2, 500.00, 1);

    public function getAccountByUser($user)
    {
        return $this->db->query("
            SELECT
                ba.*, b.name AS bank_name
            FROM
                bank_account ba
            JOIN bank b ON ba.bank_id = b.bank_id
            WHERE
                customer_id=$user
        ");
    }

    public function insertTransfer($user, $account, $amount)
    {
        $insert = $this->db->query("
        INSERT INTO `transfer` (`customer_id`, `bank_account_id`, `amount`, `status`)
        VALUES ($user, $account, $amount, 1);
    ");
        $id = $this->db->getLastId();

        return $id;
    }

    public function insertTransaction($user, $transferId, $amount)
    {
        $insert = $this->db->query("
        INSERT INTO `transaction` (`customer_id`, `order_id`, `product_id`, `transfer_id`, `value`, `status`)
        VALUES ($user, NULL, NULL, $transferId, $amount, 1);

    ");
        $id = $this->db->getLastId();

        return $id;
    }

    public function insertHistory($transactionId, $user)
    {   
        $insert = $this->db->query("
        INSERT INTO `history` (`transaction_id`, `customer_id`, `history_type_id`, `note`, `status`)
        VALUES ($transactionId, $user, 4, 'Transferência Bancária', 1);


    ");
        $id = $this->db->getLastId();

        return $id;
    }

    public function getTranfersByUser($user)
    {
        return $this->db->query("
        SELECT
            t.*, b.name AS bank_name, tr.date_added AS date
        FROM
            transfer t
        JOIN bank_account ba ON t.bank_account_id = ba.bank_account_id
        JOIN bank b ON ba.bank_id = b.bank_id
        JOIN transaction tr ON t.transfer_id = tr.transfer_id
        WHERE
            t.customer_id=$user
    ");
    }

}
