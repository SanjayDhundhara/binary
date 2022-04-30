<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email','Binance'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
    }

    public function index() {
        $response = array();
        $sponser_id = $this->input->get('sponser_id');
        if($sponser_id == ''){
            $sponser_id = '';
        }

        $response['packages'] = $this->User_model->get_records('tbl_package',[],'*');
       
        $response['sponser_id'] = $sponser_id;
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('sponser_id', 'Sponser ID', 'trim|required|xss_clean');
            // $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('Lposition', 'Position', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
               $this->session->set_flashdata('error', validation_errors());
               $this->load->view('register', $response);
            }else{

                $paidReg = false;

                $sponser_id = $this->input->post('sponser_id');
                $phone = $this->input->post('phone');
                $package_invest = $this->input->post('package');
                $response['sponser_id'] = $sponser_id;
                $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), '*');
                $package = $this->User_model->get_single_record('tbl_package',['id' => 1],'*');
                if(!empty($sponser)){
                    $status = $this->input->post('status');
                    $id_number = $this->getUserIdForRegister();
                    $userData['user_id'] =  $id_number;
                    $userData['sponser_id'] = $sponser_id;
                    $userData['name'] = $this->input->post('name');
                    $userData['position'] =$this->input->post('Lposition');
                    $userData['last_left'] = $userData['user_id'];
                    $userData['last_right'] = $userData['user_id'];
                    $userData['phone'] = $this->input->post('phone');
                    // $userData['eth_address'] = $this->input->post('sender');
                    // $userData['tranx_id'] = $this->input->post('txn');
                    // $userData['eth'] = $this->input->post('eth');
                    // $userData['phone'] = $this->input->post('phone');
                    $userData['password'] = rand(100000,999999);//$this->input->post('password');
                    $userData['email'] = $this->input->post('email');
                    $userData['master_key'] = rand(100000,999999);
                    //$walletAdd = $this->walletAddress();
                    // $jsonD = json_decode($walletAdd,true);
                    // $userData['wallet_address'] = !empty($jsonD['account']['address'])?$jsonD['account']['address']:'';
                    // $userData['wallet_private'] = !empty($jsonD['account']['private_key'])?$jsonD['account']['private_key']:''; 
                    if($paidReg == true){
                        $userData['package_id'] = $package['id'];
                        $userData['package_amount'] = $package_invest ;//$package['price'];
                        // $userData['tron_details'] = $this->input->post('receiptdata');

                        $userData['paid_status'] = 1;
                        $userData['topup_date'] = date('Y-m-d H:i:s');
                        $hub_rate = $this->User_model->get_single_record('tbl_admin', ['id' => 1], 'hub_rate');
                        // $userData['hub_price'] = $package_invest/$hub_rate['hub_rate'];
                        // $userData['capping'] = $package['capping'];
                    }
                    if($userData['position'] == 'L'){
                        $userData['upline_id'] = $sponser['last_left'];
                    }else{
                        $userData['upline_id'] = $sponser['last_right'];
                    }
                    $res = $this->User_model->add('tbl_users', $userData);
                    $res = $this->User_model->add('tbl_bank_details',array('user_id' => $userData['user_id'] ));
                    if ($res) {
                        if ($userData['position'] == 'R') {
                            $this->User_model->update('tbl_users', array('last_right' => $userData['upline_id']), array('last_right' => $userData['user_id']));
                            $this->User_model->update('tbl_users', array('user_id' => $userData['upline_id']), array('right_node' => $userData['user_id']));
                        } elseif ($userData['position'] == 'L') {
                            $this->User_model->update('tbl_users', array('last_left' => $userData['upline_id']), array('last_left' => $userData['user_id']));
                            $this->User_model->update('tbl_users', array('user_id' => $userData['upline_id']), array('left_node' => $userData['user_id']));
                        }
                        $this->add_counts($userData['user_id'], $userData['user_id'], 1);
                        $this->add_sponser_counts($userData['user_id'],$userData['user_id'], $level = 1);
                        if($paidReg == true){
                            $this->User_model->update_directs($userData['sponser_id']);

                            $roiMaker = $userData['hub_price']*$package['commision'];
                        
                            $roiArr = array(
                                'user_id' => $userData['user_id'],
                                'amount' => ($roiMaker * $package['days']),
                                'roi_amount' => $roiMaker,
                                'days' => $package['days'],
                                'type' => 'roi_income',
                            );
                            $this->User_model->add('tbl_roi', $roiArr);

                            $directIncome = [
                                'user_id' => $userData['sponser_id'],
                                'amount' => $package_invest*$package['direct_income']/100,
                                'type' => 'direct_income',
                                'description' => 'Direct Income From User '.$userData['user_id'],
                            ];
                            $this->User_model->add('tbl_income_wallet',$directIncome);

                            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $userData['sponser_id']), 'sponser_id,paid_status,package_amount,package_id,directs');
                            
                            $this->level_income($sponser['sponser_id'], $userData['user_id'], $package['level_income'], $package_invest);
                        }
                        $response['message'] = 'Dear ' .$userData['name']. ', Your Account Successfully created. <br>User ID :  ' . $userData['user_id'] . ' <br> Password :' . $userData['password'] . ' <br> Transaction Password:' .$userData['master_key'];
                        // composeMail($userData['email'],'Registration','Registration',$response['message'],$display=false);
                        $sms_text = 'Dear ' . $userData['name'] . '. Your Account Successfully created. User ID : ' . $userData['user_id'] . '. Password :' . $userData['password'] . '. Transaction Password:' . $userData['master_key'] . '. ' . base_url().'';

                        //userMail($userData['email'],'Registration',$sms_text);

                        $this->load->view('success', $response);

                        // $sms_text = 'Dear ' .$userData['name']. ', Your Account Successfully created. User ID :  ' . $userData['user_id'] . ' Password :' . $userData['password'] . ' Transaction Password:' .$userData['master_key'] . base_url();
                        // //sendMail($sms_text,$userData['email']);
                        // $resp['status'] = 'success';
                        // $resp['message'] = $sms_text;
                        // echo json_encode($resp);

                        // notify_user($userData['user_id'] , $sms_text);
                        // notify_mail($userData['email'] , $sms_text,'Registration Alert');

                    }else {
                        $this->session->set_flashdata('error', 'Error while Registraion please try Again');
                        $this->load->view('register', $response);
                    }
                }else{
                    $this->session->set_flashdata('error', "Please enter valid Sponsor ID.");
                    $this->load->view('register', $response);
                }
            }
        } else {
            $this->load->view('register', $response);
        }
        
    }

    public function indexAjax() {
        $response = array();
        $sponser_id = $this->input->get('sponser_id');
        if($sponser_id == ''){
            $sponser_id = '';
        }
        $response['packages'] = $this->User_model->get_records('tbl_package',[],'*');
        $response['csrt'] =  $this->security->get_csrf_hash();

        $addressIsAlready = $this->User_model->get_single_record('tbl_users', array('eth_address' => $this->input->post('wallet_address')), '*');
        if(!empty($addressIsAlready)){
            $response['status'] = 'fail';
            $response['msg'] = 'Account is already Exist.';
            echo json_encode($response,true);
            return;
        }

        $response['sponser_id'] = $sponser_id;
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('sponser_id', 'Sponser ID', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
               $this->session->set_flashdata('error', validation_errors());
               $this->load->view('register', $response);
            }else{

                $paidReg = false;

                $sponser_id = $this->input->post('sponser_id');
                $phone = $this->input->post('phone');
                $package_invest = $this->input->post('package');
                $response['sponser_id'] = $sponser_id;
                $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), '*');
                $package = $this->User_model->get_single_record('tbl_package',['id' => 1],'*');
                if(!empty($sponser)){
                    $status = $this->input->post('status');
                    $id_number = $this->getUserIdForRegister();
                    $userData['user_id'] =  $id_number;
                    $userData['sponser_id'] = $sponser_id;
                    // $userData['name'] = $this->input->post('name');
                    $userData['eth_address'] = $this->input->post('wallet_address');
                    // $userData['phone'] = $this->input->post('phone');
                    $userData['password'] = rand(100000,999999);//$this->input->post('password');
                    // $userData['email'] = $this->input->post('email');
                    $userData['master_key'] = rand(100000,999999);

                    if($paidReg == true){
                        $userData['package_id'] = $package['id'];
                        $userData['package_amount'] = $package_invest ;//$package['price'];

                        $userData['paid_status'] = 1;
                        $userData['topup_date'] = date('Y-m-d H:i:s');
                        $hub_rate = $this->User_model->get_single_record('tbl_admin', ['id' => 1], 'hub_rate');
                        $userData['hub_price'] = $package_invest/$hub_rate['hub_rate'];
                        $userData['capping'] = $package['capping'];
                    }
                    $res = $this->User_model->add('tbl_users', $userData);
                    $res = $this->User_model->add('tbl_bank_details',array('user_id' => $userData['user_id'] ));
                    if ($res) {
                       
                        $this->add_sponser_counts($userData['user_id'],$userData['user_id'], $level = 1);
                        if($paidReg == true){
                            $this->User_model->update_directs($userData['sponser_id']);

                            $roiMaker = $userData['hub_price']*$package['commision'];
                        
                            $roiArr = array(
                                'user_id' => $userData['user_id'],
                                'amount' => ($roiMaker * $package['days']),
                                'roi_amount' => $roiMaker,
                                'days' => $package['days'],
                                'type' => 'roi_income',
                            );
                            $this->User_model->add('tbl_roi', $roiArr);

                            $directIncome = [
                                'user_id' => $userData['sponser_id'],
                                'amount' => $package_invest*$package['direct_income']/100,
                                'type' => 'direct_income',
                                'description' => 'Direct Income From User '.$userData['user_id'],
                            ];
                            $this->User_model->add('tbl_income_wallet',$directIncome);

                            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $userData['sponser_id']), 'sponser_id,paid_status,package_amount,package_id,directs');
                            
                            $this->level_income($sponser['sponser_id'], $userData['user_id'], $package['level_income'], $package_invest);
                        }

                        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $userData['user_id']), 'id,user_id,role,name,email,paid_status,disabled');

                        $this->session->set_userdata('user_id', $user['user_id']);
                        $this->session->set_userdata('role', $user['role']);

                        $response['msg'] = 'Dear , Your Account Successfully created. <br>User ID :  ' . $userData['user_id'] . ' <br> Password :' . $userData['password'] . ' <br> Transaction Password:' .$userData['master_key'];

                        //composeMail($userData['email'],'Registration','Registration',$response['msg'],$display=false);

                        $response['status'] = 'success';
                        echo json_encode($response, true);
                        return;
                    }else {
                        $response['status'] = 'fail';
                        $response['msg'] = 'Error while Registraion please try Again';
                        echo json_encode($response, true);
                        return;
                    }
                }else{
                    $response['status'] = 'fail';
                    $response['msg'] = 'Please enter valid Sponsor ID.';
                    echo json_encode($response, true);
                    return;
                }
            }
        } else {
            $response['status'] = 'fail';
            $response['msg'] = 'Opps! something went wrong. Please try again.';
            echo json_encode($response, true);
            return;
        }
        
    }


    public function migrateData()
    {
        $users = $this->User_model->get_records('oxbin', 'user_id != "OX" ORDER by created_at ASC', '*');
        foreach ($users as $key => $user) {
            $userData['user_id'] =  $user['user_id'];
            $userData['sponser_id'] = $user['sponser_id'];
            $userData['name'] = $user['name'];
            $userData['phone'] = $user['phone'];
            $userData['password'] = $user['password'];
            $userData['email'] = $user['email'];
            $userData['master_key'] = $user['master_key'];
            $userData['disabled'] = $user['disabled'];
            $userData['upi_address'] = $user['upi_address'];
            // $walletAdd = $this->walletAddress();
            // $userData['wallet_address'] = !empty($jsonD['account']['address'])?$jsonD['account']['address']:'';
            // $userData['wallet_private'] = !empty($jsonD['account']['private_key'])?$jsonD['account']['private_key']:'';
            pr($userData);
            $res = $this->User_model->add('tbl_users', $userData);


            $res = $this->User_model->add('tbl_bank_details',['user_id' => $userData['user_id'], 'bank_account_number' => $user['bank_account_number'], 'bank_name' => $user['bank_name'], 'ifsc_code' => $user['ifsc_code'], 'upi_address' => $user['upi_address']]); 
            
            $this->add_sponser_counts($user['user_id'], $user['user_id'] , $level = '1');
        }
    }

    private function walletAddress(){
        $curl = curl_init();

           curl_setopt_array($curl, array(
             CURLOPT_URL => 'http://18.216.195.54:3490/get_bep20_address',
             CURLOPT_RETURNTRANSFER => true,
             CURLOPT_ENCODING => '',
             CURLOPT_MAXREDIRS => 10,
             CURLOPT_TIMEOUT => 0,
             CURLOPT_FOLLOWLOCATION => true,
             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
             CURLOPT_CUSTOMREQUEST => 'GET',
           ));

           $response = curl_exec($curl);

           curl_close($curl);
           return $response;
        //    echo $response;
           

   }

    private function getUserIdForRegister() {
        $user_id = 'Z'.rand(10000,99999);
        $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'user_id,name');
        if (!empty($sponser)) {
            return $this->getUserIdForRegister();
        } else {
            return $user_id;
        }
    }

    private function add_sponser_counts($user_name, $downline_id , $level) {
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

    private function add_counts($user_name, $downline_id, $level) {
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'upline_id , position,user_id');
        if (!empty($user)) {
            if ($user['position'] == 'L') {
                $count = array('left_count' => ' left_count + 1');
                $c = 'left_count';
            } else if ($user['position'] == 'R') {
                $c = 'right_count';
                $count = array('right_count' => ' right_count + 1');
            } else {
                return;
            }
            $this->User_model->update_count($c, $user['upline_id']);
            $downlineArray = array(
                'user_id' => $user['upline_id'],
                'downline_id' => $downline_id,
                'position' => $user['position'],
                'created_at' => date('Y-m-d h:i:s'),
                'level' => $level,
            );
            $this->User_model->add('tbl_downline_count', $downlineArray);
            $user_name = $user['upline_id'];

            if ($user['upline_id'] != '') {
                $this->add_counts($user_name, $downline_id, $level + 1);
            }
        }
    }
}
?>