<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class StagingWithdraw extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
        date_default_timezone_set('Asia/Kolkata');

        $this->DMT_URL = 'http://staging.apiscript.in/dmt';
        $this->API_USERNAME = 'APIPU3227729';
        $this->API_PASSWORD = '117754';
        $this->token = '7057-602675e65d5c8-878383';
        $this->email_id = 'primewallet224@gmail.com';

    }

    public function index(){
    	echo ('undefined URL');
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

    public function getCustomer($mobile_no) {
    	if (is_logged_in()) {
	        echo $url = $this->DMT_URL.'/get_customer';
	        echo $bodyParam = 'username='.$this->API_USERNAME.'&pwd='.$this->API_PASSWORD.'&mobile_no='.$mobile_no.'&gateway=GW1&token='.$this->get_jwt_token();
	        $get = $this->curlExecution($url, $bodyParam);
	        pr($get);
	    }else{
	    	redirect('App/User/login');
	    }
    }

    public function senderRegistration() {
    	if (is_logged_in()) {
    		$response['header'] = 'Account Activation';
    		$user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,name,phone,email,postal_code,first_name,last_name');
    		$sender = $this->User_model->get_single_record('tbl_sender_registration', array('user_id' => $this->session->userdata['user_id']), '*');
    		if(!empty($user)){
    			if(empty($sender)){
			        $url = $this->DMT_URL.'/sender_registration';
			        $bodyParam = 'username='.$this->API_USERNAME.'&pwd='.$this->API_PASSWORD.'&mobile_no='.$user['phone'].'&fname='.$user['first_name'].'&lname='.$user['last_name'].'&pin='.$user['postal_code'].'&gateway=GW2&token='.$this->get_jwt_token();
			        $get = $this->curlExecution($url, $bodyParam);
			        if($get['array_data']['error_code'] == 1){
			        	$msg = (str_replace('Invalid input parameter : ', '', $get['array_data']['message']));
			        	$this->session->set_flashdata('error', $msg);
			        }elseif($get['array_data']['error_code'] == 0){
			        	$msg = (str_replace('Invalid input parameter : ', '', $get['array_data']['message']));
			        	$add = ['user_id' => $this->session->userdata['user_id'], 'sender_profile_id' => $get['array_data']['sender_data']['sender_profile_id'], 'sender_fname' => $get['array_data']['sender_data']['sender_fname'], 'sender_lname' => $get['array_data']['sender_data']['sender_lname'], 'sender_pincode' => $get['array_data']['sender_data']['sender_pincode'], 'sender_mobile_no' => $get['array_data']['sender_data']['sender_mobile_no'], 'transaction_limit' => $get['array_data']['sender_data']['transaction_limit'], 'sender_status' => $get['array_data']['sender_data']['sender_status'], 'created_at' => date('Y-m-d H:i:s')];
			        	$this->User_model->add('tbl_sender_registration', $add);
			        	$this->session->set_flashdata('error', $msg);
			        }
			    }else{
			    	$this->session->set_flashdata('success', 'Enter OTP for Sender Verification!');
			    }
		    }
	        $this->load->view('StagingWithdraw/activateBanking', $response);
	    }else{
	    	redirect('App/User/login');
	    }
    }

    public function resendSenderOtp()
    {
    	if (is_logged_in()) {
    		$user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,name,phone,email,postal_code,first_name,last_name');
    		if(!empty($user)){
    			$url = $this->DMT_URL.'/sender_resend_otp';
		        $bodyParam = 'username='.$this->API_USERNAME.'&pwd='.$this->API_PASSWORD.'&mobile_no='.$user['phone'].'&gateway=GW2&token='.$this->get_jwt_token();
		        $get = $this->curlExecution($url, $bodyParam);
		       	$this->session->set_flashdata('error', $get['array_data']['message']);
		       	redirect('App/StagingWithdraw/senderRegistration');
    		}

    	}else{
	    	redirect('App/User/login');
	    }
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

}