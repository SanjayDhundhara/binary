<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AdminActivation extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin'));
        date_default_timezone_set('Asia/Kolkata');
        $this->exceptionCase = '';
        if(is_admin() === false) {
            redirect('Admin/logout');
            exit;
        }
    }

     public function index() {
        $response['header'] = 'Account Activation';
        $response['tokenValue'] = $this->Main_model->get_single_record('tbl_token_value',['id' => 1],'amount');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            $this->form_validation->set_rules('user_id', 'User ID', 'trim|required');
            $this->form_validation->set_rules('package_id', 'Package', 'trim|required|numeric');
            if ($this->form_validation->run() != FALSE) {
                $user_id = $data['user_id'];
                $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                $package = $this->Main_model->get_single_record('tbl_package', array('id' => $data['package_id']), '*');
                if (!empty($user)) {
                        if ($user['paid_status'] == 0) {
                                $topupData = array(
                                    'paid_status' => 1,
                                    'package_id' => 1,
                                    'package_amount' => $package['price'],
                                    'total_package' => $user['total_package'] + $package['price'],
                                    'topup_date' => date('Y-m-d H:i:s'),
                                    'capping' => $package['capping'],
                                    'incomeLimit2' => $user['incomeLimit2'] + ($package['price']*2.2),
                                );
                                $this->Main_model->update('tbl_users', array('user_id' => $user_id), $topupData);
                                $this->Main_model->update_directs($user['sponser_id']);

                                $activationData = [
                                    'user_id' => $user_id,
                                    'activater' => 'admin',
                                    'package' => $package['price'],
                                    'topup_date' => date('Y-m-d H:i:s'),
                                ];
                                $this->Main_model->add('tbl_activation_details',$activationData);
                                
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
                                $this->Main_model->add('tbl_roi', $roiArr);

                                $coinCredit = array(
                                    'user_id' => $user['user_id'],
                                    'amount' => $package['price']/$response['tokenValue']['amount'],
                                    'type' => 'self_coin',
                                    'description' => 'Self Coin from Activation of Member ' . $user_id,
                                );
                                $this->Main_model->add('tbl_coin_wallet', $coinCredit);

                                $this->royaltyAchiever($user['sponser_id'],$package['price']);
                                $this->updateBusiness($user['sponser_id'],'team_business',1);
                                $this->updateBusiness($user['sponser_id'],'team_business_plan',$package['price']);
                                
                                // $message = 'Dear User your account is successfully activated with amount '.$package['price'].' by User '.$this->session->userdata['user_id'];
                                // composeMail($user['email'],'Activation','Activation',$message,$display=false);
                                $this->session->set_flashdata('message', '<h3 class = "text-success">Account Activated Successfully </h3>');
                        } else {
                            $this->session->set_flashdata('message', '<h3 class = "text-danger">This Account Already Acitvated </h3>');
                        }
                } else {
                    $this->session->set_flashdata('message', '<h3 class = "text-danger">Invalid User ID </h3>');
                }
            }
        }
        $response['packages'] = $this->Main_model->get_records('tbl_package', array(), '*');
        $this->load->view('admin-activation', $response);
    }

    private function royaltyAchiever($user_id){
        $userDetail = $this->Main_model->get_single_record('tbl_users',['user_id' => $user_id],'directs,topup_date,royalty_status,package_amount');
        $direct = $this->Main_model->get_single_record('tbl_users',['sponser_id' => $user_id,'package_amount >=' => $userDetail['package_amount']],'count(id) as direct');
        $date1 = date('Y-m-d H:i:s');
        $date2 = date('Y-m-d H:i:s',strtotime($userDetail['topup_date'].'+10 days'));
        $diff1 = strtotime($date2) - strtotime($date1); 
        if($diff1 > 0){
            $package = $this->Main_model->get_single_record('tbl_package', array('price' => $userDetail['package_amount']), '*');
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
                $this->Main_model->add('tbl_roi', $roiArr);
                $this->Main_model->update('tbl_users',['user_id' => $user_id],['royalty_status' => 1]);
            }
        }
    }

    private function level_income($sponser_id, $activated_id, $package_income) {
        $incomes = explode(',', $package_income);
        // $incomes = array(70,35,30,25,20,15,10,5,5);
        foreach ($incomes as $key => $income) {
            $direct = $key+1;
            $sponser = $this->Main_model->get_single_record('tbl_users', array('user_id' => $sponser_id), 'id,user_id,sponser_id,paid_status,directs');
            if (!empty($sponser)) {
                if ($sponser['paid_status'] == 1) {
                    if($sponser['directs'] >= $direct){
                        $LevelIncome = array(
                            'user_id' => $sponser['user_id'],
                            'amount' => $income,
                            'type' => 'level_income',
                            'description' => 'Level Income from Activation of Member ' . $activated_id . ' At level ' . ($key + 1),
                        );
                        $this->Main_model->add('tbl_income_wallet', $LevelIncome);
                    }
                }
                $sponser_id = $sponser['sponser_id'];
            }
        }
    }

    private function updateBusiness($user_id,$field,$business){
        $userinfo = $this->Main_model->get_single_record('tbl_users',['user_id' => $user_id],'user_id,sponser_id');
        if(!empty($userinfo['user_id']) && $userinfo['user_id'] != 'none'){
            $this->Main_model->update_business($field,$userinfo['user_id'],$business);
            $this->updateBusiness($userinfo['sponser_id'],$field,$business);
        }
    }

    private function update_business($user_name, $downline_id, $level = 1, $power, $business, $type) {
        $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'upline_id , position,user_id');
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
            $this->Main_model->update_business($c, $user['upline_id'], $power);
            $this->Main_model->update_business($d, $user['upline_id'], $business);
            $downlineArray = array(
                'user_id' => $user['upline_id'],
                'downline_id' => $downline_id,
                'position' => $user['position'],
                'business' => $business,
                'type' => $type,
                'created_at' => date('Y-m-d H:i:s'),
                'level' => $level,
            );
            $this->Main_model->add('tbl_downline_business', $downlineArray);
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
        $sponsorID = $this->Main_model->get_single_record('tbl_users',['user_id' => $user_id],'sponser_id');
        $pool_upline = $this->Main_model->get_single_record($table, array('user_id' => $sponsorID['sponser_id'],'down_count <' => 3), 'user_id');
        //pr($pool_upline,true);
        if($pool_upline['user_id'] == ''){
            $uplineID = $this->get_pool_upline($sponsorID['sponser_id'],$table,$org);
        }else{
            $uplineID = $pool_upline['user_id'];
        }
        $userinfo = $this->Main_model->get_single_record($table,['user_id' => $uplineID],'down_count');
        $poolArr = [
            'user_id' => $user_id,
            'upline_id' => $uplineID,
        ];
        //pr($poolArr,true);
        $this->Main_model->add($table, $poolArr);
        $this->Main_model->update($table, array('user_id' => $uplineID),['down_count' => ($userinfo['down_count'] + 1)]);
        $this->updateTeam($user_id,$table);
        $this->update_pool_downline($uplineID,$user_id,$level = 1,$table,$org);
        $this->poolIncome($table,$user_id,$user_id,$org,3,1,$amount);
    }

      protected function updateTeam($user_id,$table,$org){
        $uplineID = $this->Main_model->get_single_record($table,array('user_id' => $user_id,'org' => $org),'upline_id');
        if(!empty($uplineID['upline_id'])){
            $team = $this->Main_model->get_single_record($table,array('user_id' => $uplineID['upline_id'],'org' => $org),'team');
            $newTeam = $team['team'] + 1;
            $this->Main_model->update($table, array('user_id' => $uplineID['upline_id'],'org' => $org),array('team' => $newTeam));
            $this->updateTeam($uplineID['upline_id'],$table,$org);
        }
    }

        public function update_pool_downline($upline_id,$user_id,$level,$table,$org){
        $user = $this->Main_model->get_single_record($table, array('user_id' => $upline_id), $select = 'user_id,upline_id');
        if(!empty($user['user_id'])){
            $pool_downArr = [
                'user_id' => $user['user_id'],
                'downline_id' => $user_id,
                'level' => $level,
                'org' => $org,
            ];
            $this->Main_model->add('tbl_pool_downline', $pool_downArr);
            $this->update_pool_downline($user['upline_id'],$user_id,$level + 1,$table,$org);
        }
    }

    private function poolIncome($table,$user_id,$linkedID,$org,$team,$level,$amount){
        $upline = $this->Main_model->get_single_record($table,['user_id' => $user_id],['upline_id']);

        if(!empty($upline['upline_id'])){
            $checkTeam = $this->Main_model->get_single_record('tbl_pool_downline',['user_id' => $upline['upline_id'],'level' => $level,'org' => $org],'count(id) as team');
            if($checkTeam['team'] == $team){
                $creditSIncome = [
                    'user_id' => $upline['upline_id'],
                    'amount' => $amount,
                    'type' => 'working_pool',
                    'description' => 'Working Pool Income from User '.$linkedID,
                ];
                $this->Main_model->add('tbl_income_wallet',$creditSIncome);

                $debitIncome = [
                    'user_id' => $upline['upline_id'],
                    'amount' => -$amount,
                    'type' => 'upgradation_deduction',
                    'description' => 'Working Pool Income from User '.$linkedID,
                ];
                $this->Main_model->add('tbl_income_wallet',$debitIncome);
                
            }else{
                $creditIncome = [
                    'user_id' => $upline['upline_id'],
                    'amount' => $amount,
                    'type' => 'working_pool',
                    'description' => 'Working Pool upgradation deduction',
                ];
                $this->Main_model->add('tbl_income_wallet',$creditIncome);
            }
            $level += 1;
            $team *= 3;
            $this->poolIncome($table,$upline['upline_id'],$linkedID,$org,$team,$level,$amount);
        }  
    }

    public function upgradePool(){
        if($this->input->server("REQUEST_METHOD") == "POST"){
            $data = $this->security->xss_clean($this->input->post());
            $package = $this->Main_model->get_single_record('tbl_package',['id' => $data['product']],'direct_income,products');
            $user_id = $this->session->userdata['user_id'];
            $this->globlePoolEntry($user_id,$package['products'],1);
            $debit = [
                'user_id' => $user_id,
                'amount' => -($package['direct_income']*2),
                'type' => 'upgrade_deduction',
                'description' => 'Pool Upgrade Deduction',
            ];
            $this->Main_model->add('tbl_income_wallet',$debit);
        }
        redirect('Dashboard/User');
    }

    protected function globlePoolEntry($user_id,$table,$org){
        if($table == 'tbl_pool'){$amount = 20;}
        elseif($table == 'tbl_pool2'){$amount = 400;}
        elseif($table == 'tbl_pool3'){$amount = 2000;}
        elseif($table == 'tbl_pool4'){$amount = 5000;}
        $pool_upline = $this->Main_model->get_single_record($table, array('down_count <' => 2,'org' => $org), 'id,user_id,down_count');
        if(!empty($pool_upline)){
            $poolArr =  array(
                'user_id' => $user_id,
                'upline_id' => $pool_upline['user_id'],
                'org' => $org,
            );
            $this->Main_model->add($table, $poolArr);
            $this->Main_model->update($table, array('id' => $pool_upline['id'],'org' => $org),array('down_count' => $pool_upline['down_count'] + 1));
            $this->updateTeam($user_id,$table,$org);
            $this->poolIncome2($table,$user_id,$user_id,$org);
        }else{
            $poolArr =  array(
                'user_id' => $user_id,
                'upline_id' => '',
                'org' => $org,
            );
            $this->Main_model->add($table, $poolArr);
            $this->updateTeam($user_id,$table,$org);
            $this->poolIncome2($table,$user_id,$user_id,$org);
        }
    }

    private function poolIncome2($table,$user_id,$linkedID,$org){
        $poolDetails = $this->poolDetails($table);
        $poolData = $poolDetails[$org];
        $upline = $this->Main_model->get_single_record($table,['user_id' => $user_id],['upline_id']);
        if(!empty($upline['upline_id'])){
            $checkTeam = $this->Main_model->get_single_record($table,['user_id' => $upline['upline_id']],'team');
            if($checkTeam['team'] == 2){
                $creditIncome = [
                    'user_id' => $upline['upline_id'],
                    'amount' => $poolData['amount'],
                    'type' => 'pool_income',
                    'description' => 'Pool Income from level '.$org,
                ];
                $this->Main_model->add('tbl_income_wallet',$creditIncome);
                $creditIncome = [
                    'user_id' => $upline['upline_id'],
                    'amount' => -$poolData['amount'],
                    'type' => 'upgrade_deduction',
                    'description' => 'Pool Upgrade Deduction',
                ];
                $this->Main_model->add('tbl_income_wallet',$creditIncome);
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
        $users = $this->Main_model->get_records('tbl_sponser_count',"downline_id = '".$user_id."' and user_id != 'none' ORDER BY level ASC",'user_id');
        foreach($users as $user){
            $check = $this->Main_model->get_single_record($table,['user_id' => $user['user_id']],'user_id');
            if(!empty($check['user_id'])){
                $check2 = $this->Main_model->get_single_record($table,['user_id' => $user['user_id'],'down_count <' => 3],'user_id');
                $this->exceptionCase = $check2['user_id'];
                if(!empty($check2['user_id'])){
                    return $check2['user_id'];
                    break;
                }
            }
        }
    }

    private function get_pool_upline($sponser_id,$table,$org){
        $users = $this->Main_model->get_records('tbl_pool_downline',"user_id = '".$sponser_id."' and org = '".$org."' ORDER BY level,created_at ASC",'downline_id');
        if(!empty($users)){
            foreach($users as $key => $user){
                $check = $this->Main_model->get_single_record($table,['user_id' => $user['downline_id'],'down_count <' => 3],'user_id');
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

}
?>