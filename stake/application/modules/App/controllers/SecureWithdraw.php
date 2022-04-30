<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class secureWithdraw extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
        date_default_timezone_set('Asia/Kolkata');
        // $this->api_token = "165067167510983";
        $this->api_token = '217702333300596'; /// OLD JOLO LAST WORKING ProSquire

        $this->DMT_URL = 'http://services.apiscript.in/dmt';
        $this->API_USERNAME = 'APIPU10808373';
        $this->API_PASSWORD = '923490';
        $this->token = '2150-602673f17d143-752386';
        $this->email_id = 'primewallet224@gmail.com';
        // $this->token = '7057-602675e65d5c8-878383';
    }

    public function index(){
    	echo ('undefined URL');
    }

    public function addBeneficiary(){
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,name,phone,netbanking,email');
            $beneficiaryCount = $this->User_model->get_single_record('tbl_add_beneficiary', array('user_id' => $this->session->userdata['user_id']), 'count(id) as ids');
            // if($beneficiaryCount['ids'] <= 1){
            //     $response['status'] = 0;
                if ($this->input->server('REQUEST_METHOD') == 'POST') {
                    $data = $this->security->xss_clean($this->input->post());
                    $this->form_validation->set_rules('beneficiary_name', 'Beneficiary Name', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('beneficiary_account_no', 'Beneficiary Account Number', 'trim|required|numeric|xss_clean');
                    $this->form_validation->set_rules('beneficiary_ifsc', 'IFSC Code', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('beneficiary_mobile', 'Beneficiary Mobile', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('beneficiary_bank', 'Beneficiary Bank Name', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('beneficiary_branch', 'Beneficiary Bank Branch', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('otp', 'OTP', 'trim|required|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                        if($data['otp'] == $_SESSION['verification_otp'] && !empty($_SESSION['verification_otp'])){

                            $beneficiary_account_no = $this->User_model->get_single_record('tbl_add_beneficiary', array('user_id' => $this->session->userdata['user_id'], 'beneficiary_account_no' => $data['beneficiary_account_no']), 'beneficiary_account_no');
                            //if(empty($beneficiary_account_no['beneficiary_account_no'])){
                                $add_beneficiary = array('user_id' => $this->session->userdata['user_id'], 'beneficiary_name' => $data['beneficiary_name'], 'beneficiary_account_no' => $data['beneficiary_account_no'], 'beneficiary_ifsc' => $data['beneficiary_ifsc'], 'beneficiary_mobile' => $data['beneficiary_mobile'], 'account_ifsc' => $data['beneficiary_account_no'].'_'.$data['beneficiary_ifsc'], 'beneficiary_bank' => $data['beneficiary_bank'], 'beneficiary_branch' => $data['beneficiary_branch']);
                                $run = $this->User_model->add('tbl_add_beneficiary', $add_beneficiary);
                                if($run){
                                    $this->session->set_flashdata('message', 'Beneficiary Added Successfully!');
                                }else{
                                    $this->session->set_flashdata('message', 'ERROR:: While addeding Beneficiary!');
                                }
                            // }else{
                            //     $this->session->set_flashdata('message', 'ERROR:: This beneficiary is already added!');
                            // }
                        }else{
                            $this->session->set_flashdata('message', 'Please enter correct OTP');
                        }

                    }
                }
            // }else{
            //     $response['status'] = 1;
            // }
            $this->load->view('addBeneficiary', $response);
        } else {
            redirect('App/User/login');
        }
    }


    public function beneficiaryList(){
        if (is_logged_in()) {
            $response['beneficiary'] = $this->User_model->get_records('tbl_add_beneficiary', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('beneficiaryList', $response);
        } else {
            redirect('App/User/login');
        }
    }


    public function withdrawAmount($beneficiry_id){
        if (is_logged_in()) {
            // die();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['admin'] = $this->User_model->get_single_record('tbl_admin', array('user_id' => 'admin'), 'withdraw_status');
            //$response['pool'] = $this->User_model->get_single_record('tbl_pool1', 'user_id = "' . $this->session->userdata['user_id'] . '"', '*');
            $response['beneficiary_id'] = $beneficiry_id;
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('otp', 'OTP', 'trim|required|xss_clean');
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('master_key', 'Master Key', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $checkBeneficary = $this->User_model->get_single_record('tbl_add_beneficiary', array('user_id' => $this->session->userdata['user_id'], 'account_ifsc' => $beneficiry_id), '*');
                    if(!empty($checkBeneficary)){
                        if($data['otp'] == $_SESSION['verification_otp'] && !empty($_SESSION['verification_otp'])){
                            // $user_id = $data['user_id'];
                            $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                            $kyc_status = $this->User_model->get_single_record('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), '*');
                            $withdraw_amount = $this->input->post('amount');
                            // $winto_user_id = $this->input->post('user_id');
                            $master_key = $this->input->post('master_key');
                            $balance = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '" AND type != "recharge_income"', 'ifnull(sum(amount),0) as balance');
                            $directs = $this->User_model->get_single_record('tbl_users', ' sponser_id = "' . $this->session->userdata['user_id'] . '" AND paid_status > 0', 'count(id) as ids');
                            $today_money = $this->User_model->get_single_record('tbl_money_transfer', ' user_id = "' . $this->session->userdata['user_id'] . '" AND (status = "SUCCESS" OR status = "ACCEPTED") and date(created_at) = date(now())', '*');
                            if(empty($today_money)){
                                if ($withdraw_amount >= 500 && $withdraw_amount <= 15000) {
                                    //if($directs['ids'] >= 2){
                                        if ($withdraw_amount % 500 == 0) {
                                            if ($balance['balance'] >= $withdraw_amount) {
                                                if ($user['master_key'] == $master_key AND $checkBeneficary['account_ifsc'] != '6244482379_IDIB000R072') {
                                                    // if($kyc_status['kyc_status'] == 2){
                                                        // $transfer_amount = (round($data['amount'] * 85 / 100) - 10); // 10% IMPS charges including admin+tds
                                                        // $transfer_amount = (round($data['amount']));
                                                        $tds = ($data['amount']*0);
                                                        $adminCharges = ($data['amount']*0);
                                                        $transfer_amount = (round($data['amount'] *100/ 100) - 14);
                                                        $myorderid = $this->generate_order_id();
                                                        $ch = curl_init();
                                                        $timeout = 61;
                                                        $b = explode('_',$beneficiry_id);
                                                        $callBackUrl = base_url('App/SecureWithdraw/callBackUrl');
                                                        $paramList = array('apikey' => $this->api_token,'mobileno' => $checkBeneficary['beneficiary_mobile'], 'beneficiary_account_no' => $checkBeneficary['beneficiary_account_no'], 'beneficiary_ifsc' => $checkBeneficary['beneficiary_ifsc'], 'amount' => $transfer_amount, 'orderid' => $myorderid, 'purpose' => 'BONUS', 'remarks' => title, 'callbackurl' => $callBackUrl);
                                                        //print_r($paramList);
                                                        $jsondata = $this->curlSetup($paramList);
                                                        if(!empty($jsondata)){
                                                            if($jsondata['status'] != 'FAILED'){
                                                                $DirectIncome = array(
                                                                        'user_id' => $this->session->userdata['user_id'],
                                                                        'amount' => - $withdraw_amount,
                                                                        'type' => 'bank_transfer',
                                                                        'description' => 'Bank Transfer',
                                                                    );
                                                                    $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                                                }

                                                            if($jsondata['status'] == 'ACCEPTED' || $jsondata['status'] == 'SUCCESS'){
                                                                $transactionArr = array(
                                                                    'user_id' => $this->session->userdata['user_id'],
                                                                    'beneficiaryid' => $jsondata['beneficiaryid'],
                                                                    'amount' => $transfer_amount,
                                                                    'status' => $jsondata['status'],
                                                                    'joloorderid' => $jsondata['txid'],
                                                                    'time' => $jsondata['time'],
                                                                    'desc' => $jsondata['desc'],
                                                                    'orderid' => $myorderid,
                                                                    'payable_amount' => $withdraw_amount,
                                                                    'tds' => $tds,
                                                                    'admin_charges' => $adminCharges,
                                                                );
                                                                $this->User_model->add('tbl_money_transfer', $transactionArr);
                                                                $message = 'Dear '.$user['name'].' your withdrawal Rs.'.$withdraw_amount.' have been successful deposit into your account by '.title.'. Thanks';
                                                                //notify_user($this->session->userdata['user_id'],$message);
                                                                // $this->session->set_flashdata('message', 'Transaction Completed Successfully');
                                                                $this->session->set_flashdata('message', $jsondata['desc']);
                                                            }else{
                                                                if($jsondata['error'] == 'Insufficient API balance'){
                                                                    $this->session->set_flashdata('message', 'Your Bank not responding . please try after 2 hrs!');
                                                                }else{
                                                                    $this->session->set_flashdata('message', $jsondata['error']);
                                                                }
                                                            }

                                                        }else{
                                                            $this->session->set_flashdata('message', 'Api Not Responding Please Try Again');
                                                            // $countxx="0";//fake
                                                        }
                                                    // }else{
                                                    //     $this->session->set_flashdata('message', 'You KYC is not approved,Please contact Admin');
                                                    // }
                                                } else {
                                                    $this->session->set_flashdata('message', 'Invalid Master Key');
                                                }
                                            } else {
                                                $this->session->set_flashdata('message', 'Insuffcient Balance');
                                            }
                                        } else {
                                            $this->session->set_flashdata('message', 'Withdraw Amount is multiple of 500');
                                        }
                                    // } else {
                                    //     $this->session->set_flashdata('message', 'Withdraw Two directs required!');
                                    // }
                                } else {
                                    $this->session->set_flashdata('message', 'Minimum Withdrawal Amount is Rs 500');
                                }
                            }else{
                                $this->session->set_flashdata('message', 'You Can Withdraw Only Once in a Day');
                            }
                        }else{
                            $this->session->set_flashdata('message', 'Please enter correct OTP');
                        }
                    }else{
                        $this->session->set_flashdata('message', 'Beneficiary ID invalid');
                    }
                } else {
                    $this->session->set_flashdata('message', 'erorrrrr');
                }
            }
			$response['withdraw'] = '500 & multiple Rs. 500'; //enter minimum amount here to display on front
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '" and type != "recharge_income"', 'ifnull(sum(amount),0) as balance');
            $this->load->view('withdrawAmount', $response);
        } else {
            redirect('App/User/login');
        }
    }

    public function transferMoney(){
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                // $this->form_validation->set_rules('otp', 'OTP', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('master_key', 'Master Key', 'trim|required|xss_clean');
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $transferUser = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id'], 'paid_status >' => 0), 'id,user_id');
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                    $sum = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount), 0) as balance');
                    $check = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id'], 'type' => 'transfer_income', 'amount <=' => 0), 'count(id) as ids');
                    if($user['user_id'] != $transferUser['user_id']){
                        if(!empty($user['user_id'])){
                            if(!empty($transferUser['user_id'])){
                                if($data['master_key'] == $user['master_key']){
                                    // if($data['otp'] == $_SESSION['otp'] && !empty($_SESSION['otp'])){
                                   // if($check['ids'] == 0){
                                        if ($data['amount'] >= 200 && $data['amount'] <= 2000) {
                                            if($sum['balance'] >= $data['amount'] AND $data['amount'] > 0 AND $sum['balance'] >= 200){
                                                $debitIncome = ['user_id' => $this->session->userdata['user_id'], 'amount' => -$data['amount'], 'type' => 'transfer_income', 'description' => 'Transfer income to '.$transferUser['user_id'].''];
                                                $this->User_model->add('tbl_income_wallet', $debitIncome);
                                                $creditIncome = ['user_id' => $transferUser['user_id'], 'amount' => $data['amount'], 'type' => 'transfer_income', 'description' => 'Received income from '.$user['user_id'].''];
                                                $this->User_model->add('tbl_income_wallet', $creditIncome);
                                                $this->session->set_flashdata('message', 'Money Transfer Successfully.');
                                            }else {
                                                $this->session->set_flashdata('message', 'Insuffcient Balance');
                                            }
                                        }else {
                                            $this->session->set_flashdata('message', 'ERROR:: Transfer Amount is multiple of 200 & maximum 2000');
                                        }
                                    // }else{
                                    //     $this->session->set_flashdata('message', 'ERROR:: Please try Tomorrow!');
                                    // }
                                    // }else{
                                    //     $this->session->set_flashdata('message', 'ERROR:: OTP not matched!');
                                    // }
                                }else{
                                    $this->session->set_flashdata('message', 'ERROR:: Txn Password Not Matched!');
                                }
                            }else{
                                $this->session->set_flashdata('message', 'ERROR:: Transfer User ID Not Found!');
                            }
                        }else{
                            $this->session->set_flashdata('message', 'ERROR:: Session ID not matched!');
                        }
                    }else{
                        $this->session->set_flashdata('message', 'ERROR:: You can not transfer income to own ID!');
                    }
                }else {
                    $this->session->set_flashdata('message', 'ERROR:: Validation not matched!');
                }
            }
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '" and type != "recharge_income"', 'ifnull(sum(amount),0) as balance');
            $this->load->view('transferAmount', $response);
        } else {
            redirect('App/User/login');
        }
    }


    private function generate_order_id() {
        $order_id = rand(100000000, 999999999);
        $order = $this->User_model->get_single_record('tbl_money_transfer', array('orderid' => $order_id), 'orderid');
        if (!empty($order)) {
            return $this->generate_order_id();
        } else {
            return $order_id;
        }
    }


    private function curlSetup($paramList){
        if(!empty($paramList)){
            $apikey= $this->api_token;
            // $userid= $this->api_user_id;
            // $headerstring = "$userid|$apikey";
            // $hashedheaderstring = hash("sha512", $headerstring);
        	$paramLists = $paramList;
        	$payload = json_encode($paramLists, true);
        	$url = "http://13.127.227.22/freeunlimited/v3/transfer.php";
        	$header= array('Content-Type:application/json');
        	$ch = curl_init($url);
        	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        	curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        	$response = curl_exec ($ch);
        	$err = curl_error($ch);
        	curl_close($ch);
        	return json_decode($response, true);
        }
    }




    public function callBackUrl(){
        //status=SUCCESS&operatortxnid=9001110002&joloorderid=Z123456789012345&userorderid=TEST123456
        $data = array();
        $res = array();
        $data['status'] = $this->input->post('status');
        $data['operatortxnid'] = $this->input->post('operatortxnid');
        $data['joloorderid'] = $this->input->post('joloorderid');
        $data['userorderid'] = $this->input->post('userorderid');
        $res = $this->User_model->update('tbl_money_transfer', array('orderid' => $data['userorderid']), $data);
        if($res){
            if($data['status'] == 'Failure'){
                $transaction = $this->User_model->get_single_record('tbl_money_transfer', array('orderid' => $data['userorderid']), '*');
                $DirectIncome = array(
                    'user_id' => $transaction['user_id'],
                    'amount' => $transaction['payable_amount'],
                    'type' => 'bank_transfer',
                    'description' => 'Failed Bank Transaction',
                );
                $this->User_model->add('tbl_income_wallet', $DirectIncome);
            }
            $res['status'] = 'SUCCESS';
            $res['message'] = 'Request Updated Successfully';
        }else{
            $res['status'] = 'FAILED';
            $res['message'] = 'Error While Updating Request';
        }
        echo json_encode($res);
    }


    ///// Apiscript.in Withdraw api (SK) ////

    public function expressWithdraw($beneficiry_id){
        if (is_logged_in()) {

            $beneficiry_id = trim(addslashes($beneficiry_id));
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['admin'] = $this->User_model->get_single_record('tbl_admin', array('user_id' => 'admin'), 'withdraw_status');
            $response['beneficiary_id'] = $beneficiry_id;
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                // die('');
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('otp', 'OTP', 'trim|required|xss_clean');
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('master_key', 'Master Key', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    if($data['otp'] == $_SESSION['otp'] && !empty($_SESSION['otp'])){
                    $checkBeneficary = $this->User_model->get_single_record('tbl_add_beneficiary', array('user_id' => $this->session->userdata['user_id'], 'account_ifsc' => $beneficiry_id), '*');
                    if(!empty($checkBeneficary)){
                        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                        $kyc_status = $this->User_model->get_single_record('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), '*');
                        $withdraw_amount = $this->input->post('amount');
                        $master_key = $this->input->post('master_key');
                        $balance = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '" AND type != "recharge_income"', 'ifnull(sum(amount),0) as balance');
                        $directs = $this->User_model->get_single_record('tbl_users', ' sponser_id = "' . $this->session->userdata['user_id'] . '" AND paid_status > 0', 'count(id) as ids');
                        $today_money = $this->User_model->get_single_record('tbl_money_transfer', ' user_id = "' . $this->session->userdata['user_id'] . '" AND (status = "Success" OR status = "Pending") and date(created_at) = date(now())', '*');
                        if(empty($today_money)){
                                if ($withdraw_amount >= 250 && $withdraw_amount <= 15000) {
                                    if($directs['ids'] >= 2){
                                        if ($withdraw_amount % 250 == 0) {
                                            if ($balance['balance'] >= $withdraw_amount) {
                                                if ($user['master_key'] == $master_key AND $checkBeneficary['account_ifsc'] != '6244482379_IDIB000R072') {
                                                        $tds = ($data['amount']*0.00);
                                                        $adminCharges = ($data['amount']*0.05);
                                                        $transfer_amount = (round($data['amount'] * 95 / 100));
                                                        $myorderid = $this->generate_order_id();
                                                        $ch = curl_init();
                                                        $timeout = 61;
                                                        $bank_info = explode('_',$beneficiry_id);
                                                        // $callBackUrl = base_url('App/SecureWithdraw/callBackUrl');
                                                        // $paramList = array('apikey' => $this->api_token,'mobileno' => $checkBeneficary['beneficiary_mobile'], 'beneficiary_account_no' => $checkBeneficary['beneficiary_account_no'], 'beneficiary_ifsc' => $checkBeneficary['beneficiary_ifsc'], 'amount' => $transfer_amount, 'orderid' => $myorderid, 'purpose' => 'BONUS', 'remarks' => title, 'callbackurl' => $callBackUrl);
                                                        // $jsondata = $this->curlSetup($paramList);
                                                        $url = $this->DMT_URL.'/express_fund_transfer';
                                                        $bodyParam = 'username='.$this->API_USERNAME.'&pwd='.$this->API_PASSWORD.'&account_no='.$bank_info['0'].'&ifsc='.$bank_info['1'].'&amount='.$transfer_amount.'&transfer_mode=IMPS&client_id='.$myorderid.'&token='.$this->get_jwt_token();
                                                        $jsondata = $this->curlExecution($url, $bodyParam);
                                                         //pr($jsondata['array_data']);
                                                        // die('Please Wait');
                                                        if($jsondata['array_data']['error_code'] == 0){
                                                            if($jsondata['array_data']['transaction_details']['status'] != 'Failure'){
                                                                $DirectIncome = array(
                                                                        'user_id' => $this->session->userdata['user_id'],
                                                                        'amount' => - $withdraw_amount,
                                                                        'type' => 'bank_transfer',
                                                                        'description' => 'Bank Transfer',
                                                                    );
                                                                    $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                                                }
                                                            if($jsondata['array_data']['transaction_details']['status'] == 'Success' || $jsondata['array_data']['transaction_details']['status'] == 'Pending'){
                                                                $transaction_details = $jsondata['array_data']['transaction_details'];
                                                                $transactionArr = array(
                                                                    'user_id' => $this->session->userdata['user_id'],
                                                                    'beneficiaryid' => $beneficiry_id,
                                                                    'amount' => $transfer_amount,
                                                                    'status' => $transaction_details['status'],
                                                                    'joloorderid' => $transaction_details['transaction_id'],
                                                                    'time' => date('Y-m-d H:i:s'),
                                                                    'desc' => $jsondata['array_data']['message'],
                                                                    'orderid' => $myorderid,
                                                                    'payable_amount' => $withdraw_amount,
                                                                    'bank_ref_no' => $transaction_details['bank_ref_no'],
                                                                    'service_charge' => $transaction_details['service_charge'],
                                                                    'tds' => $tds,
                                                                    'admin_charges' => $adminCharges,
                                                                );
                                                                $this->User_model->add('tbl_money_transfer', $transactionArr);
                                                                $message = 'Dear '.$user['name'].' your withdrawal Rs.'.$withdraw_amount.' have been successful deposit into your account by '.title.'. Thanks';
                                                                $this->session->set_flashdata('message', $jsondata['array_data']['message']);
                                                            }else{
                                                                if($jsondata['array_data']['error'] == 'Insufficient API balance'){
                                                                    $this->session->set_flashdata('message', 'Your Bank not responding . please try after 2 hrs!');
                                                                }else{
                                                                    $this->session->set_flashdata('message', $jsondata['array_data']['error']);
                                                                }
                                                            }

                                                        }else{
                                                            $this->session->set_flashdata('message', str_replace('Invalid input parameter :', '', $jsondata['array_data']['message']));
                                                        }
                                                } else {
                                                    $this->session->set_flashdata('message', 'Invalid Master Key');
                                                }
                                            } else {
                                                $this->session->set_flashdata('message', 'Insuffcient Balance');
                                            }
                                        } else {
                                            $this->session->set_flashdata('message', 'Withdraw Amount is multiple of 250');
                                        }
                                    } else {
                                        $this->session->set_flashdata('message', 'Withdraw Two directs required!');
                                    }
                                } else {
                                    $this->session->set_flashdata('message', 'Minimum Withdrawal Amount is Rs 250');
                                }
                            }else{
                                $this->session->set_flashdata('message', 'You Can Withdraw Only Once in a Day');
                            }
                    }else{
                        $this->session->set_flashdata('message', 'Beneficiary ID invalid');
                    }
                    }else{
                        $this->session->set_flashdata('message', 'Invaild OTP');
                    }
                } else {
                    $this->session->set_flashdata('message', 'Validation Error');
                }
            }

            $response['withdraw'] = '250 & multiple Rs. 250'; //enter minimum amount here to display on front
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '" and type != "recharge_income"', 'ifnull(sum(amount),0) as balance');
            $this->load->view('expressWithdraw', $response);

        }else {
            redirect('App/User/login');
        }
    }

    public function get_jwt_token() {
        if (is_logged_in()) {
            $secret_key = $this->token;
            $url = 'http://staging.apiscript.in/jwt_encode';
            $bodyParam = 'secret_key='.$secret_key.'&email_id='.$this->email_id;
            $get = $this->curlExecution($url, $bodyParam);
            $data = json_decode($get['response'],true);
            return ($data['encode_token']);
        }else{
            redirect('App/User/login');
        }
    }

    public function expressCallBackUrl(){

        // $data['callbacktest'] = $_POST['dmt_data'];

        //$this->User_model->update('tbl_admin',array('user_id' => 'admin'), $data);
        // $_POST = 'dmt_data=%7B%22transaction_id%22%3A%221%22%2C%22amount%22%3A%22100.00%22%2C%22service_charge%22%3A%225.00%22%2C%22bank_ref_no%0D%0A%22%3A%2282154587887814%22%2C%22status%22%3A%22Success%22%2C%22client_id%22%3A%221%22%7D';
        // parse_str($_POST, $arr);
        // $jsonData = $arr['dmt_data'];
        $json = preg_replace('/[[:cntrl:]]/', '', $_POST['dmt_data']);
       $json_array = json_decode($json, true);
      // print_r($json_array);


        $data = array();
        $res = array();
        $data['status'] = $json_array['status'];
        $data['bank_ref_no'] = $json_array['bank_ref_no'];
        $data['joloorderid'] = $json_array['transaction_id'];
        $data['orderid'] = $json_array['client_id'];
        $res = $this->User_model->update('tbl_money_transfer', array('orderid' => $data['orderid']), $data);
        if($res){
            if($data['status'] == 'Failure'){
                $transaction = $this->User_model->get_single_record('tbl_money_transfer', array('orderid' => $data['orderid']), '*');
                $DirectIncome = array(
                    'user_id' => $transaction['user_id'],
                    'amount' => $transaction['payable_amount'],
                    'type' => 'bank_transfer',
                    'description' => 'Failed Bank Transaction',
                );
                $this->User_model->add('tbl_income_wallet', $DirectIncome);
            }
            $res['status'] = 'Success';
            $res['message'] = 'Request Updated Successfully';
        }else{
            $res['status'] = 'Failure';
            $res['message'] = 'Error While Updating Request';
        }
        echo json_encode($res);


    }

    private function curlExecution($url, $bodyParam) {
        if (is_logged_in()) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => false,
                CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded;charset=UTF-8'),
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_TIMEOUT => 90,
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_POSTFIELDS => $bodyParam,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST'
            ));
            $response = curl_exec($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if ($httpCode != 200) {
                $error_message = curl_error($curl);
                curl_close($curl);
                return array('isError' => true, 'response' => $error_message);
            } else {
                curl_close($curl);
                return array('isError' => false, 'response' => $response,'array_data'=>json_decode($response, true));
            }
        }else{
            redirect('App/User/login');
        }
    }

    public function getOtp()
    {   
        if ($this->input->is_ajax_request()) {
            if ($this->input->server('REQUEST_METHOD') == 'GET') {
                $_SESSION['verification_otp'] = rand(100000, 999999);
                $this->session->mark_as_temp('verification_otp', 300);
                $message = 'You OTP is '.$this->session->userdata['verification_otp'].' (One Time Password), this otp expire in 2 mintues!';
                $message = 'Dear User, Your OTP is '.$this->session->userdata['verification_otp'].' Never share this OTP with anyone, this OTP expire in two minutes. More Info: '.base_url().' From mlmsig';
                notify($this->session->userdata['user_id'],$message, '1201161518339990262', '1207162142573795782');
                if($message){
                    $response['status'] = 1;
                    
                }else{
                    $response['status'] = 0;
                }
            }
        }else{
            $response['status'] = 0;
        }

        echo json_encode($response);
    }

}
