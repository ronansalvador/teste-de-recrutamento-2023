<?php

namespace App\Controllers\Account\Seller;

use Core\Engine\Controller;

class Transfer extends Controller
{

    public function getTypeAccount($user){
        $this->load->model('transfer');
        $accounts = $this->model_transfer->getAccountByUser($user);
        #print_r($accounts);
        $options = array_map(function($item) {
            return "<option id='{$item['bank_account_id']}' value='{$item['bank_name']}'>{$item['bank_name']}</option>";
        }, $accounts);

        $accountsUser = implode("", $options);
        $find = array("");
        $replace = array();

         return str_replace($find,$replace,$accountsUser);

    }

    public function add()
    {   
        $this->load->model('bank');
        $user = $_SESSION['customer_id'];
        $data['accounts'] = $this->getTypeAccount($user);

        if(isset($_REQUEST['bank_account_id'])) {     
            
            $bank_account_id = $_POST['bank_account_id'];
            $getBankId = $this->model_bank->getBankByName($bank_account_id);
            $bancoId = $getBankId[0]['bank_id'];
            $amount = $_POST['amount'];
            $account_id = $this->model_bank->getAccountByBankAndUser($bancoId, $user);       
            $account = $account_id['bank_account_id'];
            echo $bancoId;
            echo $amount;

            $transferId = $this->model_transfer->insertTransfer($user, $account, $amount);
            echo $transferId;
            $transactionId = $this->model_transfer->insertTransaction($user, $transferId, $amount);
            echo $transactionId;

            $historyId = $this->model_transfer->insertHistory($transactionId, $user);
            // inserir dados na tabelo historico
            // faça algo com o $bank_account_id aqui
        }
        #print_r($data['accounts']);
        #echo $user;
        $this->getForm($data);
    }

    public function getForm($data)
    {
        $data['left_menu'] = $this->load->view('account/leftMenu');

        $this->response->setOutput(
            $this->load->view('account/forms/addTransfer', $data)
        );
    }
}
