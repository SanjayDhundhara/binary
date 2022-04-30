<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Activation extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user'));
        date_default_timezone_set('Asia/Kolkata');
        $this->exceptionCase = '';
        if(is_logged_in() === false) {
            redirect('Dashboard/User/logout');
            exit;
        }
    }

     public function index() {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['tokenValue'] = $this->User_model->get_single_record('tbl_token_value',['id' => 1],'amount');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required');
                $this->form_validation->set_rules('package_id', 'Package', 'trim|required|numeric');
                // $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
                // $this->form_validation->set_rules('month', 'Months', 'trim|required|numeric');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = $data['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    $package = $this->User_model->get_single_record('tbl_package', array('id' => $data['package_id']), '*');
                    if (!empty($user)) {
                        //if($user['paid_status'] == 0){
                            if ($wallet['wallet_balance'] >= $package['price']) {
                                $sendWallet = array(
                                    'user_id' => $this->session->userdata['user_id'],
                                    'amount' => -$package['price'],
                                    'type' => 'account_activation',
                                    'remark' => 'Account Activation Deduction for ' . $user_id,
                                );
                                $this->User_model->add('tbl_wallet', $sendWallet);
                                $topupData = array(
                                    'paid_status' => 1,
                                    'package_id' => $package['id'],
                                    'package_amount' => $package['price'],
                                    'total_package' => $user['total_package'] + $package['price'],
                                    'topup_date' => date('Y-m-d H:i:s'),
                                    'capping' => $package['capping'],
                                    'incomeLimit2' => $user['incomeLimit2'] + ($package['price']*3),
                                );
                                $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
                                $activationData = [
                                    'user_id' => $user_id,
                                    'activater' => $this->session->userdata['user_id'],
                                    'package' => $package['price'],
                                    'topup_date' => date('Y-m-d H:i:s'),
                                ];
                                $this->User_model->add('tbl_activation_details',$activationData);
                                $this->User_model->update_directs($user['sponser_id']);
                                $amount = $package['price']/$response['tokenValue']['amount'];
                                // $month = $data['month'];
                                // if($month == 3){
                                //     $percent = 1.25;
                                //     $finalAmount = $amount*1.25;
                                // } elseif($month == 6) {
                                //     $percent = 1.5;
                                //     $finalAmount = $amount*1.5;
                                // } else {
                                //     redirect(base_url());
                                //     exit;
                                // }
                                // $creditCoin = array(
                                //     'user_id' => $user['user_id'],
                                //     'amount' =>  $amount,
                                //     'type' => 'coin_income',
                                //     'description' => 'Coin credited',
                                // );
                                // $this->User_model->add('tbl_coin_wallet', $creditCoin);
                                $roiArr = array(
                                    'user_id' => $user['user_id'],
                                    'amount' => $package['price']*$package['commision']*$package['days'],
                                    'roi_amount' => $package['price']*$package['commision'],
                                    'days' => $package['days'],
                                    'total_days' => $package['days'],
                                    'package' => $package['price'],
                                    'type' => 'roi_income',
                                    'creditDate' => date('Y-m-d'),
                                );
                                $this->User_model->add('tbl_roi', $roiArr);
                                $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), '*');
                                if($sponser['paid_status'] == 1){
                                    // if($sponser['incomeLimit2'] > $sponser['incomeLimit']){
                                    //     $totalCredit = $sponser['incomeLimit'] + ($package['price']*$package['direct_income']);
                                    //     if($totalCredit < $sponser['incomeLimit2']){
                                             $direct_income = ($package['price']*$package['direct_income']);
                                    //     } else {
                                    //         $direct_income = $sponser['incomeLimit2'] - $sponser['incomeLimit'];
                                    //     }

                                        $DirectIncome = array(
                                            'user_id' => $user['sponser_id'],
                                            'amount' => $direct_income,
                                            //'dollar' => $data['amount']*$package['direct_income'],
                                            //'token_price' => $response['tokenValue']['amount'],
                                            'type' => 'direct_income',
                                            'description' => 'Direct Sponser from Activation of Member ' . $user_id,
                                        );
                                        $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                        $this->User_model->update('tbl_users',['user_id' => $user['sponser_id']],['incomeLimit' => ($sponser['incomeLimit'] + $DirectIncome['amount'])]);
                                   // }
                                }
                                        

                                //$this->royaltyAchiever($user['sponser_id'],$package['price']);
                                $this->updateBusiness($user['sponser_id'],'team_business',$package['bv']);
                                $this->updateBusiness($user['sponser_id'],'team_business_plan',$package['price']);
                                $this->level_income($sponser['sponser_id'], $user['user_id'], $package['level_income'],$package['price']);
                                $this->update_business($user['user_id'], $user['user_id'], $level = 1,$package['price'] ,$package['price'], $type = 'topup');
                                //if($sponser['directs'] >= 3){
                                    // $checkPool = $this->User_model->get_single_record($package['products'],['user_id' => $user['user_id']],'*');
                                    // if(empty($checkPool['user_id'])){
                                        //$this->individualPoolEntry($user['user_id'],'tbl_pool1');
                                        //$this->globlePoolEntry($user['user_id'],'tbl_pool');
                                        // $debit = [
                                        //     'user_id' => $user['sponser_id'],
                                        //     'amount' => -10,
                                        //     'type' => 'club_upgradation',
                                        //     'description' => 'Club Upgrdation Deduction',
                                        // ];
                                        // $this->User_model->add('tbl_income_wallet',$debit);
                                    //}
                                //}
                                $message = 'Dear User your account is successfully activated with amount '.$package['price'].' by User '.$this->session->userdata['user_id'];
                                composeMail($user['email'],'Activation','Activation',$message,$display=false);
                                $this->session->set_flashdata('message', '<h3 class = "text-success">Account Activated Successfully </h3>');
                            } else {
                                $this->session->set_flashdata('message', '<h3 class = "text-danger">Insuffcient Balance </h3>');
                            }
                        // } else {
                        //     $this->session->set_flashdata('message', '<h3 class = "text-danger">This Account Already Acitvated </h3>');
                        // }
                    } else {
                        $this->session->set_flashdata('message', '<h3 class = "text-danger">Invalid User ID </h3>');
                    }
                }
            }
            $response['wallet'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
            $response['packages'] = $this->User_model->get_records('tbl_package', array(), '*');
            $this->load->view('activate_account', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }


    public function indexAjax() {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['tokenValue'] = $this->User_model->get_single_record('tbl_token_value',['id' => 1],'amount');
            $response['csrt'] =  $this->security->get_csrf_hash();

                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
                $this->form_validation->set_rules('month', 'Months', 'trim|required|numeric');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = $this->session->userdata['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    $package = $this->User_model->get_single_record('tbl_package', array('id' => 1), '*');
                    if (!empty($user)) {
                        if($data['amount'] >= 10){
                                //if ($user['paid_status'] == 0) {
                                        $sendWallet = array(
                                            'user_id' => $this->session->userdata['user_id'],
                                            'amount' => -$data['amount'],
                                            'type' => 'account_activation',
                                            'remark' => 'Account Activation Deduction for ' . $user_id,
                                        );
                                        $this->User_model->add('tbl_wallet', $sendWallet);
                                        $topupData = array(
                                            'paid_status' => 1,
                                            'package_id' => 1,
                                            'package_amount' => $data['amount'],
                                            'total_package' => $user['total_package'] + $data['amount'],
                                            'topup_date' => date('Y-m-d H:i:s'),
                                            'capping' => $data['amount'],
                                            'incomeLimit2' => $user['incomeLimit2'] + ($data['amount']*2.2),
                                        );
                                        $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
                                        $activationData = [
                                            'user_id' => $user_id,
                                            'activater' => $this->session->userdata['user_id'],
                                            'package' => $data['amount'],
                                            'topup_date' => date('Y-m-d H:i:s'),
                                        ];
                                        $this->User_model->add('tbl_activation_details',$activationData);
                                            $this->User_model->update_directs($user['sponser_id']);
                                            $amount = $data['amount']/$response['tokenValue']['amount'];
                                            $month = $data['month'];
                                            if($month == 3){
                                                $percent = 1.25;
                                                $finalAmount = $amount*1.25;
                                            } elseif($month == 6) {
                                                $percent = 1.5;
                                                $finalAmount = $amount*1.5;
                                            } else {
                                                redirect(base_url());
                                                exit;
                                            }
                                            $creditCoin = array(
                                                'user_id' => $user['user_id'],
                                                'amount' =>  $finalAmount,
                                                'type' => 'coin_income',
                                                'description' => 'Coin credited',
                                            );
                                            $this->User_model->add('tbl_coin_wallet', $creditCoin);
                                            $roiArr = array(
                                                'user_id' => $user['user_id'],
                                                'amount' => $finalAmount,
                                                'roi_amount' => $finalAmount/($month*30),
                                                'days' => $month*30,
                                                'total_days' => $month*30,
                                                'package' => $data['amount'],
                                                'type' => 'roi_income',
                                                'creditDate' => date('Y-m-d'),
                                            );
                                            $this->User_model->add('tbl_roi', $roiArr);
                                            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), '*');
                                            if($sponser['paid_status'] == 1){
                                                         $direct_income = ($data['amount']*$package['direct_income'])/$response['tokenValue']['amount'];

                                                    $DirectIncome = array(
                                                        'user_id' => $user['sponser_id'],
                                                        'amount' => round($direct_income,2),
                                                        'dollar' => $data['amount']*$package['direct_income'],
                                                        'token_price' => $response['tokenValue']['amount'],
                                                        'type' => 'direct_income',
                                                        'description' => 'Direct Sponser from Activation of Member ' . $user_id,
                                                    );
                                                    $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                                    $this->User_model->update('tbl_users',['user_id' => $user['sponser_id']],['incomeLimit' => ($sponser['incomeLimit'] + $DirectIncome['amount'])]);
                                             }
                                        $this->updateBusiness($user['sponser_id'],'team_business',1);
                                        $this->updateBusiness($user['sponser_id'],'team_business_plan',$package['price']);
                                       // $this->level_income($user['sponser_id'], $user['user_id'], $package['level_income'],$data['amount']);
                                        $message = 'Dear User your account is successfully activated with amount '.$package['price'].' by User '.$this->session->userdata['user_id'];
                                        composeMail($user['email'],'Activation','Activation',$message,$display=false);
                                        $response['msg'] = 'Account Activated Successfully';
                                        $response['status'] = 'success';
                                        echo json_encode($response);
                                         return;
                        } else {
                            $response['msg'] = 'Minimum activation amount '.currency.'10';
                            $response['status'] = 'fail';
                            echo json_encode($response);
                            return;
                        }
                    } else {
                          $response['msg'] = 'Invalid User ID';
                          $response['status'] = 'fail';
                          echo json_encode($response);
                          return;
                    }
                }
            $response['wallet'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
            //$response['packages'] = $this->User_model->get_records('tbl_package', array(), '*');
            echo json_encode($response);
            return;
            
        } else {
            $response['msg'] = 'Opps! somthing went wrong. Please try again.';
            $response['status'] = 'fail';
            echo json_encode($response);
            return;
        }
    }


    public function activate_all_users_temp()
    {
        die();
        $users = $this->User_model->get_records('activation', [''],'*');
        foreach ($users as $key => $user) {
            $user['topup_date'] = date('Y-m-d H:i:s', strtotime($user['topup_date']));
            $user_check = $this->User_model->get_single_record('tbl_users', ['user_id' => $user['user_id']], 'count(id) as user_check');

            if($user_check['user_check'] > 0){
                $package = $this->User_model->get_single_record('tbl_package',['price' => $user['package_amount']], '*');
                if(!empty($package) && $package['price'] > 25){
                    if($package['days'] > 0){
                        $user2 = $this->User_model->get_single_record('tbl_users', ['user_id' => $user['user_id']], '*');
                        $user_id = $user['user_id'];
                        $topupData = array(
                            'paid_status' => 1,
                            'package_id' => $package['id'],
                            'package_amount' => $package['price'],
                            'total_package' => $user2['total_package'] + $package['price'],
                            'topup_date' => $user['topup_date'],
                            'capping' => $package['capping'],
                            'incomeLimit2' => $user2['incomeLimit2'] + ($package['price']*2.2),
                        );
                        $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);


                        $this->User_model->update_directs($user2['sponser_id']);


                        $roiArr = array(
                            'user_id' => $user['user_id'],
                            'amount' => ($package['commision'] *$package['price'] * $package['days']),
                            'roi_amount' => $package['commision']*$package['price'],
                            'days' => $package['days'],
                            'total_days' => $package['days'],
                            'package' => $package['price'],
                            'type' => 'dividend_share',
                            'creditDate' => date('Y-m-d'),
                        );
                        $this->User_model->add('tbl_roi', $roiArr);
                    }

                    //$this->royaltyAchiever($user2['sponser_id'],$package['price']);
                    //$this->updateBusiness($user2['sponser_id'],'team_business',1);
                    //$this->updateBusiness($user2['sponser_id'],'team_business_plan',$package['price']);


                }
            }
        }
    }

    private function royaltyAchiever($user_id){
        if (is_logged_in()) {
            if(!empty($user_id)){
                $userDetail = $this->User_model->get_single_record('tbl_users',['user_id' => $user_id],'directs,topup_date,royalty_status,package_amount');
                $direct = $this->User_model->get_single_record('tbl_users',['sponser_id' => $user_id,'package_amount >=' => $userDetail['package_amount']],'count(id) as direct');
                $date1 = date('Y-m-d H:i:s');
                $date2 = date('Y-m-d H:i:s',strtotime($userDetail['topup_date'].'+10 days'));
                $diff1 = strtotime($date2) - strtotime($date1);
                if($diff1 > 0){
                    $package = $this->User_model->get_single_record('tbl_package', array('price' => $userDetail['package_amount']), '*');
                    if($direct['direct'] >= 3 && $userDetail['royalty_status'] == 0){
                        $roiArr = array(
                            'user_id' => $user_id,
                            'amount' => ($package['commision'] *$package['price'] * $package['days']),
                            'roi_amount' => $package['commision']*$package['price'],
                            'days' => $package['days'],
                            'total_days' => $package['days'],
                            'package' => $package['price'],
                            'type' => 'booster_income',
                            'creditDate' => date('Y-m-d'),
                        );
                        $this->User_model->add('tbl_roi', $roiArr);
                        $this->User_model->update('tbl_users',['user_id' => $user_id],['royalty_status' => 1]);
                    }
                }
            }
        }
    }

    private function level_income($sponser_id, $activated_id, $package_income,$package) {
        //$incomes = explode(',', $package_income);
        for($i=0;$i<21;$i++){
            $incomes[$i] = 0.0025;
        }
        $directArr = [1,1,2,2,3,3,4,4,5,5,6,6,7,7,8,8,9,9,10,10];
        $tokenValue = $this->User_model->get_single_record('tbl_token_value',['id' => 1],'amount');
        foreach ($incomes as $key => $income) {
            $direct = $directArr[$key];
            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), 'id,user_id,sponser_id,paid_status,directs');
            if (!empty($sponser['user_id'])) {
                if ($sponser['paid_status'] == 1) {
                    //if($sponser['directs'] >= $direct){
                        $LevelIncome = array(
                            'user_id' => $sponser['user_id'],
                            'amount' => $income*$package,
                            'dollar' => $income*$package,
                            'token_price' => $tokenValue['amount'],
                            'type' => 'level_income',
                            'description' => 'Level Income from Activation of Member ' . $activated_id . ' At level ' . ($key + 1),
                        );
                        $this->User_model->add('tbl_income_wallet', $LevelIncome);
                    //}
                }
                $sponser_id = $sponser['sponser_id'];
            }
        }
    }

    private function update_business($user_name, $downline_id, $level = 1, $power, $business, $type) {
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'upline_id , position,user_id');
        if (!empty($user)) {
            if ($user['position'] == 'L') {
                $c = 'leftPower';
                $d = 'leftBusiness';
            } else if ($user['position'] == 'R') {
                $c = 'rightPower';
                $d = 'rightBusiness';
            } else {
                return;
            }
            $this->User_model->update_business($c, $user['upline_id'], $power);
            $this->User_model->update_business($d, $user['upline_id'], $business);
            $downlineArray = array(
                'user_id' => $user['upline_id'],
                'downline_id' => $downline_id,
                'position' => $user['position'],
                'business' => $business,
                'type' => $type,
                'created_at' => date('Y-m-d H:i:s'),
                'level' => $level,
            );
            $this->User_model->add('tbl_downline_business', $downlineArray);
            $user_name = $user['upline_id'];

            if ($user['upline_id'] != '') {
                $this->update_business($user_name, $downline_id, $level + 1, $power,$business, $type);
            }
        }
    }

    protected function individualPoolEntry($user_id,$table){
        if($table == 'tbl_pool1'){ $org = 1; $amount = 100;}
        elseif($table == 'tbl_pool2'){ $org = 2; $amount = 200;}
        elseif($table == 'tbl_pool3'){ $org = 3; $amount = 400;}
        elseif($table == 'tbl_pool4'){ $org = 4; $amount = 800;}
        elseif($table == 'tbl_pool5'){ $org = 5; $amount = 1600;}
        elseif($table == 'tbl_pool6'){ $org = 6; $amount = 3200;}
        elseif($table == 'tbl_pool7'){ $org = 7; $amount = 6400;}
        elseif($table == 'tbl_pool8'){ $org = 7; $amount = 12800;}
        elseif($table == 'tbl_pool9'){ $org = 7; $amount = 25600;}
        elseif($table == 'tbl_pool10'){ $org = 7; $amount = 51200;}
        $sponsorID = $this->User_model->get_single_record('tbl_users',['user_id' => $user_id],'sponser_id');
        $pool_upline = $this->User_model->get_single_record($table, array('user_id' => $sponsorID['sponser_id'],'down_count <' => 3), 'user_id');
        //pr($pool_upline,true);
        if($pool_upline['user_id'] == ''){
            $uplineID = $this->get_pool_upline($sponsorID['sponser_id'],$table,$org);
        }else{
            $uplineID = $pool_upline['user_id'];
        }
        $userinfo = $this->User_model->get_single_record($table,['user_id' => $uplineID],'down_count');
        $poolArr = [
            'user_id' => $user_id,
            'upline_id' => $uplineID,
        ];
        //pr($poolArr,true);
        $this->User_model->add($table, $poolArr);
        $this->User_model->update($table, array('user_id' => $uplineID),['down_count' => ($userinfo['down_count'] + 1)]);
        $this->updateTeam($user_id,$table);
        $this->update_pool_downline($uplineID,$user_id,$level = 1,$table,$org);
        $this->poolIncome($table,$user_id,$user_id,$org,3,1,$amount);
    }

      protected function updateTeam($user_id,$table,$org){
        $uplineID = $this->User_model->get_single_record($table,array('user_id' => $user_id,'org' => $org),'upline_id');
        if(!empty($uplineID['upline_id'])){
            $team = $this->User_model->get_single_record($table,array('user_id' => $uplineID['upline_id'],'org' => $org),'team');
            $newTeam = $team['team'] + 1;
            $this->User_model->update($table, array('user_id' => $uplineID['upline_id'],'org' => $org),array('team' => $newTeam));
            $this->updateTeam($uplineID['upline_id'],$table,$org);
        }
    }

        public function update_pool_downline($upline_id,$user_id,$level,$table,$org){
        $user = $this->User_model->get_single_record($table, array('user_id' => $upline_id), $select = 'user_id,upline_id');
        if(!empty($user['user_id'])){
            $pool_downArr = [
                'user_id' => $user['user_id'],
                'downline_id' => $user_id,
                'level' => $level,
                'org' => $org,
            ];
            $this->User_model->add('tbl_pool_downline', $pool_downArr);
            $this->update_pool_downline($user['upline_id'],$user_id,$level + 1,$table,$org);
        }
    }

    private function poolIncome($table,$user_id,$linkedID,$org,$team,$level,$amount){
        $upline = $this->User_model->get_single_record($table,['user_id' => $user_id],['upline_id']);

        if(!empty($upline['upline_id'])){
            $checkTeam = $this->User_model->get_single_record('tbl_pool_downline',['user_id' => $upline['upline_id'],'level' => $level,'org' => $org],'count(id) as team');
            if($checkTeam['team'] == $team){
                $creditSIncome = [
                    'user_id' => $upline['upline_id'],
                    'amount' => $amount,
                    'type' => 'working_pool',
                    'description' => 'Working Pool Income from User '.$linkedID,
                ];
                $this->User_model->add('tbl_income_wallet',$creditSIncome);

                $debitIncome = [
                    'user_id' => $upline['upline_id'],
                    'amount' => -$amount,
                    'type' => 'upgradation_deduction',
                    'description' => 'Working Pool Income from User '.$linkedID,
                ];
                $this->User_model->add('tbl_income_wallet',$debitIncome);

            }else{
                $creditIncome = [
                    'user_id' => $upline['upline_id'],
                    'amount' => $amount,
                    'type' => 'working_pool',
                    'description' => 'Working Pool upgradation deduction',
                ];
                $this->User_model->add('tbl_income_wallet',$creditIncome);
            }
            $level += 1;
            $team *= 3;
            $this->poolIncome($table,$upline['upline_id'],$linkedID,$org,$team,$level,$amount);
        }
    }

    public function upgradePool(){
        if($this->input->server("REQUEST_METHOD") == "POST"){
            $data = $this->security->xss_clean($this->input->post());
            $package = $this->User_model->get_single_record('tbl_package',['id' => $data['product']],'direct_income,products');
            $user_id = $this->session->userdata['user_id'];
            $this->globlePoolEntry($user_id,$package['products'],1);
            $debit = [
                'user_id' => $user_id,
                'amount' => -($package['direct_income']*2),
                'type' => 'upgrade_deduction',
                'description' => 'Pool Upgrade Deduction',
            ];
            $this->User_model->add('tbl_income_wallet',$debit);
        }
        redirect('Dashboard/User');
    }

    protected function globlePoolEntry($user_id,$table,$org){
        if($table == 'tbl_pool'){$amount = 20;}
        elseif($table == 'tbl_pool2'){$amount = 400;}
        elseif($table == 'tbl_pool3'){$amount = 2000;}
        elseif($table == 'tbl_pool4'){$amount = 5000;}
        $pool_upline = $this->User_model->get_single_record($table, array('down_count <' => 2,'org' => $org), 'id,user_id,down_count');
        if(!empty($pool_upline)){
            $poolArr =  array(
                'user_id' => $user_id,
                'upline_id' => $pool_upline['user_id'],
                'org' => $org,
            );
            $this->User_model->add($table, $poolArr);
            $this->User_model->update($table, array('id' => $pool_upline['id'],'org' => $org),array('down_count' => $pool_upline['down_count'] + 1));
            $this->updateTeam($user_id,$table,$org);
            $this->poolIncome2($table,$user_id,$user_id,$org);
        }else{
            $poolArr =  array(
                'user_id' => $user_id,
                'upline_id' => '',
                'org' => $org,
            );
            $this->User_model->add($table, $poolArr);
            $this->updateTeam($user_id,$table,$org);
            $this->poolIncome2($table,$user_id,$user_id,$org);
        }
    }

    private function poolIncome2($table,$user_id,$linkedID,$org){
        $poolDetails = $this->poolDetails($table);
        $poolData = $poolDetails[$org];
        $upline = $this->User_model->get_single_record($table,['user_id' => $user_id],['upline_id']);
        if(!empty($upline['upline_id'])){
            $checkTeam = $this->User_model->get_single_record($table,['user_id' => $upline['upline_id']],'team');
            if($checkTeam['team'] == 2){
                $creditIncome = [
                    'user_id' => $upline['upline_id'],
                    'amount' => $poolData['amount'],
                    'type' => 'pool_income',
                    'description' => 'Pool Income from level '.$org,
                ];
                $this->User_model->add('tbl_income_wallet',$creditIncome);
                $creditIncome = [
                    'user_id' => $upline['upline_id'],
                    'amount' => -$poolData['amount'],
                    'type' => 'upgrade_deduction',
                    'description' => 'Pool Upgrade Deduction',
                ];
                $this->User_model->add('tbl_income_wallet',$creditIncome);
                $orgNext = $org + 1;
                $this->globlePoolEntry($upline['upline_id'],$table,$orgNext);
            }
        }
    }

    // public function test($table,$org){
    //     $poolDetails = $this->poolDetails($table);
    //     $poolData = $poolDetails[$org];
    //     pr($poolData);
    // }

    private function poolDetails($table){
        $poolArr = [
            'tbl_pool' => [
                1 => ['amount' => 20],
                2 => ['amount' => 40],
                3 => ['amount' => 80],
                4 => ['amount' => 160],
                5 => ['amount' => 320],
            ],
            'tbl_pool2' => [
                1 => ['amount' => 400],
                2 => ['amount' => 800],
                3 => ['amount' => 1600],
                4 => ['amount' => 3200],
                5 => ['amount' => 6400],
            ],
            'tbl_pool3' => [
                1 => ['amount' => 2000],
                2 => ['amount' => 4000],
                3 => ['amount' => 8000],
                4 => ['amount' => 16000],
                5 => ['amount' => 32000],
            ],
            'tbl_pool4' => [
                1 => ['amount' => 5000],
                2 => ['amount' => 10000],
                3 => ['amount' => 20000],
                4 => ['amount' => 40000],
                5 => ['amount' => 80000],
            ],
        ];

        return $poolArr[$table];
    }

    private function getSponsor($user_id,$table){
        $users = $this->User_model->get_records('tbl_sponser_count',"downline_id = '".$user_id."' and user_id != 'none' ORDER BY level ASC",'user_id');
        foreach($users as $user){
            $check = $this->User_model->get_single_record($table,['user_id' => $user['user_id']],'user_id');
            if(!empty($check['user_id'])){
                $check2 = $this->User_model->get_single_record($table,['user_id' => $user['user_id'],'down_count <' => 3],'user_id');
                $this->exceptionCase = $check2['user_id'];
                if(!empty($check2['user_id'])){
                    return $check2['user_id'];
                    break;
                }
            }
        }
    }

    private function get_pool_upline($sponser_id,$table,$org){
        $users = $this->User_model->get_records('tbl_pool_downline',"user_id = '".$sponser_id."' and org = '".$org."' ORDER BY level,created_at ASC",'downline_id');
        if(!empty($users)){
            foreach($users as $key => $user){
                $check = $this->User_model->get_single_record($table,['user_id' => $user['downline_id'],'down_count <' => 3],'user_id');
                if(!empty($check['user_id'])){
                    return $check['user_id'];
                    break;
                }
            }
        }else{
            $sponsorID = $this->getSponsor($sponser_id,$table);
            if(!empty($sponsorID)){
                return $sponsorID;
            }else{
                return $this->get_pool_upline($this->exceptionCase,$table,$org);
            }
        }
    }

    public function UpgradeAccount() {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('package_id','Package','trim|numeric|required');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = $this->session->userdata['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    //$sponserInfo = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'package_amount');
                    $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    $package = $this->User_model->get_single_record('tbl_package', array('id' => $data['package_id']), '*');
                    //$packageCheck = $this->User_model->get_single_record('tbl_package', 'id = "'.$user['package_id'].'"', '*');
                    //$pool = $this->User_model->get_single_record($packageCheck['products'], 'user_id = "'.$user['user_id'].'"', '*');
                    //if(!empty($pool)){
                        if (!empty($user)) {
                            //if($sponserInfo['package_amount'] >= $package['price']){
                            if($package['price'] > $user['package_amount']){
                                if ($wallet['wallet_balance'] >= $package['price']) {
                                    //if (empty($poolID['user_id'])) {
                                            $sendWallet = array(
                                                'user_id' => $this->session->userdata['user_id'],
                                                'amount' => -$package['price'],
                                                'type' => 'account_activation',
                                                'remark' => 'Account Upgrade Deduction for ' . $user_id,
                                            );
                                            $this->User_model->add('tbl_wallet', $sendWallet);

                                            $topupData = array(
                                                'package_id' => $package['id'],
                                                'package_amount' => $package['price'],
                                                'total_package' => $user['package_amount']+$package['price'],
                                                'topup_date' => date('Y-m-d H:i:s'),
                                                'capping' => $package['capping'],
                                                'incomeLimit2' => $user['incomeLimit2'] + ($package['price']*2.2),
                                                //'retopup' => 0,
                                            );
                                            $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
                                            $roiArr = array(
                                                'user_id' => $user['user_id'],
                                                'amount' => ($package['commision'] * $package['days']),
                                                'roi_amount' => $package['commision']*$package['price'],
                                                'days' => $package['days'],
                                                'total_days' => $package['days'],
                                                'package' => $package['price'],
                                                'type' => 'roi_income',
                                            );
                                            $this->User_model->add('tbl_roi', $roiArr);
                                            //$this->individualPoolEntry($user['user_id'],$amount['product']);
                                            // $this->User_model->update_directs($user['sponser_id']);
                                            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), '*');
                                            if($sponser['paid_status'] == 1){
                                                if($sponser['incomeLimit2'] > $sponser['incomeLimit']){
                                                    $totalCredit = $sponser['incomeLimit'] + ($package['price']*$package['direct_income']);
                                                    if($totalCredit < $sponser['incomeLimit2']){
                                                        $direct_income = $package['price']*$package['direct_income'];
                                                    } else {
                                                        $direct_income = $sponser['incomeLimit2'] - $sponser['incomeLimit'];
                                                    }

                                                    $DirectIncome = array(
                                                        'user_id' => $user['sponser_id'],
                                                        'amount' => $direct_income*0.7,
                                                        'type' => 'direct_income',
                                                        'description' => 'Direct Income from Upgradation of Member ' . $user_id,
                                                    );
                                                    $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                                    $this->User_model->update('tbl_users',['user_id' => $user['sponser_id']],['incomeLimit' => ($sponser['incomeLimit'] + $DirectIncome['amount'])]);
                                                    $coinCredit = array(
                                                        'user_id' => $user['sponser_id'],
                                                        'amount' => $direct_income*0.3,
                                                        'type' => 'direct_income',
                                                        'description' => 'Direct Income from Activation of Member ' . $user_id,
                                                    );
                                                    $this->User_model->add('tbl_coin_wallet', $coinCredit);
                                                }
                                            }
                                            // $this->level_income($sponser['sponser_id'], $user['user_id'], $data['amount']);
                                            // $DirectIncome = array(
                                            //     'user_id' => $user['sponser_id'],
                                            //     'amount' => $package['direct_income'],
                                            //     'type' => 'direct_income',
                                            //     'description' => 'Direct Income from Retopup of Member ' . $user_id,
                                            // );
                                            // $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                            //$this->update_business($user['user_id'], $user['user_id'], $level = 1, $package['bv'], $type = 'topup');
                                            // $roiData = [
                                            //     'user_id' => $user['user_id'],
                                            //     'amount' => $data['amount'] * 2,
                                            //     'days' => 44,
                                            //     'roi_amount' => $data['amount']*0.04,
                                            //     'creditDate' => date('Y-m-d'),
                                            // ];
                                            // $this->User_model->add('tbl_roi', $roiData);
                                            // $roiArr = array(
                                            //     'user_id' => $user['user_id'],
                                            //     'amount' => ($package['price'] * $package['days']),
                                            //     'roi_amount' => $package['commision'],
                                            // );
                                            // $this->User_model->add('tbl_roi', $roiArr);
                                            $this->session->set_flashdata('message', '<h5 class = "text-success">Account upgraded Successfully</h5>');
                                    // } else {
                                    //     $this->session->set_flashdata('message', '<h5 class = "text-danger">This Account Already Upgrade to this Amount</h5>');
                                    // }
                                } else {
                                    $this->session->set_flashdata('message', '<h5 class = "text-danger">Insuffcient Balance</h5>');
                                }
                            } else {
                                $this->session->set_flashdata('message', '<h5 class = "text-danger">You can upgrade to only above amount!</h5>');
                            }
                        }else{
                            $this->session->set_flashdata('message', '<h5 class = "text-danger">Invalid User ID</h5>');
                        }
                    // } else {
                    //     $this->session->set_flashdata('message', '<h3 class = "text-danger">Please activate your 1st Pool First </h3>');
                    // }
                }else{
                    $this->session->set_flashdata('message',validation_errors());
                }
            }
            $response['wallet'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
            $response['packages'] = $this->User_model->get_records('tbl_package',[], '*');
            // $response['packages'] = $this->User_model->get_records('tbl_package',"price > '".$response['user']['package_amount']."' ORDER BY id ASC LIMIT 1", '*');

            $this->load->view('upgrade_account', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }


    public function stackCoinAjax(){
        if (is_logged_in()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $response['status'] = 0;
                $response['csrf'] = $this->security->get_csrf_hash();
                $tokenValue = $this->User_model->get_single_record('tbl_token_value',['id' => 1],'amount');
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = $this->session->userdata['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $wallet = $this->User_model->get_single_record('tbl_coin_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    if (!empty($user)) {
                        if ($data['amount']) {
                            $sendWallet = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => -$data['amount'],
                                'type' => 'stake_coin',
                                'description' => 'Stake Coin Deduction for ' . $user_id,
                            );
                            $this->User_model->add('tbl_coin_wallet', $sendWallet);
                            $totalStakeCoin = $user['stakeCoin'] + $data['amount'];
                            $this->User_model->update('tbl_users',['user_id' => $user_id],['stakeCoin' => $totalStakeCoin]);

                            $amount = $data['amount']; //$response['tokenValue']['amount'];
                            $month = $data['months'];
                            if($month == 18){
                                $percent = 20;
                                $finalAmount = $amount + $amount*0.2;
                            } elseif($month == 24) {
                                $percent = 36;
                                $finalAmount = $amount + $amount*0.36;
                            } elseif($month == 36) {
                                $percent = 48;
                                $finalAmount = $amount + $amount*0.48;
                            } elseif($month == 48) {
                                $percent = 60;
                                $finalAmount = $amount + $amount*0.6;
                            } else {
                                redirect('Dashboard/User/logout');
                                exit;
                            }
                            $creditCoin = array(
                                'user_id' => $user['user_id'],
                                'amount' =>  $amount,
                                'token_price' => $tokenValue['amount'],
                                'maturity_amount' => $finalAmount,
                                'months' => $month,
                                'maturity_date' => date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s').'+ '.$month.'months')),
                                'created_at' => date('Y-m-d H:i:s'),
                            );
                            $this->User_model->add('tbl_stack_wallet', $creditCoin);
                            $this->levelStackingIncome($user['user_id'], $user['user_id'],$data['amount']);
                            $this->updateBusiness($user['sponser_id'],'team_business',$data['amount']);
                            $response['status'] = 1;
                            $response['message'] = 'Staking done Successfully';
                        } else {
                            $response['message'] = 'Insuffcient Balance';
                        }
                    } else {
                        $response['message'] = 'Invalid User ID';
                    }
                } else {
                    $response['message'] = validation_errors();
                }
                echo json_encode($response);
                exit;
            }
        } else {
            redirect('Dashboard/User/login');
        }
    }


    public function stackCoin(){
        if (is_logged_in()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $response['status'] = 0;
                $response['token'] = $this->security->get_csrf_hash();
                $tokenValue = $this->User_model->get_single_record('tbl_token_value',['id' => 1],'amount');
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = $this->session->userdata['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $wallet = $this->User_model->get_single_record('tbl_coin_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    if (!empty($user)) {
                        if ($wallet['wallet_balance'] >= $data['amount']) {
                            $sendWallet = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => -$data['amount'],
                                'type' => 'stake_coin',
                                'description' => 'Stake Coin Deduction for ' . $user_id,
                            );
                            $this->User_model->add('tbl_coin_wallet', $sendWallet);
                            $totalStakeCoin = $user['stakeCoin'] + $data['amount'];
                            $this->User_model->update('tbl_users',['user_id' => $user_id],['stakeCoin' => $totalStakeCoin]);

                            $amount = $data['amount']; //$response['tokenValue']['amount'];
                            $month = $data['months'];
                            if($month == 18){
                                $percent = 20;
                                $finalAmount = $amount + $amount*0.2;
                            } elseif($month == 24) {
                                $percent = 36;
                                $finalAmount = $amount + $amount*0.36;
                            } elseif($month == 36) {
                                $percent = 48;
                                $finalAmount = $amount + $amount*0.48;
                            } elseif($month == 48) {
                                $percent = 60;
                                $finalAmount = $amount + $amount*0.6;
                            } else {
                                redirect('Dashboard/User/logout');
                                exit;
                            }
                            $creditCoin = array(
                                'user_id' => $user['user_id'],
                                'amount' =>  $amount,
                                'token_price' => $tokenValue['amount'],
                                'maturity_amount' => $finalAmount,
                                'months' => $month,
                                'maturity_date' => date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s').'+ '.$month.'months')),
                                'created_at' => date('Y-m-d H:i:s'),
                            );
                            $this->User_model->add('tbl_stack_wallet', $creditCoin);
                            $this->levelStackingIncome($user['user_id'], $user['user_id'],$data['amount']);
                            $this->updateBusiness($user['sponser_id'],'team_business',$data['amount']);
                            $response['status'] = 1;
                            $response['message'] = 'Staking done Successfully';
                        } else {
                            $response['message'] = 'Insuffcient Balance';
                        }
                    } else {
                        $response['message'] = 'Invalid User ID';
                    }
                } else {
                    $response['message'] = validation_errors();
                }
                echo json_encode($response);
                exit;
            }
        } else {
            redirect('Dashboard/User/login');
        }
    }

    private function levelStackingIncome($user_id,$linkedID,$amount){
        $incomeArr = ['0.1','0.05','0.03','0.02'];
        foreach($incomeArr as $key => $income):
            $sponsor = $this->User_model->get_single_record('tbl_users',['user_id' => $user_id],'sponser_id');
            if(!empty($sponsor['sponser_id']) && $sponsor['sponser_id'] != 'none'):
                $creditIncome = [
                    'user_id' => $sponsor['sponser_id'],
                    'amount' => $amount*$income,
                    'type' => 'level_income',
                    'description' => 'Staking level income from User '.$linkedID.' at level '.($key+1),
                ];
                $this->User_model->add('tbl_income_wallet',$creditIncome);
                $user_id = $sponsor['sponser_id'];
            endif;
        endforeach;
    }


    public function purchaseMurphyAjax(){
        if (is_logged_in()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $response['status'] = 0;
                $response['csrf'] = $this->security->get_csrf_hash();
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = $this->session->userdata['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    $tokenValue = $this->User_model->get_single_record('tbl_token_value',['id' => 1],'amount');
                    if (!empty($user)) {
                        if ($data['amount']) {
                            $sendWallet = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => -$data['amount'],
                                'type' => 'account_activation',
                                'remark' => 'Account Activation Deduction for ' . $user_id,
                            );
                            $this->User_model->add('tbl_wallet', $sendWallet);
                            $topupData = array(
                                'paid_status' => 1,
                                'package_id' => 1,
                                'package_amount' => $user['package_amount'] + $data['amount'],
                                'topup_date' => date('Y-m-d H:i:s'),
                            );
                            $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
                            if($user['paid_status'] == 0){
                                $this->User_model->update_directs($user['sponser_id']);
                            }
                            $roiMaker = $data['amount']*0.03;
                            $month = $data['months'];
                            $coin = $data['amount']/$tokenValue['amount'];
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
                            // } else {
                            //     redirect('Dashboard/User/logout');
                            //     exit;
                            // }

                            $roiArr = array(
                                'user_id' => $user['user_id'],
                                'amount' => ($roiMaker * $month),
                                'roi_amount' => $roiMaker,
                                'days' => $month,
                                'total_days' => $month,
                                'coin' => $coin,
                                'token_price' => $tokenValue['amount'],
                                'package' => $data['amount'],
                                'type' => 'roi_income',
                                'creditDate' => date('Y-m-d'),
                                'currency' => $data['currency'],
                                'transactionHash' => $data['data']
                            );
                            $this->User_model->add('tbl_roi', $roiArr);
                            $this->updateBusiness($user['sponser_id'],'team_business_plan',$data['amount']);
                            $response['status'] = 1;
                            $response['message'] = 'Murphy Purchase done Successfully';
                        } else {
                            $response['message'] = 'Insuffcient Balance';
                        }
                    } else {
                        $response['message'] = 'Invalid User ID';
                    }
                } else {
                    $response['message'] = validation_errors();
                }
                echo json_encode($response);
                exit;
            }
        } else {
            redirect('Dashboard/User/login');
        }
    }


    public function purchaseMurphy(){
        if (is_logged_in()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $response['status'] = 0;
                $response['token'] = $this->security->get_csrf_hash();
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = $this->session->userdata['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    $tokenValue = $this->User_model->get_single_record('tbl_token_value',['id' => 1],'amount');
                    if (!empty($user)) {
                        if ($wallet['wallet_balance'] >= $data['amount']) {
                            $sendWallet = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => -$data['amount'],
                                'type' => 'account_activation',
                                'remark' => 'Account Activation Deduction for ' . $user_id,
                            );
                            $this->User_model->add('tbl_wallet', $sendWallet);
                            $topupData = array(
                                'paid_status' => 1,
                                'package_id' => 1,
                                'package_amount' => $user['package_amount'] + $data['amount'],
                                'topup_date' => date('Y-m-d H:i:s'),
                            );
                            $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
                            if($user['paid_status'] == 0){
                                $this->User_model->update_directs($user['sponser_id']);
                            }
                            $roiMaker = $data['amount']*0.03;
                            $month = $data['months'];
                            $coin = $data['amount']/$tokenValue['amount'];
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
                            // } else {
                            //     redirect('Dashboard/User/logout');
                            //     exit;
                            // }

                            $roiArr = array(
                                'user_id' => $user['user_id'],
                                'amount' => ($roiMaker * $month),
                                'roi_amount' => $roiMaker,
                                'days' => $month,
                                'total_days' => $month,
                                'coin' => $coin,
                                'token_price' => $tokenValue['amount'],
                                'package' => $data['amount'],
                                'type' => 'roi_income',
                                'creditDate' => date('Y-m-d'),
                            );
                            $this->User_model->add('tbl_roi', $roiArr);
                            $this->updateBusiness($user['sponser_id'],'team_business_plan',$data['amount']);
                            $response['status'] = 1;
                            $response['message'] = 'Murphy Purchase done Successfully';
                        } else {
                            $response['message'] = 'Insuffcient Balance';
                        }
                    } else {
                        $response['message'] = 'Invalid User ID';
                    }
                } else {
                    $response['message'] = validation_errors();
                }
                echo json_encode($response);
                exit;
            }
        } else {
            redirect('Dashboard/User/login');
        }
    }

    private function updateBusiness($user_id,$field,$business){
        $userinfo = $this->User_model->get_single_record('tbl_users',['user_id' => $user_id],'user_id,sponser_id');
        if(!empty($userinfo['user_id']) && $userinfo['user_id'] != 'none'){
            $this->User_model->update_business($field,$userinfo['user_id'],$business);
            $this->updateBusiness($userinfo['sponser_id'],$field,$business);
        }
    }

    public function getBalance(){
        if(is_logged_in()){
            $coinBalance = $this->User_model->get_single_record('tbl_coin_wallet',['user_id' => $this->session->userdata['user_id']],'ifnull(sum(amount),0) as balance');
            $walletBalance = $this->User_model->get_single_record('tbl_wallet',['user_id' => $this->session->userdata['user_id']],'ifnull(sum(amount),0) as balance');
            $response = [
                'coinBalance' => $coinBalance['balance'],
                'walletBalance' => $walletBalance['balance'],
            ];
            echo json_encode($response);
            exit;
        } else {
            redirect('Dashboard/User/logout');
        }
    }

    public function getMHY(){
        if(is_logged_in()){
            $tokenValue = $this->User_model->get_single_record('tbl_token_value',['id' => 1],'*');
            $response['tokenValue'] = $tokenValue['amount'];
            $response['sellValue'] = $tokenValue['sellValue'];
            echo json_encode($response);
            exit;
        } else {
            redirect('Dashboard/User/logout');
        }
    }

    public function buyCoin(){
        if (is_logged_in()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $response['status'] = 0;
                $response['token'] = $this->security->get_csrf_hash();
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = $this->session->userdata['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    $tokenValue = $this->User_model->get_single_record('tbl_token_value',['id' => 1],'amount');
                    if (!empty($user)) {
                        if ($wallet['wallet_balance'] >= $data['amount']) {
                            $debitWallet = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => -abs($data['amount']),
                                'type' => 'buy_coin',
                                'remark' => 'Deducted for buying coin at price ' . $$tokenValue['amount'],
                            );
                            $this->User_model->add('tbl_wallet', $debitWallet);

                            $coin = abs($data['amount'])/$tokenValue['amount'];

                            $creditCoin = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => $coin,
                                'type' => 'buy_coin',
                                'description' => 'Buy Coin at price ' .$tokenValue['amount'],
                            );
                            $this->User_model->add('tbl_coin_wallet', $creditCoin);

                            $response['status'] = 1;
                            $response['message'] = 'Coin Purchase done Successfully';
                        } else {
                            $response['message'] = 'Insuffcient Balance';
                        }
                    } else {
                        $response['message'] = 'Invalid User ID';
                    }
                } else {
                    $response['message'] = validation_errors();
                }
                echo json_encode($response);
                exit;
            }
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function sellCoin(){
        if (is_logged_in()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $response['status'] = 0;
                $response['token'] = $this->security->get_csrf_hash();
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = $this->session->userdata['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $wallet = $this->User_model->get_single_record('tbl_coin_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    $tokenValue = $this->User_model->get_single_record('tbl_token_value',['id' => 1],'sellValue');
                    if (!empty($user)) {
                        if ($wallet['wallet_balance'] >= $data['amount']) {
                            $debitCoin = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => -abs($data['amount']),
                                'type' => 'sell_coin',
                                'description' => 'Deducted for sell coin at price ' . $$tokenValue['sellValue'],
                            );
                            $this->User_model->add('tbl_coin_wallet', $debitCoin);

                            $amount = abs($data['amount'])*$tokenValue['sellValue'];

                            $creditWallet = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => $amount,
                                'type' => 'sell_coin',
                                'description' => 'Sell Coin at price ' .$tokenValue['sellValue'],
                            );
                            $this->User_model->add('tbl_wallet', $creditWallet);

                            $response['status'] = 1;
                            $response['message'] = 'Coin Selling done Successfully';
                        } else {
                            $response['message'] = 'Insuffcient Coin Balance';
                        }
                    } else {
                        $response['message'] = 'Invalid User ID';
                    }
                } else {
                    $response['message'] = validation_errors();
                }
                echo json_encode($response);
                exit;
            }
        } else {
            redirect('Dashboard/User/login');
        }
    }

}
?>
