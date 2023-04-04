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

            $add = $this->model_bank->createAccount($typeAccountId, $bancoId, $user, $agencia, $conta);
            header('Location: /account/seller/bankaccounts');
            exit;
        }

        
        $this->getForm($data);
    }

    public function edit()
    {
        $user = $_SESSION['customer_id'];
        $account = $_GET['account'];
        $this->load->model('bank');
        $checkTanfers = $this->model_bank->checkTransfers($user, $account);

        if (count($checkTanfers) > 0) {
            echo 'não pode alterar';
        }
        else {

            #echo 'ok pode alterar';
            $data['bancos'] = $this->getBanks();
            $data['typeAccount'] = $this->getTypeAccount();
            $editAccount = $this->model_bank->getAccount($account);
            $data['agencia'] = $editAccount[0]['agencia'];
            $data['conta'] = $editAccount[0]['conta'];
            #print_r($editAccount);
            #echo $data['agencia'];            
            $data['left_menu'] = $this->load->view('account/leftMenu');
            $data['header'] = $this->load->view('account/header');
            $data['footer'] = $this->load->view('account/footer');
            #$data['teste'] = 'Ronan teste';

       

            if(isset($_REQUEST["type_account"])) {
                $typeAccount = $_POST["type_account"];
                $banco = $_POST["banco"];
                $user = $_SESSION['customer_id'];
                $agencia = $_POST['agencia'];
                $conta = $_POST['conta'];
                #echo $typeAccount, $banco, $user, $agencia, $conta;
    
                $getBankId = $this->model_bank->getBankByName($banco);
                $bancoId = $getBankId[0]['bank_id'];
    
                $getTypeAccountId = $this->model_bank->getTypeAccountByName($typeAccount);
                $typeAccountId = $getTypeAccountId[0]['type_account_id'];

    
                $edit = $this->model_bank->updateAccount($bancoId, $typeAccountId, $agencia, $conta, $account);
                header('Location: /account/seller/bankaccounts');
                exit;
                
                if (count($edit) > 0) {
                    echo "Conta alterado com sucesso";
                }
            }
    
            $this->response->setOutput(
                $this->load->view('account/forms/editBankAccount', $data)
            );

          
        }
        #print_r($checkTanfers);
        #echo $user, $account;
    }

    public function delete()
    {
        $user = $_SESSION['customer_id'];
        $account = $_GET['account'];
        $this->load->model('bank');
        $checkTanfers = $this->model_bank->checkTransfers($user, $account);

        if (count($checkTanfers) > 0) {
            echo 'não pode alterar';
        }
        else {
            $delete = $this->model_bank->deleteAccount($account);
            header('Location: /account/seller/bankaccounts');
            exit;
            print_r($delete);
        }

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
