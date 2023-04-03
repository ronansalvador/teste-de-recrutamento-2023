<?php

namespace App\Controllers\Account\Seller;

use Core\Engine\Controller;

class BankAccount extends Controller
{
       
    public function getBanks() {
        $this->load->model('bank');
        $banks = $this->model_bank->getAll();
        #print_r($banks);

        $options = array_map(function($item) {
            return "<option id='{$item['bank_id']}' value='{$item['name']}'>{$item['name']}</option>";
        }, $banks);

        $bancos = implode("", $options);
        $find = array("");
        $replace = array();

         return str_replace($find,$replace,$bancos);
    }

    public function getTypeAccount(){
        $this->load->model('bank');
        $typeAccount = $this->model_bank->getTypeAccount();
        $options = array_map(function($item) {
            return "<option id='{$item['type_account_id']}' value='{$item['name']}'>{$item['name']}</option>";
        }, $typeAccount);

        $typeAcount = implode("", $options);
        $find = array("");
        $replace = array();

         return str_replace($find,$replace,$typeAcount);

    }

    public function add()
    {
        
        $this->load->model('bank');
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
          }
        #echo $_SESSION['customer_id'];
        $data['bancos'] = $this->getBanks();
        $data['typeAccount'] = $this->getTypeAccount();
        

        #if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Imprime todas as variáveis recebidas através do formulário
            #print_r($_POST);
          #}
       
        if(isset($_REQUEST["type_account"])) {
            $typeAccount = $_POST["type_account"];
            $banco = $_POST["banco"];
            $user = $_SESSION['customer_id'];
            $agencia = $_POST['agencia'];
            $conta = $_POST['conta'];
            echo $typeAccount, $banco, $user, $agencia, $conta;

            $getBankId = $this->model_bank->getBankByName($banco);
            $bancoId = $getBankId[0]['bank_id'];

            $getTypeAccountId = $this->model_bank->getTypeAccountByName($typeAccount);
            $typeAccountId = $getTypeAccountId[0]['type_account_id'];

            $teste = $this->model_bank->createAccount($typeAccountId, $bancoId, $user, $agencia, $conta);
        }

        
        $this->getForm($data);
    }

    public function getForm($data)
    {
        $data['left_menu'] = $this->load->view('account/leftMenu');
        #$data['teste'] = 'Ronan teste';

        $this->response->setOutput(
            $this->load->view('account/forms/addBankAccount', $data)
        );
    }
}
