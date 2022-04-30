<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Activation extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user'));
        $this->exceptionCase = '';
        if(is_logged_in() === false) {
            redirect('App/User/logout');
            exit;
        }
    }

     public function index() {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = $data['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');

                    //$sponserInfo = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'package_amount');
                    $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    $package = $this->User_model->get_single_record('tbl_package', array('id' => $data['package_id']), '*');
                    if (!empty($user)) {
                        //if($sponserInfo['package_amount'] >= $package['price']){
                            if ($wallet['wallet_balance'] >= $package['price']) {
                                if ($user['paid_status'] == 0) {
                                        $sendWallet = array(
                                            'user_id' => $this->session->userdata['user_id'],
                                            'amount' => -$package['price'],
                                            'type' => 'account_activation',
                                            'remark' => 'Account Activation Deduction for ' . $user_id,
                                        );
                                        $this->User_model->add('tbl_wallet', $sendWallet);
                                        $topupData = array(
                                            'paid_status' => 1,
                                            'package_id' => $data['package_id'],
                                            'package_amount' => $user['package_amount']+$package['price'],
                                            'topup_date' => date('Y-m-d H:i:s'),
                                            'capping' => $package['capping'],
                                            'incomeLimit2' => $package['price']*5,
                                        );
                                        $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
                                        if($user['retopup'] == 0){
                                            $this->User_model->update_directs($user['sponser_id']);
                                            $roiArr = array(
                                                'user_id' => $user['user_id'],
                                                'amount' => ($package['commision'] * $package['days']),
                                                'roi_amount' => $package['commision'],
                                                'days' => $package['days'],
                                                'package' => $package['price'],
                                                'type' => 'roi_income',
                                            );
                                            $this->User_model->add('tbl_roi', $roiArr);
                                            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,paid_status,directs,incomeLimit,capping');
                                            if($sponser['paid_status'] == 1){
                                                if($sponser['capping'] > $sponser['incomeLimit']){
                                                    $totalCredit = $sponser['incomeLimit'] + $package['direct_income'];
                                                    if($totalCredit < $sponser['capping']){
                                                        $direct_income = $package['direct_income'];
                                                    } else {
                                                        $direct_income = $sponser['capping'] - $sponser['incomeLimit'];
                                                    }
                                                    
                                                    $DirectIncome = array(
                                                        'user_id' => $user['sponser_id'],
                                                        'amount' => $direct_income,
                                                        'type' => 'direct_income',
                                                        'description' => 'Direct Income from Activation of Member ' . $user_id,
                                                    );
                                                    $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                                    $this->User_model->update('tbl_users',['user_id' => $user['sponser_id']],['incomeLimit' => ($sponser['incomeLimit'] + $DirectIncome['amount'])]);
                                                }
                                            }
                                            // if($sponser['directs']%2 == 0){
                                            //     $roiArr2 = array(
                                            //         'user_id' => $user['sponser_id'],
                                            //         'amount' => 20*20,
                                            //         'roi_amount' => 20,
                                            //         'days' => 20,
                                            //         'type' => 'direct_booster_income',
                                            //     );
                                            //     $this->User_model->add('tbl_roi', $roiArr2);
                                            // }
                                        }

                                        //$this->royaltyAchiever($user['sponser_id']);
                                        //$this->level_income($sponser['sponser_id'], $user['user_id'], $package['level_income']);
                                        $this->update_business($user['user_id'], $user['user_id'], $level = 1,$package['price'] ,$package['bv'], $type = 'topup');
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
                                        $this->session->set_flashdata('message', '<h3 class = "text-success">Account Activated Successfully </h3>');
                                } else {
                                    $this->session->set_flashdata('message', '<h3 class = "text-danger">This Account Already Acitvated </h3>');
                                }
                            } else {
                                $this->session->set_flashdata('message', '<h3 class = "text-danger">Insuffcient Balance </h3>');
                            }
                        // } else {
                        //     $this->session->set_flashdata('message', '<h3 class = "text-danger">You can activate account with maximum amount '.$sponserInfo['package_amount'].' </h3>');
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
            redirect('App/User/login');
        }
    }

    private function royaltyAchiever($user_id = ''){
        if (is_logged_in()) {
            $userDetail = $this->User_model->get_single_record('tbl_users',['user_id' => $user_id],'directs,topup_date,royalty_status');
            $date1 = date('Y-m-d H:i:s');
            $date2 = date('Y-m-d H:i:s',strtotime($userDetail['topup_date'].'+10 days'));
            $diff1 = strtotime($date2) - strtotime($date1); 
            if($diff1 > 0){
                if($userDetail['directs'] >= 15 && $userDetail['royalty_status'] == 0){
                    $this->User_model->update('tbl_users',['user_id' => $user_id],['royalty_status' => 1]);
                }
            }
        }
    }

    private function level_income($sponser_id, $activated_id, $package_income) {
        $incomes = explode(',', $package_income);
        // $incomes = array(70,35,30,25,20,15,10,5,5);
        foreach ($incomes as $key => $income) {
            $direct = $key+1;
            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), 'id,user_id,sponser_id,paid_status,directs');
            if (!empty($sponser)) {
                if ($sponser['paid_status'] == 1) {
                    if($sponser['directs'] >= $direct){
                        $LevelIncome = array(
                            'user_id' => $sponser['user_id'],
                            'amount' => $income,
                            'type' => 'level_income',
                            'description' => 'Level Income from Activation of Member ' . $activated_id . ' At level ' . ($key + 1),
                        );
                        $this->User_model->add('tbl_income_wallet', $LevelIncome);
                    }
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
        redirect('App/User');
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
                            if(($user['package_amount']+$package['price']) < 12000){
                                if ($wallet['wallet_balance'] >= $package['price']) {
                                    //if (empty($poolID['user_id'])) {
                                            $sendWallet = array(
                                                'user_id' => $this->session->userdata['user_id'],
                                                'amount' => -$package['price'],
                                                'type' => 'upgrade_account',
                                                'remark' => 'Account Upgrade Deduction for ' . $user_id,
                                            );
                                            $this->User_model->add('tbl_wallet', $sendWallet);
                                            
                                            $topupData = array(
                                                'package_id' => $package['id'],
                                                'package_amount' => $user['package_amount']+$package['price'],
                                                'topup_date' => date('Y-m-d H:i:s'),
                                                'capping' => $package['capping'],
                                                'incomeLimit' => 0,
                                                'incomeLimit2' => $user['incomeLimit2'] + ($package['price']*5),
                                                'retopup' => 0,
                                            );
                                            $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
                                            $roiArr = array(
                                                'user_id' => $user['user_id'],
                                                'amount' => ($package['commision'] * $package['days']),
                                                'roi_amount' => $package['commision'],
                                                'days' => $package['days'],
                                                'package' => $package['price'],
                                                'type' => 'roi_income',
                                            );
                                            $this->User_model->add('tbl_roi', $roiArr);
                                            //$this->individualPoolEntry($user['user_id'],$amount['product']);
                                            // $this->User_model->update_directs($user['sponser_id']);
                                            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,paid_status,directs,incomeLimit,capping');
                                            if($sponser['paid_status'] == 1){
                                                if($sponser['capping'] > $sponser['incomeLimit']){
                                                    $totalCredit = $sponser['incomeLimit'] + $package['direct_income'];
                                                    if($totalCredit < $sponser['capping']){
                                                        $direct_income = $package['direct_income'];
                                                    } else {
                                                        $direct_income = $sponser['capping'] - $sponser['incomeLimit'];
                                                    }
                                                    
                                                    $DirectIncome = array(
                                                        'user_id' => $user['sponser_id'],
                                                        'amount' => $direct_income,
                                                        'type' => 'direct_income',
                                                        'description' => 'Direct Income from Activation of Member ' . $user_id,
                                                    );
                                                    $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                                    $this->User_model->update('tbl_users',['user_id' => $user['sponser_id']],['incomeLimit' => ($sponser['incomeLimit'] + $DirectIncome['amount'])]);
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
                                $this->session->set_flashdata('message', '<h5 class = "text-danger">Your maximum upgrade limit is done!</h5>');
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
            redirect('App/User/login');
        }
    }

}
?>