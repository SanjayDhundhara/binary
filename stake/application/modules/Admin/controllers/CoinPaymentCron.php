<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CoinPaymentCron extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
        date_default_timezone_set('Asia/Kolkata');
        $this->public_key = '29e70d29b2144ab39f30ce6dc9ddf25266f322c0ad5b34427a50cc3c99289c8b';
        $this->private_key = '46Af979d5A255D0ac1a67cb341E4B36Ff714cEae12ead258C523ecab56C2c820';
    }

     public function coinPaymentChecknew(){
        $cmd = 'get_tx_ids';
        $public_key = $this->public_key;
        $private_key = $this->private_key;
        $req['version'] = 1;
        $req['cmd'] = $cmd;
        $req['key'] = $public_key;
        $req['format'] = 'json';
        $post_data = http_build_query($req, '', '&');
        $hmac = hash_hmac('sha512', $post_data, $private_key);
        static $ch = NULL;
        if ($ch === NULL) {
            $ch = curl_init('https://www.coinpayments.net/api.php');
            curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: ' . $hmac));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $data = curl_exec($ch);
        $data = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);
        pr($data);
        foreach($data['result'] as $d){
            $b_transaction = $this->Main_model->get_single_record('BTC_TRANSACTION', array('transaction_id' => $d), '*');
            if(empty($b_transaction)){
                $this->getinfo22('get_tx_info', $d);
            }else{
                $this->getinfo33('get_tx_info', $d);
            }
        }
    }

    private function getinfo22($cmd = 'get_tx_info', $tax_id ='CPDI1TBAPSGQYM0DBRRDHSMTA0') {
        $public_key = $this->public_key;
        $private_key = $this->private_key;
        $req['version'] = 1;
        $req['cmd'] = $cmd;
        $req['txid'] = $tax_id;
        $req['full'] = TRUE;
        $req['key'] = $public_key;
        $req['format'] = 'json'; //supported values are json and xml
        $post_data = http_build_query($req, '', '&');
        $hmac = hash_hmac('sha512', $post_data, $private_key);
        static $ch = NULL;
        if ($ch === NULL) {
            $ch = curl_init('https://www.coinpayments.net/api.php');
            curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: ' . $hmac));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $data = curl_exec($ch);
        $data2 = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);

        //pr($data2);
        $send['transaction_id'] = $tax_id;
        $send['created_time'] = $data2['result']['time_created'];
        $send['time_expires'] = $data2['result']['time_expires'];
        $send['status'] = $data2['result']['status'];
        $send['status_text'] = $data2['result']['status_text'];
        $send['type'] = $data2['result']['type'];
        $send['coin'] = $data2['result']['coin'];
        $send['amount'] = $data2['result']['checkout']['amountf'];
        $send['amountf'] = $data2['result']['amountf'];
        $send['received'] = $data2['result']['received'];
        $send['receivedf'] = $data2['result']['receivedf'];
        $send['recv_confirms'] = $data2['result']['recv_confirms'];
        $send['payment_address'] = $data2['result']['payment_address'];
        $send['invoice'] = $data2['result']['checkout']['invoice'];
        $send['user_id'] = $data2['result']['checkout']['custom'];
        //$send['package'] = $data2['result']['checkout']['item_name'];
        $send['first_name'] = $data2['result']['checkout']['item_name'];
        $this->Main_model->add('BTC_TRANSACTION',$send);
        // if($send['status'] == 100){
        //     $amountArr = array('user_id' => $send['first_name'] ,'amount' => $send['amountf'],'transaction_id' => $send['transaction_id']);
        //     $this->Main_model->add('tbl_wallet', $amountArr);
        // }
    }

    private function getinfo33($cmd = 'get_tx_info', $tax_id ='CPDI1TBAPSGQYM0DBRRDHSMTA0') {
        $public_key = $this->public_key;
        $private_key = $this->private_key;
        $req['version'] = 1;
        $req['cmd'] = $cmd;
        $req['txid'] = $tax_id;
        $req['full'] = TRUE;
        $req['key'] = $public_key;
        $req['format'] = 'json'; //supported values are json and xml
        $post_data = http_build_query($req, '', '&');
        $hmac = hash_hmac('sha512', $post_data, $private_key);
        static $ch = NULL;
        if ($ch === NULL) {
            $ch = curl_init('https://www.coinpayments.net/api.php');
            curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: ' . $hmac));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $data = curl_exec($ch);
        $data2 = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);
        pr($data2);
        $send['created_time'] = $data2['result']['time_created'];
        $send['time_expires'] = $data2['result']['time_expires'];
        $send['status'] = $data2['result']['status'];
        $send['status_text'] = $data2['result']['status_text'];
        $send['type'] = $data2['result']['type'];
        $send['coin'] = $data2['result']['coin'];
        $send['amount'] = $data2['result']['checkout']['amountf'];
        $send['amountf'] = $data2['result']['amountf'];
        $send['received'] = $data2['result']['received'];
        $send['receivedf'] = $data2['result']['receivedf'];
        $send['recv_confirms'] = $data2['result']['recv_confirms'];
        $send['payment_address'] = $data2['result']['payment_address'];
        $send['invoice'] = $data2['result']['checkout']['invoice'];
        $send['user_id'] = $data2['result']['checkout']['custom'];
        //$send['package'] = $data2['result']['checkout']['item_name'];
        $send['first_name'] = $data2['result']['checkout']['item_name'];
        pr($send);
        $check = $this->Main_model->get_single_record('BTC_TRANSACTION',['transaction_id' => $tax_id],'*');
        if($check['status'] != 100){
            $this->Main_model->update('BTC_TRANSACTION',['transaction_id' => $tax_id],$send);
        }
        if($check['status'] == 100 && $check['walletStatus'] == 0){
            $amountArr = array('user_id' => $send['first_name'] ,'amount' => $send['amount'],'remark' => 'Transaction ID '.$tax_id,'transaction_id' => $tax_id);
            //$this->Main_model->add('tbl_wallet', $amountArr);
            $this->Main_model->update('BTC_TRANSACTION',['transaction_id' => $tax_id],['walletStatus' => 1]);
            $this->ActivateAccount($send['first_name']);
        }
    }

    private function ActivateAccount($user_id) {
        $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
        $package = $this->Main_model->get_single_record('tbl_package', array('id' => 1), '*');
        if(!empty($user)) {
            if ($user['paid_status'] == 0) {
                $topupData = array(
                    'paid_status' => 1,
                    'package_id' => $package['id'],
                    'package_amount' => $package['price'],
                    'topup_date' => date('Y-m-d H:i:s'),
                    'capping' => $package['capping']
                );
                $this->Main_model->update('tbl_users', array('user_id' => $user_id), $topupData);
                 $roiData = [
                    'user_id' => $user['user_id'],
                    'amount' => $package['commision'] * $package['days'],
                    'days' => $package['days'],
                    'roi_amount' => $package['commision'],
                ];
                $this->Main_model->add('tbl_roi', $roiData);
                $this->Main_model->update_directs($user['sponser_id']);
                $sponser = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,paid_status,directs');
                if($sponser['package_amount'] >= $package['price']){
                    $direct_income = $package['direct_income'];
                }else{
                    $sponser_package = $this->Main_model->get_single_record('tbl_package', array('id' => $sponser['package_id']), '*');
                    $direct_income = $sponser_package['direct_income'];
                }
                
                if($sponser['paid_status'] == 1){
                    $DirectIncome = array(
                        'user_id' => $user['sponser_id'],
                        'amount' => $package['direct_income'],
                        'type' => 'direct_income',
                        'description' => 'Direct Income from Activation of Member ' . $user_id,
                    );
                    $this->Main_model->add('tbl_income_wallet', $DirectIncome);
                }
                 $this->update_business($user['user_id'], $user['user_id'], $level = 1, $package['bv'], $type = 'topup');
                 $this->update_units($user['user_id'] , $user['sponser_id'], $package['commision']);
                //$this->level_income($sponser['sponser_id'], $user['user_id'], $package['level_income']);
                // if($sponser['directs'] >= 3){
                //     $checkPool = $this->Main_model->get_single_record('tbl_pool',['user_id' => $user['sponser_id']],'*');
                //     if(empty($checkPool['user_id'])){
                //         $this->pool_entry($user['sponser_id'],'tbl_pool');
                //         $debit = [
                //             'user_id' => $user['sponser_id'],
                //             'amount' => -10,
                //             'type' => 'club_upgradation',
                //             'description' => 'Club Upgrdation Deduction',
                //         ];
                //         $this->Main_model->add('tbl_income_wallet',$debit);
                //     }
                // }
            } 
        } 
    }

    private function update_business($user_name, $downline_id, $level = 1, $business, $type = 'topup') {
        $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'upline_id , position,user_id');
        if (!empty($user)) {
            if ($user['position'] == 'L') {
                $c = 'leftPower';
            } else if ($user['position'] == 'R') {
                $c = 'rightPower';
            } else {
                return;
            }
            $this->Main_model->update_business($c, $user['upline_id'], $business);
            $downlineArray = array(
                'user_id' => $user['upline_id'],
                'downline_id' => $downline_id,
                'position' => $user['position'],
                'business' => $business,
                'type' => $type,
                'created_at' => date('Y-m-d h:i:s'),
                'level' => $level,
            );
            $this->Main_model->add('tbl_downline_business', $downlineArray);
            $user_name = $user['upline_id'];

            if ($user['upline_id'] != '') {
                $this->update_business($user_name, $downline_id, $level + 1, $business, $type);
            }
        }
    }

    private function update_units($user_id , $sponser_id , $units){
        $sponser = $this->Main_model->get_single_record('tbl_users',['user_id' => $sponser_id],'user_id, units');
        if(!empty($sponser)){
            $unitArr=[
                'user_id' => $sponser_id,
                'down_id' => $user_id,
                'units' => $units,
            ];
            $this->Main_model->add('tbl_user_units', $unitArr);
            $this->Main_model->update('tbl_users', array('user_id' => $sponser_id), ['units' => $sponser['units'] + $units]);
        }
    }

    private function level_income($sponser_id, $activated_id, $package_income) {
        $incomes = explode(',', $package_income);
        foreach ($incomes as $key => $income) {
            $direct = $key+1;
            $sponser = $this->Main_model->get_single_record('tbl_users', array('user_id' => $sponser_id), 'id,user_id,sponser_id,paid_status,directs');
            if (!empty($sponser)) {
                if ($sponser['paid_status'] == 1) {
                    // if($sponser['directs'] >= $direct){
                        $LevelIncome = array(
                            'user_id' => $sponser['user_id'],
                            'amount' => $income,
                            'type' => 'level_income',
                            'description' => 'Level Income from Activation of Member ' . $activated_id . ' At level ' . ($key + 1),
                        );
                        $this->Main_model->add('tbl_income_wallet', $LevelIncome);
                    // }
                }
                $sponser_id = $sponser['sponser_id'];
            }
        }
    }

    protected function pool_entry($user_id,$table){
        $pool_upline = $this->Main_model->get_single_record($table, array('down_count <' => 10), 'id,user_id,down_count');
        if(!empty($pool_upline)){
            $poolArr =  array(
                'user_id' => $user_id,
                'upline_id' => $pool_upline['user_id'],
            );
            $this->Main_model->add($table, $poolArr);
            $this->Main_model->update($table, array('id' => $pool_upline['id']),array('down_count' => $pool_upline['down_count'] + 1));
            $this->updateTeam($user_id,$table);
            $this->poolIncome($table,$user_id,$user_id);
        }else{
            $poolArr =  array(
                'user_id' => $user_id,
                'upline_id' => '',
            );
            $this->Main_model->add($table, $poolArr);
            $this->updateTeam($user_id,$table);
            $this->poolIncome($table,$user_id,$user_id);
        }
    }

    protected function updateTeam($user_id,$table){
        $uplineID = $this->Main_model->get_single_record($table,array('user_id' => $user_id),'upline_id');
        if(!empty($uplineID['upline_id'])){
            $team = $this->Main_model->get_single_record($table,array('user_id' => $uplineID['upline_id']),'team');
            $newTeam = $team['team'] + 1;
            $this->Main_model->update($table, array('user_id' => $uplineID['upline_id']),array('team' => $newTeam));
            $this->updateTeam($uplineID['upline_id'],$table);
        }
    }

    private function poolIncome($table,$user_id,$linkedID){
        if($table == 'tbl_pool'){
            $amount = 100;
            $deduction = 40;
            $table2 = 'tbl_pool2';
            $direct = 4;
            $club = 1;
        }elseif($table == 'tbl_poo2'){
            $amount = 400;
            $deduction = 200;
            $table2 = 'tbl_pool3';
            $direct = 6;
            $club = 2;
        }elseif($table == 'tbl_poo3'){
            $amount = 2000;
            $deduction = 1000;
            $table2 = 'tbl_pool4';
            $direct = 9;
            $club = 3;
        }elseif($table == 'tbl_poo4'){
            $amount = 10000;
            $deduction = 5000;
            $table2 = 'tbl_pool5';
            $direct = 14;
            $club = 4;
        }elseif($table == 'tbl_poo5'){
            $amount = 50000;
            $deduction = 0;
            $table2 = '';
            $direct = 20;
            $club = 5;
        }

        $upline = $this->Main_model->get_single_record($table,['user_id' => $user_id],['upline_id']);
        if(!empty($upline['upline_id'])){
            $uplineInfo = $this->Main_model->get_single_record($table,['user_id' => $upline['upline_id']],'*');
            if($uplineInfo['team'] == 10){
                $userinfo = $this->Main_model->get_single_record('tbl_users',['user_id' => $upline['upline_id']],'directs');
                if($userinfo['directs'] >= $direct){
                    $incomeWallet = 'tbl_income_wallet';
                }else{
                    $incomeWallet = 'tbl_holding_wallet';
                    $credit['club'] = $club;
                    $debit['club'] = $club;
                }
                $credit = [
                    'user_id' => $uplineInfo['user_id'],
                    'amount' => $amount,
                    'type' => 'club_income',
                    'description' => 'Club Income From User '.$linkedID,
                ];
                $this->Main_model->add($incomeWallet,$credit);
                if(!empty($table2)):
                    $debit = [
                        'user_id' => $uplineInfo['user_id'],
                        'amount' => -$deduction,
                        'type' => 'club_upgradation',
                        'description' => 'Club Upgrdation Deduction',
                    ];
                    $this->Main_model->add($incomeWallet,$debit);
                    $this->pool_entry($uplineInfo['user_id'],$table2);
                endif;
            }
        }
    }

}
?>