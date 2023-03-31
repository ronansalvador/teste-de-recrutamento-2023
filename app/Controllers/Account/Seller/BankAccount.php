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
            return "<option value='{$item['name']}'>{$item['name']}</option>";
        }, $banks);

        $bancos = implode("", $options);
        $find = array("");
        $replace = array();

         return str_replace($find,$replace,$bancos);
    }

    public function add()
    {
      
        $data['bancos'] = $this->getBanks();
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
