<?php

namespace App\Controllers\Account;

use Core\Engine\Controller;
use Core\Engine\Session;
use DateTime;

class Seller extends Controller
{
    private function loader()
    {
        $this->load->model('account/balance');
        $this->load->model('account/history');
        $this->load->model('account/product');
        $this->load->model('account/transaction');
        $this->load->model('account/history_type');
        $this->load->helper('currency');
    }

    public function logout()
    {
        unset($_SESSION['customer_id']);
        header('Location: /account/seller');
        exit;
    }

    public function index()
    {
        if (isset($_SESSION['customer_id'])) {
            $this->logged();
        }
        else {
        $this->load->model('account/registro');
        $data['header'] = $this->load->view('account/header');
        $data['footer'] = $this->load->view('account/footer');
        $this->response->setOutput(
            $this->load->view('account/tabs/login', $data)
        );       

            if(isset($_REQUEST["email"])) { 
                $email = $_POST["email"];
                $password = md5($_POST["password"]); 

                $createCustomer = $this->model_account_registro->login($email, $password);

                if (!$createCustomer){
                    echo "<script>alert('Login Inválido!');</script>";
                }
                if ($createCustomer) {
                    $_SESSION['customer_id'] = $createCustomer[0]['customer_id'];
                    $this->logged();
                }
            }
        }     
    }

    public function logged()
    {
        $this->loader();
        $this->panel();
    }

    public function getTabs()
    {
        return [
            [
                'label' => 'Painel',
                'link'  => '/account/seller'
            ],
            [
                'label' => 'Produtos',
                'link'  => '/account/seller/products'
            ],
            [
                'label' => 'Contas Bancárias',
                'link'  => '/account/seller/bankaccounts'
            ],
            [
                'label' => 'Transferências',
                'link'  => '/account/seller/transfers'
            ]
        ];
    }

    public function getProductTabs()
    {
        return [
            ['label' => 'Activos'],
            ['label' => 'Vendidos'],
            ['label' => 'Em Análise']
        ];
    }

    private function getBalance()
    {
        $balance = $this->model_account_balance->get($this->session->get('customer_id'));
        $balance['available'] = $this->helper_currency->format($balance['available']);
        $balance['future']    = $this->helper_currency->format($balance['future']);
        $balance['blocked']   = $this->helper_currency->format($balance['blocked']);

        return $balance;
    }

    public function panel()
    {
        $data['selected_tab'] = 1;
        $data['histories'] = $this->model_account_history->getAll();
        $data['balances']  = $this->getBalance();

        foreach ($data['histories'] as &$history) {
            $history['history_type'] = $this->model_account_history_type->getOne($history['history_type_id']);
            $history['transaction']  = $this->model_account_transaction->getOne($history['transaction_id']);

            $history['date_added'] = date_format(date_create($history['date_added']), "d/m/Y");
            @$history['transaction']['value'] = $this->helper_currency->format($history['transaction']['value']);

            if (@$history['transaction']['product_id'])
                $history['transaction']['product'] = $this->model_account_product->getOne($history['transaction']['product_id']);
        }

        $data['tabBody'] = $this->load->view('account/tabs/panel', $data);

        $this->getForm($data);
    }

    public function products()
    {
        $data['selected_tab']         = 2;
        $data['selected_product_tab'] = 1;
        $data['product_tabs']         = $this->getProductTabs();
        $data['tabBody']              = $this->load->view('account/tabs/products', $data);

        $this->getForm($data);
    }

    public function getAccounts() {
        $this->load->model('bank');
        $user = $_SESSION['customer_id'];
        $accounts = $this->model_bank->getAccountsByUser($user);
        #print_r($accounts);

        $table_tr = array_map(function($item) {
            return "
            <tr>
                <td scope='row'>{$item['bank_name']}</td>
                <td>{$item['type_account_name']}</td>
                <td>{$item['agencia']}</td>
                <td>{$item['conta']}</td>
                <td>
                <div class='d-flex justify-content-around'>
                    <button data-bs-toggle='tooltip' data-bs-placement='top' data-bs-title='Tooltip on top' style='height: 37px;' type='button' class='btn btn-dark edit_account' id='{$item['bank_account_id']}'>
                        <i class='fa-sharp fa-solid fa-pen'></i>
                    </button>
                    <button type='button' class='btn btn-dark remove_account' id='{$item['bank_account_id']}'>
                        <i class='fa-solid fa-trash'></i>
                    </button>
                </div>
                </td>
            </tr>";
        }, $accounts);

        $contas = implode("", $table_tr);
        $find = array("");
        $replace = array();
        return str_replace($find,$replace,$contas);
    }    

    public function bankaccounts()
    {
        $data['contas'] = $this->getAccounts();
        $data['selected_tab'] = 3;
        $data['tabBody'] = $this->load->view('account/tabs/bankAccount', $data);
        $this->getForm($data);
    }

    public function getTransfersByUser()
    {
        $this->load->model('transfer');
        $user = $_SESSION['customer_id'];
        $tranfers = $this->model_transfer->getTranfersByUser($user);
        $table_tr = array_map(function($item) {
            $dateTime = new DateTime($item['date']);
            $date = $dateTime->format('d/m/Y');
            $valor = "R$ " . number_format($item['amount'], 2, ',', '.');
            return "
            <tr>
                <td scope='row'>{$item['bank_name']}</td>
                <td>{$valor}</td>
                <td>{$item['status']}</td>
                <td>{$date}</td>
            </tr>";
        }, $tranfers);

        $contas = implode("", $table_tr);
        $find = array("");
        $replace = array();
        return str_replace($find,$replace,$contas); 
    }

    public function transfers()
    {
        $data['tranfers'] = $this->getTransfersByUser();
        $data['selected_tab'] = 4;
        $data['tabBody'] = $this->load->view('account/tabs/transfer', $data);
        $this->getForm($data);
    }

    public function getForm($data)
    {
        $data['title']     = "Área do Vendedor";
        $data['tabs']      = $this->getTabs();
        $data['left_menu'] = $this->load->view('account/leftMenu');
        $data['header'] = $this->load->view('account/header');
        $data['footer'] = $this->load->view('account/footer');
        $data['tranfers'] = $this->getTransfersByUser();

        $this->response->setOutput(
            $this->load->view('account/seller', $data)
        );
    }
}
