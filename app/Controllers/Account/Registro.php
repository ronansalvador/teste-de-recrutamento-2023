<?php

namespace App\Controllers\Account;

use Core\Engine\Controller;

class Registro extends Controller
{
    public function index()
    {
        $this->load->model('account/registro');
        $data['header'] = $this->load->view('account/header');
        $data['footer'] = $this->load->view('account/footer');
        
        $this->response->setOutput(
            $this->load->view('account/forms/registro', $data)
         );

         #$firstname = 'Ronan'; 
         #$lastname = 'Salvador';
         #$email = 'ronansalvador@yahoo.com'; 
         #$password = md5('123456');         
         #$telephone = '11994963639';

         if(isset($_REQUEST["validar"]) && $_REQUEST["validar"] == true) {

            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $password = md5($_POST["password"]);        
            $telephone = $_POST["telephone"];

            $createCustomer = $this->model_account_registro->create($firstname, $lastname, $email, $password, $telephone);

            header('Location: /');
            exit;

           
         }

      
        
         #$createCustomer = $this->model_account_registro->create($firstname, $lastname, $email, $password, $telephone);
         #echo $createCustomer;
    }
}