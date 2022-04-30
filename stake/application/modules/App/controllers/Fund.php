<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fund extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user'));
        if(is_logged_in() === false){
            redirect('Dashboard/User/logout');
            exit;
        }
    }

    public function Request_fund() {
        if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->set_userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $check = $this->User_model->get_single_record('tbl_payment_request', array('transaction_id' => $data['txn_id']), '*');
                if(empty($check) && !empty($data['txn_id'])){
                    // $config['upload_path'] = './uploads/';
                    // $config['allowed_types'] = 'gif|jpg|png';
                    // $config['file_name'] = 'payment_slip';
                    // $this->load->library('upload', $config);

                    // if (!$this->upload->do_upload('userfile')) {
                    //     $this->session->set_flashdata('message', $this->upload->display_errors());
                    // } else {
                    //     $fileData = array('upload_data' => $this->upload->data());
                        $reqArr = array(
                            'user_id' => $this->session->userdata['user_id'],
                            'amount' => $data['amount'],
                            'payment_method' => $data['payment_method'],
                            'transaction_id' => $data['txn_id'],
                            //'image' => $fileData['upload_data']['file_name'],
                            'status' => 0,
                        );
                        $res = $this->User_model->add('tbl_payment_request', $reqArr);
                        if ($res) {
                            $this->session->set_flashdata('message', 'Payment Request Submitted Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Submitting Payment Request Please Try Again ...');
                        }
                   // }
                }else {
                    $this->session->set_flashdata('message', 'Error please enter vaild Hash ID.');
                }
            }
            $this->load->view('header', $response);
            $this->load->view('Fund/request_fund', $response);
        } else {
            redirect('App/User/login');
        }
    }

    public function requests() {
        if (is_logged_in()) {
            $response = array();
            $response['requests'] = $this->User_model->get_records('tbl_payment_request', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('requests', $response);
        } else {
            redirect('App/User/login');
        }
    }

    public function transfer_history() {
        if (is_logged_in()) {
            $response = array();
            $response['records'] = $this->User_model->get_records('tbl_wallet', array('user_id' => $this->session->userdata['user_id'], 'type' => 'fund_transfer'), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header', $response);
            $this->load->view('Fund/transfer_history', $response);
            $this->load->view('footer');
        } else {
            redirect('App/User/login');
        }
    }

    public function wallet_ledger() {
        if (is_logged_in()) {
            $response = array();
            $response['records'] = $this->User_model->get_records('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header');
            $this->load->view('wallet_ledger', $response);
            $this->load->view('footer');
        } else {
            redirect('App/User/login');
        }
    }
    public function activation_history() {
        if (is_logged_in()) {
            $response = array();
            $response['records'] = $this->User_model->get_records('tbl_wallet', array('user_id' => $this->session->userdata['user_id'],'type' => 'account_activation'), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id'],'type' => 'account_activation'), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header');
            $this->load->view('wallet_ledger', $response);
            // $this->load->view('footer');
        } else {
            redirect('App/User/login');
        }
    }

    public function upgrade_history() {
        if (is_logged_in()) {
            $response = array();
            $response['records'] = $this->User_model->get_records('tbl_wallet', array('user_id' => $this->session->userdata['user_id'],'type' => 'upgrade_account'), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id'],'amount >' => 100,'type' => 'upgrade_account'), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header');
            $this->load->view('wallet_ledger2', $response);
            // $this->load->view('footer');
        } else {
            redirect('App/User/login');
        }
    }

    public function transfer_fund() {
        if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($data['amount'] >= 20) {
                    if ($data['user_id'] != $this->session->set_userdata['user_id']) {
                        $receiver = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), '*');
                        $sender = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                        if (!empty($receiver)) {
                            if($sender['retopup'] == 0){
                                if ($response['wallet_amount']['wallet_amount'] >= $data['amount']) {
                                    if($sender['master_key'] == $data['trx_pass']){
                                        $senderData = array(
                                            'user_id' => $this->session->userdata['user_id'],
                                            'amount' => -$data['amount'],
                                            'sender_id' => $data['user_id'],
                                            'type' => 'fund_transfer',
                                            'remark' => $data['remark'],
                                        );
                                        $res = $this->User_model->add('tbl_wallet', $senderData);
                                        if ($res) {
                                            $response['wallet_amount']['wallet_amount'] = $response['wallet_amount']['wallet_amount'] - $data['amount'];
                                            $this->session->set_flashdata('message', 'Fund Transferred Successfully');
                                            $receiverData = array(
                                                'user_id' => $data['user_id'],
                                                'amount' => ($data['amount']*100)/100,
                                                'sender_id' => $this->session->userdata['user_id'],
                                                'type' => 'fund_transfer',
                                                'remark' => $data['remark'],
                                            );
                                            $this->User_model->add('tbl_wallet', $receiverData);
                                        } else {
                                            $this->session->set_flashdata('message', 'Error While Transferring Fund Please Try Again ...');
                                        }
                                    } else {
                                        $this->session->set_flashdata('message', 'Invalid transaction password');
                                    }
                                } else {
                                    $this->session->set_flashdata('message', 'Maximum Transfer Amount is ' . $response['wallet_amount']['wallet_amount']);
                                }
                            } else {
                                $this->session->set_flashdata('message', 'Please upgrade your account to continue this facility');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Invalid Receiver Id');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'You Cannot Transfer Amount In Same Account');
                    }
                } else {
                    $this->session->set_flashdata('message', 'Minimun Transfer Amount is 20 ZIL');
                }
            }
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header', $response);
            $this->load->view('Fund/transfer_fund', $response);
        } else {
            redirect('App/User/login');
        }
    }

    public function maintransfer_fund() {
        if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($data['amount'] >= 20) {
                    // if ($data['user_id'] != $this->session->set_userdata['user_id']) {
                       // $receiver = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), '*');
                        // if (!empty($receiver)) {
                            $sender = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                            if ($response['wallet_amount']['wallet_amount'] >= $data['amount']) {
                                if($sender['master_key'] == $data['trx_pass']){
                                    $senderData = array(
                                        'user_id' => $this->session->userdata['user_id'],
                                        'amount' => -$data['amount'],
                                        // 'sender_id' => $data['user_id'],
                                        'type' => 'fund_transfer',
                                        'description' => $data['remark'],
                                    );
                                    $res = $this->User_model->add('tbl_income_wallet', $senderData);
                                    if ($res) {
                                        $response['wallet_amount']['wallet_amount'] = $response['wallet_amount']['wallet_amount'] - $data['amount'];
                                        $this->session->set_flashdata('message', 'Fund Transferred Successfully');
                                        $receiverData = array(
                                            'user_id' => $this->session->userdata['user_id'],
                                            'amount' =>($data['amount']*95)/100,
                                            // 'sender_id' => $this->session->userdata['user_id'],
                                            'type' => 'fund_transfer',
                                            'remark' => $data['remark'],
                                        );
                                        $this->User_model->add('tbl_wallet', $receiverData);
                                    } else {
                                        $this->session->set_flashdata('message', 'Error While Transferring Fund Please Try Again ...');
                                    }
                                } else {
                                    $this->session->set_flashdata('message', 'Invalid transaction password'); 
                                }
                            } else {
                                $this->session->set_flashdata('message', 'Maximum Transfer Amount is ' . $response['wallet_amount']['wallet_amount']);
                            }
                        // } else {
                        //     $this->session->set_flashdata('message', 'Invalid Receiver Id');
                        // }
                    // } else {
                    //     $this->session->set_flashdata('message', 'You Cannot Transfer Amount In Same Account');
                    // }
                } else {
                    $this->session->set_flashdata('message', 'Minimun Transfer Amount is 20 ZIL');
                }
            }
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header', $response);
            $this->load->view('Fund/maintransfer_fund', $response);
        } else {
            redirect('App/User/login');
        }
    }

    public function ewallet_to_ewallet() {
      
        if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->set_userdata['user_id']), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($data['amount'] > 0) {
                    if ($data['user_id'] != $this->session->set_userdata['user_id']) {
                        $receiver = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), '*');
                        if (!empty($receiver)) {
                            if ($response['wallet_amount']['wallet_amount'] >= $data['amount']) {
                                $senderData = array(
                                    'user_id' => $this->session->userdata['user_id'],
                                    'amount' => -$data['amount'],
                                    'sender_id' => $data['user_id'],
                                    'type' => 'fund_transfer',
                                    'remark' => $data['remark'],
                                );
                                $res = $this->User_model->add('tbl_wallet', $senderData);
                                if ($res) {
                                    $response['wallet_amount']['wallet_amount'] = $response['wallet_amount']['wallet_amount'] - $data['amount'];
                                    $this->session->set_flashdata('message', 'Fund Transferred Successfully');
                                    $receiverData = array(
                                        'user_id' => $data['user_id'],
                                        'amount' => ($data['amount']*10)/100,
                                        'sender_id' => $this->session->userdata['user_id'],
                                        'type' => 'fund_transfer',
                                        'remark' => $data['remark'],
                                    );
                                    $this->User_model->add('tbl_wallet', $receiverData);
                                } else {
                                    $this->session->set_flashdata('message', 'Error While Transferring Fund Please Try Again ...');
                                }
                            } else {
                                $this->session->set_flashdata('message', 'Maximum Transfer Amount is ' . $response['wallet_amount']['wallet_amount']);
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Invalid Receiver Id');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'You Cannot Transfer Amount In Same Account');
                    }
                } else {
                    $this->session->set_flashdata('message', 'Minimun Transfer Amount is rs 0');
                }
            }
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header', $response);
            $this->load->view('Fund/transfer_fund', $response);
        } else {
            redirect('App/User/login');
        }
    }
    public function shopping_wallet_transfer() {
      
        if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->set_userdata['user_id']), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($data['amount'] > 0) {
                    if ($data['user_id'] != $this->session->set_userdata['user_id']) {
                        $receiver = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), '*');
                        if (!empty($receiver)) {
                            if ($response['wallet_amount']['wallet_amount'] >= $data['amount']) {
                                $senderData = array(
                                    'user_id' => $this->session->userdata['user_id'],
                                    'amount' => -$data['amount'],
                                    'sender_id' => $data['user_id'],
                                    'type' => 'fund_transfer',
                                    'remark' => $data['remark'],
                                );
                                $res = $this->User_model->add('tbl_wallet', $senderData);
                                if ($res) {
                                    $response['wallet_amount']['wallet_amount'] = $response['wallet_amount']['wallet_amount'] - $data['amount'];
                                    $this->session->set_flashdata('message', 'Fund Transferred Successfully');
                                    $receiverData = array(
                                        'user_id' => $data['user_id'],
                                        'amount' => $data['amount'],
                                        'sender_id' => $this->session->userdata['user_id'],
                                        'type' => 'fund_transfer',
                                        'remark' => $data['remark'],
                                    );
                                    $this->User_model->add('tbl_shopping_wallet', $receiverData);
                                } else {
                                    $this->session->set_flashdata('message', 'Error While Transferring Fund Please Try Again ...');
                                }
                            } else {
                                $this->session->set_flashdata('message', 'Maximum Transfer Amount is ' . $response['wallet_amount']['wallet_amount']);
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Invalid Receiver Id');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'You Cannot Transfer Amount In Same Account');
                    }
                } else {
                    $this->session->set_flashdata('message', 'Minimun Transfer Amount is rs 0');
                }
            }
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header', $response);
            $this->load->view('Fund/transfer_fund', $response);
        } else {
            redirect('App/User/login');
        }
    }
    public function token_wallet_transfer() {
      
        if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->set_userdata['user_id']), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($data['amount'] > 0) {
                    if ($data['user_id'] != $this->session->set_userdata['user_id']) {
                        $receiver = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), '*');
                        if (!empty($receiver)) {
                            if ($response['wallet_amount']['wallet_amount'] >= $data['amount']) {
                                $senderData = array(
                                    'user_id' => $this->session->userdata['user_id'],
                                    'amount' => -$data['amount'],
                                    'sender_id' => $data['user_id'],
                                    'type' => 'fund_transfer',
                                    'remark' => $data['remark'],
                                );
                                $res = $this->User_model->add('tbl_wallet', $senderData);
                                if ($res) {
                                    $response['wallet_amount']['wallet_amount'] = $response['wallet_amount']['wallet_amount'] - $data['amount'];
                                    $this->session->set_flashdata('message', 'Fund Transferred Successfully');
                                    $receiverData = array(
                                        'user_id' => $data['user_id'],
                                        'amount' => $data['amount'],
                                        'sender_id' => $this->session->userdata['user_id'],
                                        'type' => 'fund_transfer',
                                        'remark' => $data['remark'],
                                    );
                                    $this->User_model->add('tbl_token_wallet', $receiverData);
                                } else {
                                    $this->session->set_flashdata('message', 'Error While Transferring Fund Please Try Again ...');
                                }
                            } else {
                                $this->session->set_flashdata('message', 'Maximum Transfer Amount is ' . $response['wallet_amount']['wallet_amount']);
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Invalid Receiver Id');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'You Cannot Transfer Amount In Same Account');
                    }
                } else {
                    $this->session->set_flashdata('message', 'Minimun Transfer Amount is rs 0');
                }
            }
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header', $response);
            $this->load->view('Fund/transfer_fund', $response);
        } else {
            redirect('App/User/login');
        }
    }
    public function all_transactions() {
        if (is_logged_in()) {
            $response = array();
            $response['transactions'] = $this->User_model->get_records('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,amount,type,description,created_at');
            $this->load->view('all_transactions', $response);
        } else {
            redirect('App/User/login');
        }
    }

    public function withdraw_request() {
        if (is_logged_in()) {
            $response = array();
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as total_income');
//            pr($response,true);
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($data['amount'] > 0) {
                    if ($response['balance']['total_income'] >= $data['amount']) {
                        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'otp');
                        if ($user['otp'] == $data['otp']) {

                            $incomeArr = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => -$data['amount'],
                                'type' => 'withdraw_amount',
                                'description' => 'WIthdraw Amount',
                            );
                            $withdrawArr = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => $data['amount'],
                            );
                            $res = $this->User_model->add('tbl_income_wallet', $incomeArr);
                            $this->User_model->add('tbl_withdraw', $withdrawArr);
                            if ($res) {
                                $this->session->set_flashdata('message', 'Withdraw Request Submitted Successfully');
                                $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as total_income');
                            } else {
                                $this->session->set_flashdata('message', 'Error While Requesting Withdraw Please Try Again ...');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Invalid Otp');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Maximum Transfer Amount is $' . $response['balance']['total_income']);
                    }
                } else {
                    $this->session->set_flashdata('message', 'Minimun Withdraw Amount is $0');
                }
            }
            $this->load->view('withdraw_request', $response);
        } else {
            redirect('App/User/login');
        }
    }
    public function withdraw_summary(){
        if (is_logged_in()) {
            $response = array();
            $response['withdraw_transctions'] = $this->User_model->get_records('tbl_withdraw', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as sum');
//            $this->load->view('header', $response);
            $this->load->view('withdraw_summary', $response);
//            $this->load->view('footer');
        } else {
            redirect('App/User/login');
        }
    }

    public function FundRequest(){
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->set_userdata['user_id']), '*');
            $transaction_id = $this->User_model->get_records('tbl_payment_request', array(''), 'transaction_id');
            if($this->input->server("REQUEST_METHOD") == "POST"){
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount','Amount','trim|required');
                $this->form_validation->set_rules('hash_id','Hash ID','trim|required');
                if($this->form_validation->run() != false){
                    if ($transaction_id != $data['hash_id']) {
                        if($data['payment_method'] == 'coinbase'){
                            $this->session->set_tempdata('amount',$data['amount'],300);
                            redirect('App/Fund/coinbaseGateway');
                        }elseif($data['payment_method'] == 'coin_payment'){
                            $this->session->set_tempdata('amount',$data['amount'],300);    
                            redirect('App/Fund/coinpaymentform');
                        }else{
                            redirect('App/User');
                        }
                        
                    }else{
                        $this->session->set_flashdata('message', 'Invalid Hash ID');
                    }
                }
            }
            $this->load->view('header', $response);
            $this->load->view('Fund/coinbase_fund', $response);  
        } else {
            redirect('App/User/login');
        }
    }

    public function coinpaymentform(){
        if (is_logged_in()) {
            if(!empty($this->session->tempdata('amount'))){
                $response['amount'] = $this->session->tempdata('amount');
                $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                $this->load->view('header', $response);
                $this->load->view('Fund/coinpayment_internal',$response);
            }else{
                redirect('App/Fund/FundRequest');
            }
        } else {
            redirect('App/User/login');
        }
    }

    public function coinbaseGateway(){
        if (is_logged_in()) {
            if(!empty($this->session->tempdata('amount'))){
                //$data = $this->security->xss_clean($this->input->post());
                $user_id = $this->session->userdata['user_id'];
                //$package = $this->User_model->get_single_record('tbl_package', array('id' => $id), '*');  
                $userInfo = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*'); 
                $amount = $this->session->tempdata('amount');
                $email = $userInfo['email'];
                $curl = curl_init();
                $params = new stdClass();
                $params->name = $user_id;
                $params->description = 'Fund Request';

                $local_price = new stdClass();
                $local_price->amount = $amount;

                $local_price->currency = 'USD';
                $params->local_price = $local_price;
                $params->pricing_type = 'fixed_price';
                $params->requested_info = ['email'];
                // echo json_encode($params);

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.commerce.coinbase.com/checkouts",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => json_encode($params),
                    CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "X-CC-Api-Key: 45ac6b2e-529d-4d7f-b761-19d1384369d2",
                    "X-CC-Version: 2018-03-22",
                    "Cookie: __cfduid=da062b513a9ad4c1d0c77a2a7d01979841606206538"
                    ),
                ));

                $response = json_decode(curl_exec($curl),true);
                $response['package'] = $amount;
                $this->User_model->add('tbl_coinbase_transactions', ['user_id' => $user_id , 'checkout' => $response['data']['id'],'data' => $amount,'trans_type' => '1']);
                curl_close($curl);
                $response['amount'] = $amount;
                $this->load->view('addBalanceCoinBase',$response);
            }else{
                redirect('App/Fund/FundRequest');
            }
        }else {
            redirect('App/User/login');
        }
    }

    public function withdrawZil(){
        if($this->input->server("REQUEST_METHOD") == "POST"){
            $data = $this->security->xss_clean($this->input->post());
            $this->form_validation->set_rules('amount','Amount','trim|required|numeric');
            $this->form_validation->set_rules('address','Address','trim|required');
            if($this->form_validation->run() != false){
                $checkBalance = $this->User_model->get_single_record('tbl_refferal_wallet',['user_id' => $this->session->userdata['user_id']],'ifnull(sum(amount),0) as balance');
                if($checkBalance['balance'] >= $data['amount']){
                    if($data['amount'] >= 50){
                        $debit = [
                            'user_id' => $this->session->userdata['user_id'],
                            'amount' => -$data['amount'],
                            'type' => 'zilwithdraw_amount',
                            'description' => 'ZIL WIthdraw Amount',
                        ];
                        $this->User_model->add('tbl_refferal_wallet', $debit);

                        $credit = [
                            'user_id' => $this->session->userdata['user_id'],
                            'amount' => $data['amount'],
                            'type' => 'zilwithdraw_amount',
                            'remark' => 'ZIL WIthdraw Amount',
                            'address' => $data['address'],
                        ];
                        $res = $this->User_model->add('tbl_withdrawZil', $credit);
                        if ($res) {
                            $this->session->set_flashdata('message', '<span class ="text-success">Withdraw Request Submitted Successfully</span>');
                        } else {
                            $this->session->set_flashdata('message', '<span class ="text-danger">Error While Requesting Zil Withdraw Please Try Again ...</span>');
                        }
                      
                    } else {
                        $this->session->set_flashdata('message', '<span class ="text-danger">Minimum Withdraw Amount is 50</span>');
                    }
                } else {
                    $this->session->set_flashdata('message', '<span class ="text-danger">Insuffcient Balance</span>');
                }
            }else{
                $this->session->set_flashdata('message','<span class ="text-danger">'.validation_errors().'</span>');
            }
        }
        $response['balance'] = $this->User_model->get_single_record('tbl_refferal_wallet',['user_id' => $this->session->userdata['user_id']],'ifnull(sum(amount),0) as balance');
        $this->load->view('withdrawZil',$response);
    }

}
