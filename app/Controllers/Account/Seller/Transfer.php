<?php

namespace App\Controllers\Account\Seller;

use Core\Engine\Controller;

class Transfer extends Controller
{

    public function getTypeAccount($user){
        $this->load->model('transfer');
        $accounts = $this->model_transfer->getAccountByUser($user);
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
            $valor = $_POST['amount'];
            $amount = floatval(str_replace(',', '.', $valor));            
            $account_id = $this->model_bank->getAccountByBankAndUser($bancoId, $user);       
            $account = $account_id['bank_account_id'];           
            $transferId = $this->model_transfer->insertTransfer($user, $account, $amount);
            $transactionId = $this->model_transfer->insertTransaction($user, $transferId, $amount);
            $historyId = $this->model_transfer->insertHistory($transactionId, $user);
        }
        
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
