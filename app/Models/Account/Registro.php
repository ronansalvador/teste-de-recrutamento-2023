<?php

namespace App\Models\Account;

use Core\Engine\Model;

class Registro extends Model
{
    public function create($firstname, $lastname, $email, $password, $telephone)
    {
        $createUser = $this->db->query("
            INSERT INTO customer (firstname, lastname, email, password, telephone) VALUES ('$firstname', '$lastname', '$email', '$password', '$telephone');
        ");

        $id = $this->db->getLastId();

        return $id;
        
    }

    public function login($email, $password)
    {
       return $this->db->query("
            SELECT customer_id, email, password FROM customer WHERE email='$email' AND password='$password'
        ");

    }
}
