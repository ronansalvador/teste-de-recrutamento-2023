<?php

namespace App\Controllers\Account\Seller;

use Core\Engine\Controller;

class BankAccount extends Controller
{

    public function criar_opcao($opcao) {
        $name = $opcao[0]['name'];
        return "<option value=\"$name\">$name</option>";
    }

    public function add()
    {
        $this->load->model('bank');
        $banks = $this->model_bank->getAll();
        #print_r($banks);

        $options = array_map(function($item) {
            return "<option value='{$item['name']}'>{$item['name']}</option>";
        }, $banks);

        $bancos = implode("", $options);
        $find = array("");
        $replace = array();
        $data['bancos'] = str_replace($find,$replace,$bancos);
        #print_r($data['bancos']);


        $data['banco_1'] = $banks[0]['name'];
        $data['banco_2'] = `<option value="saving">Banco 2</option>`;
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
