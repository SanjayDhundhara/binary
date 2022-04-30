<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email','Binance'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
    }

    public function index(){
        $response['message'] = '';
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id'], 'password' => $data['password']), 'id,user_id,role,name,email,paid_status,disabled');
            if (!empty($user)) {
                if ($user['disabled'] == 0) {
                    $this->session->set_userdata('user_id', $user['user_id']);
                    $this->session->set_userdata('role', $user['role']);
                    redirect('Dashboard/User/');
                } else {
                    $response['message'] = 'This Account Is Blocked Please Contact to Administrator';
                }
            } else {
                $response['message'] = 'Invalid Credentials';
            }
        }
        $this->load->view('main_login', $response);
    }

    public function forgetPassword(){
        $response = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            $user = $this->User_model->get_single_record('tbl_users', ' email = "' . $data['email'] . '"', 'name,user_id,email,password,master_key,phone');
            if (!empty($user)) {
                $message = "Dear " . $user['name'] . ' <p>your User ID ' . $user['user_id'] . '</p><p>  password for Your Account is ' . $user['password'].' </p>Transaction Password '.$user['master_key'];
                $response['message'] = 'Account Detail Sent on Your Email Please check';
                $sms_text = 'Dear ' . $user['name'] . '. Your Account Successfully created. User ID : ' . $user['user_id'] . '. Password :' . $user['password'] . '. Transaction Password:' . $user['master_key'] . '. ' . base_url().'';
                //notify($user['user_id'], $sms_text, $entity_id = '1201161518339990262', $temp_id = '1207161730102098562');
                send_crypto_email($user['email'], 'Security Alert', $message);
                $message = 'Dear  '.$user['name'].', Thanks for Choosing '.title.'. Your New Website Your Id is: '.$user['user_id'].' and Password is: '.$user['password'].' and TXN Password is:  '.$user['master_key'].'

                <br>Thank you<br>'.base_url();
                $this->session->set_flashdata('message', 'Account Details sent on your registered Email');
            } else {
                $this->session->set_flashdata('message', 'Invalid Email');
            }
        }
        $this->load->view('forgot_password', $response);
    }

    public function emptyData(){
        die;
        $this->User_model->delete('tbl_users',['id !=' => 1]);
        $this->User_model->delete('tbl_bank_details ',['id !=' => 1]);
        $this->User_model->delete('tbl_activation_details ',['id !=' => '']);
        $this->User_model->delete('tbl_downline_business',['id !=' => '']);
        $this->User_model->delete('tbl_downline_count',['id !=' => '']);
        $this->User_model->delete('tbl_income_wallet',['id !=' => '']);
        $this->User_model->delete('tbl_sms_counter',['id !=' => '']);
        $this->User_model->delete('tbl_sponser_count',['id !=' => '']);
        $this->User_model->delete('tbl_wallet',['id !=' => '']);
        $this->User_model->delete('tbl_withdraw',['id !=' => '']);
        $userdata = [
            'user_id' => 'admin',
            'password' => 'admin@123',
            'sponser_id' => '',
            'last_left' => 'admin',
            'last_right' => 'admin',
            'left_count' => 0,
            'right_count' => 0,
            'leftPower' => 0,
            'rightPower' => 0,
            'leftBusiness' => 0,
            'rightBusiness' => 0,
            'directs' => 0,
            'name' => 'Administrator',
        ];
        $this->User_model->update('tbl_users',['id' => 1],$userdata);
        $this->User_model->update('tbl_bank_details',['id' => 1],['user_id' => 'admin']);
    }
}
?>