<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
        date_default_timezone_set('Asia/Kolkata');
    }

    public function index() {

    }

    public function freeUser(){
        $users = $this->Main_model->get_records('tbl_users',['paid_status' => 1],'user_id,package_amount,topup_date');
        foreach($users as $user):
            $cycleData = $this->Main_model->get_single_record('tbl_deactivation_details',['user_id' => $user['user_id']],'count(id) as record');
            $userinfo = $this->Main_model->get_single_record('tbl_income_wallet',['user_id' => $user['user_id'],'created_at >=' => $user['topup_date']],'ifnull(sum(amount),0) as balance');
            
            $incomeLimit = $user['package_amount']*3;
            if($userinfo['balance'] >= $incomeLimit){
                $deactive = [
                    'paid_status' => 0,
                    'package_id' => 0,
                    'package_amount' => 0,
                    'topup_date' => '0000-00-00 00:00:00',
                    'incomeLimit2' => 0,
                ];
                $this->Main_model->update('tbl_users',['user_id' => $user['user_id']],$deactive);
                $activeData = [
                    'user_id' => $user['user_id'],
                    'deactivater' => 'auto',
                    'package' => $user['package_amount'],
                    'topup_date' => $user['topup_date'],
                ];
                pr($activeData);
                $this->Main_model->add('tbl_deactivation_details',$activeData);
            }
        endforeach;
    }

    public function sapphireIncome(){
        $date1 = date('Y-m-d');
        $cron = $this->Main_model->get_single_record('tbl_cron',['date' => $date1,'cron_name' => 'sapphireIncome'],'*');
        if(empty($cron)){
            $this->Main_model->add('tbl_cron',['cron_name' => 'sapphireIncome','date' => $date1]);
            $date = date('Y-m-d',strtotime(date('Y-m-d').' 0 days'));
            $users = $this->Main_model->get_records('tbl_income_wallet',"amount > '0' and type != 'direct_sponsor_leadership' and date(created_at) = '".$date."' GROUP BY user_id",'ifnull(sum(amount),0) as todayIncome,user_id');
            foreach($users as $key => $user){
                if($user['todayIncome'] > 0){
                    pr($user);
                    $getSponsor = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user['user_id']),'user_id,sponser_id');
                    if(!empty($getSponsor)){
                        $perID = $user['todayIncome']*0.05;
                        $incomeArr = array(
                            'user_id' => $getSponsor['sponser_id'],
                            'amount' => $perID,
                            'type' => 'direct_sponsor_leadership',
                            'description' => 'Direct Sponsor Leadership Income From User '.$user['user_id'],
                        );
                        pr($incomeArr);
                        $this->Main_model->add('tbl_income_wallet', $incomeArr);
                    }
                }
            }
        } else {
            echo 'Today Cron already run';
        }
    }

    public function roiCron(){
        // if(date('D') == 'Sun' || date('D') == 'Sat'){
        //     die('its weekend');
        // }
        $date = date('Y-m-d');
        $cron = $this->Main_model->get_single_record('tbl_cron',['date' => $date,'cron_name' => 'roiCron'],'*');
        if(empty($cron)){
            $this->Main_model->add('tbl_cron',['cron_name' => 'roiCron','date' => $date]);
            $roi_users = $this->Main_model->get_records('tbl_roi', array('days >' => 0), '*');
            $tokenValue = $this->Main_model->get_single_record('tbl_token_value',['id' => 1],'amount');
            foreach($roi_users as $key => $user){
                $date1 = date('Y-m-d H:i:s');
                $date2 = date('Y-m-d H:i:s',strtotime($user['creditDate'].'+ 30 days'));
                $diff = strtotime($date1) - strtotime($date2);
                echo $diff.' / '.$user['user_id'].'<br>';
                if($diff >= 0){
                    $userinfo = $this->Main_model->get_single_record('tbl_users',['user_id' => $user['user_id']],'incomeLimit,incomeLimit2');
                    // if($userinfo['incomeLimit2'] > $userinfo['incomeLimit']){
                    //     $totalCredit = $userinfo['incomeLimit'] + $user['roi_amount'];
                    //     if($totalCredit < $userinfo['incomeLimit2']){
                            $roi_amount = $user['roi_amount'];
                        // } else {
                        //     $roi_amount = $userinfo['incomeLimit2'] - $userinfo['incomeLimit'];
                        // }
                        $new_day = $user['days'] - 1;
                        $days = ($user['total_days']+1) - $user['days'];
                        $incomeArr = array(
                            'user_id' => $user['user_id'],
                            'amount' => $roi_amount, ///$tokenValue['amount'],
                            'type' => 'daily_roi_income',
                            'description' => 'Daily '.ucwords(str_replace('_',' ',$user['type'])).' Income at day '.$days,
                        );
                        pr($incomeArr);
                        $this->Main_model->add('tbl_income_wallet', $incomeArr);
                        //$this->Main_model->update('tbl_users',['user_id' => $user['user_id']],['incomeLimit' => ($userinfo['incomeLimit'] + $incomeArr['amount'])]);
                        // $coinCredit = array(
                        //     'user_id' => $user['user_id'],
                        //     'amount' => $roi_amount*0.3, ///$tokenValue['amount'],
                        //     'type' => 'staking_income',
                        //     'description' => 'Daily Staking Income at day '.$days,
                        // );
                        // $this->Main_model->add('tbl_coin_wallet', $coinCredit);
                        $this->Main_model->update('tbl_roi', array('id' => $user['id']), array('days' => $new_day, 'amount' => ($user['amount'] - $user['roi_amount']),'creditDate' => date('Y-m-d')));
                        $sponsor = $this->Main_model->get_single_record('tbl_users',['user_id' => $user['user_id']],'sponser_id');
                      //  $this->roiLevelIncome($sponsor['sponser_id'],$user['user_id'],$roi_amount);
                    //}
                }
            }
            //$this->boosterCron();
        } else {
            echo 'Today cron already run';
        }
    }

    private function roiLevelIncome($user_id,$linkedID,$amount){
        for($i=1;$i<=21;$i++){
            if($i == 1){
                $incomeArr[$i] = ['amount' => 0.3,'direct' => 1];
            } elseif($i == 2){
                $incomeArr[$i] = ['amount' => 0.2,'direct' => 2];
            } elseif($i == 3){
                $incomeArr[$i] = ['amount' => 0.1,'direct' => 3];
            } elseif($i == 4){
                $incomeArr[$i] = ['amount' => 0.05,'direct' => 4];
            } elseif($i == 5){
                $incomeArr[$i] = ['amount' => 0.04,'direct' => 5];
            } elseif($i >= 6 && $i <= 10){
                $incomeArr[$i] = ['amount' => 0.01,'direct' => 9];
            } elseif($i >= 11 && $i <= 20){
                $incomeArr[$i] = ['amount' => 0.005,'direct' => 12];
            } elseif($i == 21){
                $incomeArr[$i] = ['amount' => 0.05,'direct' => 15];
            }
        }
        $tokenValue = $this->Main_model->get_single_record('tbl_token_value',['id' => 1],'amount');
        foreach($incomeArr as $key => $income):
            //$direct = $directArr[$key];
            $userinfo = $this->Main_model->get_single_record('tbl_users',['user_id' => $user_id],'user_id,sponser_id,directs,incomeLimit,incomeLimit2');
            if(!empty($userinfo['user_id'])):
                if($userinfo['directs'] >= $income['direct']):
                    // if($userinfo['incomeLimit2'] > $userinfo['incomeLimit']){
                    //     $totalCredit = $userinfo['incomeLimit'] + ($amount*$income['amount']);
                    //     if($totalCredit < $userinfo['incomeLimit2']){
                            $level_income = ($amount*$income['amount']);
                        // } else {
                        //     $stakeing_level_income = $userinfo['incomeLimit2'] - $userinfo['incomeLimit'];
                        // }
                        $creditIncome = [
                            'user_id' => $userinfo['user_id'],
                            'amount' => $level_income,
                            'type' => 'level_income',
                            'description' => 'Level Income from User '.$linkedID.' at level '.$key,
                        ];
                        $this->Main_model->add('tbl_income_wallet',$creditIncome);
                        //$this->Main_model->update('tbl_users',['user_id' => $userinfo['user_id']],['incomeLimit' => ($userinfo['incomeLimit'] + $creditIncome['amount'])]);
                        // $coinCredit = array(
                        //     'user_id' => $userinfo['user_id'],
                        //     'amount' => $stakeing_level_income*0.3, ///$tokenValue['amount'],
                        //     'type' => 'stakeing_level_income',
                        //     'description' => 'Staking Level Income from User '.$linkedID.' at level '.$key,
                        // );
                        // $this->Main_model->add('tbl_coin_wallet', $coinCredit);
                    //}
                endif;
                $user_id = $userinfo['sponser_id'];
            endif;
        endforeach;
    }

    public function boosterCron(){
        if(date('D') != 'Sun'){
            $roi_users = $this->Main_model->get_records('tbl_roi', array('amount >' => 0 , 'type' => 'direct_booster_income','days >' => 0), '*');
            foreach($roi_users as $key => $user){
                $date1 = date('Y-m-d H:i:s');
                $date2 = date('Y-m-d H:i:s',strtotime($user['created_at'].'+ 1 days'));
                $diff = strtotime($date1) - strtotime($date2);
                if($diff >= 0){
                    $new_day = $user['days'] - 1;
                    $days = 21 - $user['days'];
                    $incomeArr = array(
                        'user_id' => $user['user_id'],
                        'amount' => $user['roi_amount'],
                        'type' => 'direct_boost_income',
                        'description' => 'Direct Booster Income at '.$new_day . ' Day',
                    );
                    pr($incomeArr);
                    $this->Main_model->add('tbl_income_wallet', $incomeArr);
                    $this->Main_model->update('tbl_roi', array('id' => $user['id']), array('days' => $new_day, 'amount' => ($user['amount'] - $user['roi_amount'])));
                    $sponsor = $this->Main_model->get_single_record('tbl_users',['user_id' => $user['user_id']],'sponser_id');
                    $this->levelIncome($sponsor['sponser_id'],$user['user_id']);
                }

            }
        }
    }

    public function point_match_cron() {
        $response['users'] = $this->Main_model->get_records('tbl_users', '(leftPower >= 1 and rightPower >= 1 and directs >= 0) OR (leftPower >= 1 and rightPower >= 1  and directs >= 0)', 'id,user_id,sponser_id,leftPower,rightPower,package_amount,package_id,capping,incomeLimit,directs');
        foreach ($response['users'] as $user) {
            pr($user);
            $package = $this->Main_model->get_single_record_desc('tbl_package', array('id' => $user['package_id']), '*');
            $user_match = $this->Main_model->get_single_record_desc('tbl_point_matching_income', array('user_id' => $user['user_id']), '*');
            $position_directs = $this->Main_model->count_position_directs($user['user_id']);
            if(!empty($position_directs) && count($position_directs) == 2){
                if (!empty($user_match)) {
                    if ($user['leftPower'] > $user['rightPower']) {
                        $old_income = $user['rightPower'];
                    } else {
                        $old_income = $user['leftPower'];
                    }
                    if ($user_match['left_bv'] > $user_match['right_bv']) {
                        $new_income = $user_match['right_bv'];
                    } else {
                        $new_income = $user_match['left_bv'];
                    }
                    $income = ($old_income - $new_income);
                    $match_bv = $income;
                    $carry_forward = abs($user['leftPower'] - $user['rightPower']);

                    $user_income = $income * $package['binary'];
                    if ($user_income > 0) {
                        $matchArr = array(
                            'user_id' => $user['user_id'],
                            'left_bv' => $user['leftPower'],
                            'right_bv' => $user['rightPower'],
                            'amount' => $user_income,
                            'match_bv' => $match_bv,
                            'carry_forward' => $carry_forward,
                        );
                        $this->Main_model->add('tbl_point_matching_income', $matchArr);
                        if($user['capping'] < $user_income){
                            $user_income = $user['capping'];
                        }
                        // if($user['capping'] > $user['incomeLimit']){
                        //     $totalCredit = $user['incomeLimit'] + $user_income;
                        //     if($totalCredit < $user['capping']){
                                $matching_income = $user_income;
                            // } else {
                            //     $matching_income = $user['capping'] - $user['incomeLimit'];
                            // }

                            $incomeArr = array(
                                'user_id' => $user['user_id'],
                                'amount' => $matching_income,
                                'type' => 'matching_bonus',
                                'description' => 'Point Matching Bonus'
                            );
                            $this->Main_model->add('tbl_income_wallet', $incomeArr);
                            $this->Main_model->update('tbl_users',['user_id' => $user['user_id']],['incomeLimit' => ($user['incomeLimit'] + $incomeArr['amount'])]);
                        //}
                        $this->generation_income($user['sponser_id'],$matching_income, $user['user_id']);
                        //  $this->sponsers_directs_bonus($user['user_id'] , $user_income * 10/100);
                        // $this->direct_sponser_income(($user_income * 5 / 100), $user['directs'], $user['user_id']);
                        pr($matchArr);
                    }
                } else {
                    if ($user['leftPower'] > $user['rightPower']) {
                        $leftPower = $user['leftPower'] - 0;
                        $rightPower = $user['rightPower'];
                    } else {
                        $rightPower = $user['rightPower'] -0;
                        $leftPower = $user['leftPower'];
                    }
                    if($leftPower > $rightPower){
                        $income = $rightPower;

                    }else{
                        $income = $leftPower;
                    }
                    $match_bv = $income;
                    $carry_forward = abs($leftPower - $rightPower);

                    $user_income = $income * $package['binary'];
                    //                echo $user_income;
                    if($user['capping'] < $user_income){
                        $user_income = $user['capping'];
                    }
                    $matchArr = array(
                        'user_id' => $user['user_id'],
                        'left_bv' => $user['leftPower'],
                        'right_bv' => $user['rightPower'],
                        'amount' => $user_income,
                        'match_bv' => $match_bv,
                        'carry_forward' => $carry_forward,
                    );
                    $this->Main_model->add('tbl_point_matching_income', $matchArr);
                    // if($user['capping'] > $user['incomeLimit']){
                    //     $totalCredit = $user['incomeLimit'] + $user_income;
                        // if($totalCredit < $user['capping']){
                            $matching_income = $user_income;
                        // } else {
                        //     $matching_income = $user['capping'] - $user['incomeLimit'];
                        // }

                        $incomeArr = array(
                            'user_id' => $user['user_id'],
                            'amount' => $matching_income,
                            'type' => 'matching_bonus',
                            'description' => 'Point Matching Bonus'
                        );
                        $this->Main_model->add('tbl_income_wallet', $incomeArr);
                        $this->Main_model->update('tbl_users',['user_id' => $user['user_id']],['incomeLimit' => ($user['incomeLimit'] + $incomeArr['amount'])]);
                    //}
                    $this->generation_income($user['sponser_id'],$matching_income, $user['user_id']);
                    //$this->sponsers_directs_bonus($user['user_id'] , $user_income * 10/100);
                    pr($matchArr);
                }
            }
        }
        pr($response);
        die('code executed Successfully');
    }

    private function generation_income($user_id , $amount , $sender_id ){
        $incomeArr = [0.1];
        foreach($incomeArr as $key => $income){
            $user = $this->Main_model->get_single_record('tbl_users',['user_id' => $user_id],'user_id,sponser_id,package_amount,paid_status');
            if(!empty($user)){
                $incomeArr = array(
                    'user_id' => $user['user_id'],
                    'amount' => $amount * $income,
                    'type' => 'direct_matching_income',
                    'description' => 'Direct Income Matching From ' .$sender_id.' at level '.($key+1),
                );
                $this->Main_model->add('tbl_income_wallet', $incomeArr);
                $user_id = $user['sponser_id'];
            }
        }
    }


    private function levelIncome($user_id,$linkedID){
        $direct = 0;
        for($i=1;$i<= 20;$i++):
            if($i%2 != 0){
                $direct += 1;
            }
            $incomeArr[$i] = ['amount' => 10 ,'direct' => $direct];
        endfor;
        foreach($incomeArr as $key => $income):
            $userinfo = $this->Main_model->get_single_record('tbl_users',['user_id' => $user_id],'user_id,sponser_id,directs');
            if(!empty($userinfo['user_id'])):
                if($userinfo['directs'] >= $income['direct']):
                    $incomeArr = array(
                        'user_id' => $userinfo['user_id'],
                        'amount' => $income['amount'],
                        'type' => 'booster_level_income',
                        'description' => 'Booster Level Income From User '.$linkedID,
                    );
                    pr($incomeArr);
                    $this->Main_model->add('tbl_income_wallet', $incomeArr);
                endif;
                $user_id = $userinfo['sponser_id'];
            endif;
        endforeach;

    }

    public function deactiveUser(){
        $users = $this->Main_model->get_records('tbl_users',['user_id !=' => 'T11111' ,'paid_status' => 1],'user_id,package_id,package_amount,topup_date');
        foreach($users as $user):
            $date1 = date('Y-m-d');
            $date2 = date('Y-m-d',strtotime($user['topup_date'].' + 20 days'));
            $diff = strtotime($date1) - strtotime($date2);
            if($diff > 0){
                $topupData = [
                    'paid_status' => 0,
                    'package_id' => 0,
                    'package_amount' => 0,
                    'topup_date' => '0000-00-00 00:00:00',
                    'retopup' => 1,
                ];
                $this->Main_model->update('tbl_users',['user_id' => $user['user_id']],$topupData);
            }
        endforeach;
    }

    public function rewardCron(){
        $rewards = [
            1 => ['business' => '5000','amount' => 100],
            2 => ['business' => '10000','amount' => 250],
            3 => ['business' => '20000','amount' => 500],
            4 => ['business' => '50000','amount' => 1000],
            5 => ['business' => '100000','amount' => 2500],
            6 => ['business' => '500000','amount' => 10000],
            7 => ['business' => '2500000','amount' => 50000],
            8 => ['business' => '5000000','amount' => 100000],
            9 => ['business' => '10000000','amount' => 250000],
            10 =>['business' => '50000000','amount' => 1000000],
        ];
        foreach($rewards as $key => $reward){
            $users = $this->Main_model->getBusiness($reward['business']);
            //$users = $this->Main_model->get_records('tbl_users',['leftBusiness >=' => $reward['pair'],'rightBusiness >=' => $reward['pair']],'user_id');
            //pr($users,true);
            foreach($users as $key2 => $user){
                $check = $this->Main_model->get_single_record('tbl_rewards',['award_id' => $key,'user_id' => $user['user_id']],'*');
                if(empty($check)){
                    // $position_directs = $this->Main_model->count_position_directs($user['user_id']);
                    // if(!empty($position_directs) && count($position_directs) == 2){
                        // pr($user);
                        // if($key > 5){
                        //     $d = 2;
                        //     $direct2 = $this->Main_model->get_single_record('tbl_users',['sponser_id' => $user['user_id'],'rewardLevel' => ($key - 1)],'count(id) as direct');
                        // } else {
                        //     $direct2 = 0;
                        //     $d = 0;
                        // }
                        //if($direct2['direct'] >= $d){
                            $rewardData = [
                                'user_id' => $user['user_id'],
                                'amount' => $reward['amount'],
                                'award_id' => $key,
                            ];
                            $this->Main_model->add('tbl_rewards',$rewardData);
                            pr($rewardData);
                            $IncomeData = [
                                'user_id' => $user['user_id'],
                                'amount' => $reward['amount'],
                                'type' => 'reward_income',
                                'description' => 'You have Achieved your '.$key.' Reward Income ',
                            ];
                            pr($IncomeData);
                            $this->Main_model->add('tbl_income_wallet',$IncomeData);
                            $this->Main_model->update('tbl_users',['user_id' => $user['user_id']],['rewardLevel' => $key]);
                        //}
                    //}
                }

            }

        }

    }

    public function resetDailyLimit(){
        $date = date('Y-m-d');
        $cron = $this->Main_model->get_single_record('tbl_cron',['date' => $date,'cron_name' => 'resetDailyLimit'],'*');
        if(empty($cron)){
            $this->Main_model->update('tbl_users',['incomeLimit >' => 0],['incomeLimit' => 0]);
            $this->Main_model->add('tbl_cron',['cron_name' => 'resetDailyLimit','date' => $date]);
        } else {
            echo 'Today daily limit reset done';
        }
    }

    public function resetPackageLimit(){
        $date = date('Y-m-d');
        $users = $this->Main_model->get_records('tbl_users',['paid_status' => 1,'retopup' => 0],'user_id,package_amount,retopup_count');
        foreach($users as $user){
            $checkBalance = $this->Main_model->get_single_record('tbl_income_wallet',['amount >' => 0,'user_id' => $user['user_id']],'ifnull(sum(amount),0) as balance');
            $totalBalance = $checkBalance['balance'];
            if($totalBalance >= ($user['package_amount']*5)){
                pr($user);
                $this->Main_model->update('tbl_users',['user_id' => $user['user_id']],['retopup' => 1,'package_amount' => 0,'topup_date' => '0000-00-00 00:00:00','retopup_count' => ($user['retopup_count'] + 1)]);
            }

        }
    }

    public function approveFund(){
        $request = $this->Main_model->get_records('tbl_payment_request', array('status' => 0), '*');
        foreach($request as $key => $req){
            if($req['status'] == 0){
                $walletData = array(
                        'user_id' => $req['user_id'],
                        'amount' => $req['amount'],
                        'sender_id' => $req['user_id'],
                        'type' => 'auto_fund',
                        'remark' => 'Auto Fund Deposit',
                    );
                pr($walletData);
                    $this->Main_model->add('tbl_wallet', $walletData);
                    $this->Main_model->update('tbl_payment_request',['id' => $req['id']],['status' => 1]);

            }
        }
    }

    public function WithdrawCron(){
        $date = date('Y-m-d');
        $cron = $this->Main_model->get_single_record('tbl_cron',"cron_name = 'withdraw_cron' and date = '".$date."'",'*');
        if(empty($cron)):
            $users = $this->Main_model->withdraw_users(1);
            pr($users);
            foreach($users as $key => $user){
                //$checkKYC = $this->Main_model->get_single_record('tbl_bank_details',['user_id' => $user['user_id']],'*');
                $userinfo = $this->Main_model->get_single_record('tbl_users',['user_id' => $user['user_id']],'*');
                //if(!empty($checkKYC['bank_account_number'])):
                    $DirectIncome = array(
                        'user_id' => $user['user_id'],
                        'amount' => - $user['total_amount'] ,
                        'type' => 'withdraw_request',
                        'description' => 'Withdraw Request',
                    );
                    $this->Main_model->add('tbl_income_wallet', $DirectIncome);
                    $withdrawArr = array(
                        'user_id' => $user['user_id'],
                        'amount' => $user['total_amount'] ,
                        'type' => 'withdraw_request',
                        'tds' => $user['total_amount']* 0 /100,
                        'admin_charges' => $user['total_amount']  * 0 /100,
                        'fund_conversion' => 0,
                        'zil_address' => $userinfo['eth_address'],
                        'payable_amount' => $user['total_amount'] * 100 /100
                    );
                    $this->Main_model->add('tbl_withdraw', $withdrawArr);
                //endif;
            }
            $this->Main_model->add('tbl_cron',['cron_name' => 'withdraw_cron','date' => $date]);
        else:
            echo 'Today Cron already run';
        endif;
    }

    public function updateTokenValue(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.vindax.com/api/v1/ticker/24hr?symbol=MPYUSDT',
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
        $jsonData = json_decode($response,true);
        pr($jsonData['lastPrice']);
        $this->Main_model->update('tbl_token_value',['id' => 1],['amount' => $jsonData['lastPrice'],'sellValue' => $jsonData['lastPrice']]);
    }

    public function test_node_api(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://18.216.195.54:3490/',
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
        $jsonData = json_decode($response,true);
        pr($jsonData);
    }
}
