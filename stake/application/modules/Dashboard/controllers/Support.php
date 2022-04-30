<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user'));
    }

    public function index() {
        if (is_logged_in()) {
            $response = array();
//            $response['requests'] = $this->User_model->get_records('tbl_payment_request', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('chat', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function generateKey(){
        if(is_logged_in()){
            if($this->input->is_ajax_request()){
                $_SESSION['otp'] = rand('111111','999999');
                $otp = $_SESSION['otp'];
                $_SESSION["otp_time"] = time(); 
                $phone = $this->User_model->get_single_record('tbl_users',array('user_id' => $this->session->userdata['user_id']),'phone');
                if(!empty($phone['phone'])){
                    $phone['phone'] = str_replace('+91', '', $phone['phone']);
                    $lenght = strlen($phone['phone']);
                    if($lenght == '10'){
                        $message = 'Your One Time Password is '.$otp.'.Do not share with anyone'; 
                        send_otp($this->session->userdata['user_id'],$message);
                        $response['success'] = 1;
                        $response['message'] = 'One Time Password is send to your registered Mobile Number';
                    }else{
                        $response['success'] = 0;
                        $response['message'] = 'Your registered mobile is not valid,Please update that';
                    }
                }else{
                    $response['success'] = 0;
                    $response['message'] = 'No mobile register for OTP';
                }
                echo json_encode($response);
                exit;
            }else{
                echo 'No direct script allowed';
            }
        }else{
            redirect('Dashboard/User/login');
        }
    }

    public function SubmitQuery() {
        if (is_logged_in()) {
            $message = $this->input->post('message');
            $messageArr = array(
                'user_id' => $this->session->userdata['user_id'],
                'message' => $message,
                'sender' => $this->session->userdata['user_id']
            );
            $res = $this->User_model->add('tbl_support_message', $messageArr);
            if ($res) {
                $data['message'] = 'Message Sent Successfully';
                $data['success'] = 1;
            } else {
                $data['message'] = 'Error while sending message';
                $data['success'] = 0;
            }
            echo json_encode($data);
            exit();
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function UserChat() {
        if (is_logged_in()) {
            $response['messages'] = $this->User_model->user_chat($this->session->userdata['user_id']);
            echo json_encode($response, true);
            exit();
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function ComposeMail() {
        if (is_logged_in()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                    $sendWallet = array(
                    'user_id' => $this->session->userdata['user_id'],
                    'title' => $data['title'],
                    'message' => $data['message'],
                );
                $this->User_model->add('tbl_support_message', $sendWallet);
                $this->session->set_flashdata('message', 'Mail Composed Successfully');
            }
            $this->load->view('compose_mail', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function Inbox() {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Inbox';
            $response['messages'] = $this->User_model->get_records('tbl_support_message', array('user_id' => 'admin'), '*');
            $this->load->view('composed_message', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function Outbox() {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Outbox';
            $response['messages'] = $this->User_model->get_records('tbl_support_message', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('composed_message', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function migrateData(){
        //ini_set ('max_execution_time',0); 
        $cron = $this->User_model->get_single_record('tbl_cron',"date = '".date('Y-m-d')."' and cron_name = 'wallet_history'",'*');
        if(empty($cron)){
            $this->User_model->add('tbl_cron',['cron_name' => 'wallet_history','date' => date('Y-m-d')]);
            $users = $this->User_model->get_records('max_wallet_history_pending',[],'*');
            foreach($users as $user){
                $creditIncome = [
                    'user_id' => $user['userid'],
                    'amount' => $user['amount'],
                    'type' => 'level_income',
                    'description' => 'Level Income From '.$user['type'],
                ];
                $this->User_model->add('tbl_income_wallet2',$creditIncome);
                if($user['status'] == 'Approved'){
                    $debitIncome = [
                        'user_id' => $user['userid'],
                        'amount' => -$user['amount'],
                        'type' => 'withdraw_request',
                        'description' => 'Withdraw Request',
                    ];
                    $this->User_model->add('tbl_income_wallet2',$debitIncome);
                }
                // $checkData = $this->User_model->get_records('max_plan_history',['userid' => $user['wallet_address']],'*');
                // foreach($checkData as $cd){
                    // $month = $cd['type'];
                    // $amount = $cd['amount'];
                    // if($month == 18){
                    //     $percent = 20;
                    //     $finalAmount = $amount + $amount*0.2;
                    // } elseif($month == 24) {
                    //     $percent = 36;
                    //     $finalAmount = $amount + $amount*0.36;
                    // } elseif($month == 36) {
                    //     $percent = 48;
                    //     $finalAmount = $amount + $amount*0.48;
                    // } elseif($month == 48) {
                    //     $percent = 60;
                    //     $finalAmount = $amount + $amount*0.6;
                    // } elseif($month == 12) {
                    //     $percent = 20;
                    //     $finalAmount = $amount + $amount*0.2;
                    // } 
                    // $creditCoin = array(
                    //     'user_id' => $user['user_id'],
                    //     'amount' =>  $amount,
                    //     'token_price' => $cd['amount2'],
                    //     'maturity_amount' => $finalAmount,
                    //     'months' => $month,
                    //     'maturity_date' => date('Y-m-d H:i:s',strtotime($cd['datetime'].'+ '.$month.'months')),
                    //     'created_at' => $cd['datetime'],
                    // );
                    // $this->User_model->add('tbl_stack_wallet', $creditCoin);

                    // $roiMaker = $cd['incomeStake'];
                    // $roiArr = array(
                    //     'user_id' => $user['user_id'],
                    //     'amount' => ($roiMaker * $month),
                    //     'roi_amount' => $roiMaker,
                    //     'days' => $month,
                    //     'total_days' => $month,
                    //     'coin' => $cd['amount'],
                    //     'token_price' => $cd['amount3'],
                    //     'package' => $cd['amount2'],
                    //     'type' => 'roi_income',
                    //     'creditDate' => $cd['datetime'],
                    //     'created_at' => $cd['datetime'],
                    // );
                    //$this->User_model->add('tbl_roi', $roiArr);
                //}
                // $newData = [
                //     'team_business' => $user['team_business'],
                //     'team_business_plan' => $user['team_business_plan'],
                //     'password' => '123456',
                // ];
                // pr($newData);
                //$this->User_model->update('tbl_users',['user_id' => $user['userid']],$newData);
                // $this->User_model->add('tbl_bank_details',['user_id' => $user['userid']]);
                //$this->add_sponser_counts($user['userid'],$user['userid'], $level = 1);
            }
            die('done');
        } else {
            echo 'Cron already started';
        }
    }

    private function add_sponser_counts($user_name, $downline_id, $level) {
        die;
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'sponser_id,user_id');
        if ($user['sponser_id'] != '') {
                $downlineArray = array(
                    'user_id' => $user['sponser_id'],
                    'downline_id' => $downline_id,
                    'position' => '',
                    'level' => $level,
                );
                $this->User_model->add('tbl_sponser_count', $downlineArray);
                $user_name = $user['sponser_id'];
                $this->add_sponser_counts($user_name, $downline_id, $level + 1);
        }
    }

}
