<?php

if (!function_exists('pr')) {

    function pr($array, $die = false) {
        echo'<pre>';
        print_r($array);
        echo'</pre>';
        if ($die)
            die();
    }

}
if (!function_exists('is_admin')) {

    function is_admin() {
        $ci = & get_instance();
        $ci->load->library('session');
        if (isset($ci->session->userdata['role']) && $ci->session->userdata['role'] == 'A' && !empty($ci->session->userdata['admin_id']) && $ci->session->userdata['admin_id'] == 'admin') {
            if(!empty($ci->session->userdata['guard'])){
              return true;
            }else{
              return false;
            }
        } else {
            return false;
        }
    }

}
if (!function_exists('pool_count')) {

    function pool_count() {
        $ci = & get_instance();
        $ci->load->model('Main_model');
        $pool_count = $ci->Main_model->get_single_record('tbl_pool', array(), 'max(pool_level) as pool_count');
        return $pool_count;
    }

}
if (!function_exists('calculate_rank')) {

    function calculate_rank($directs) {
        if($directs >= 100)
            $rank = 'Diamond';
        elseif($directs >= 50)
            $rank = 'Emerald';
        elseif($directs >= 25)
            $rank = 'Topaz';
        elseif($directs >= 20)
            $rank = 'Pearl';
        elseif($directs >= 15)
            $rank = 'Gold';
        elseif($directs >= 10)
            $rank = 'Silver';
        elseif($directs >= 5)
            $rank = 'Star';
        else
            $rank = 'Associate';

        return $rank;
    }
}
if (!function_exists('calculate_package')) {

    function calculate_package($package_id) {
        if($package_id == 1)
            $package = '3600';
        elseif($package_id == 2)
            $package = '1400';
        else
            $package = 'Free';
        return $package;
    }
}

if (!function_exists('incomes')) {
    function incomes() {
        $ci = & get_instance();
        $ci->load->config('config');
        $incomes = $ci->config->item('incomes');
        return $incomes;
    }
}

if (!function_exists('get_income_name')) {
    function get_income_name($income_name) {
        $ci = & get_instance();
        $ci->load->config('config');
        $incomes = $ci->config->item('getType');
        return $incomes;
        return $incomes[$income_name];
    }
}

if (!function_exists('calculate_income')) {

    function calculate_income($incomeArr) {

        $incomes = incomes();
        $income_count = array();
        $total_payout = 0;
        foreach($incomes as $key => $income){
            $income_count[$key] = 0;
            foreach($incomeArr as $arr){
                if($arr['type'] == $key){
                    $income_count[$key] = $arr['sum'];
                }
            }
            $total_payout = $income_count[$key] + $total_payout;
        }
        $income_count['total_payout']= $total_payout;
        return $income_count;
    }
}

if (!function_exists('notify_user')) {
    function notify_user($user_id, $message) {
        $ci = & get_instance();
        $ci->load->model('Main_model');
        $user = $ci->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), 'name,phone,email');
        /* for sms */
         $key = "a08f1ade94XX";
         $userkey = "gniweb2";
         $senderid = "GRAMIN";
         $baseurl = "sms.gniwebsolutions.com/submitsms.jsp?";
         $msg = urlencode($message);
         $url = $baseurl . 'user=' . $userkey . '&&key=' . $key . '&&mobile=' . $user['phone'] . '&&senderid=' . $senderid . '&&message=' . $msg . '&&accusage=1';
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_HEADER, 0);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($ch, CURLOPT_URL, $url);
         $data = curl_exec($ch);
         curl_close($ch);
         $sms_data = array('user_id' => $user_id , 'message' => $msg , 'response' => $data);
         $ci->Main_model->add('tbl_sms_counter', $sms_data);
    }
}


if (!function_exists('send_otp')) {

    function send_otp($message) {
        $ci = & get_instance();
        $ci->load->model('Main_model');
        $user_id = 'admin';
        $user = $ci->Main_model->get_single_object('tbl_users', array('user_id' => $user_id), 'name,phone,email');
        $smsCount = $ci->Main_model->get_single_record('tbl_sms_counter',array(),'count(id) as record');
        // if($smsCount['record'] <= 15000){
            $key = "a08f1ade94XX";
            $userkey = "gniweb2";
            $senderid = "GRAMIN";
            $baseurl = "sms.gniwebsolutions.com/submitsms.jsp?";

            $msg = urlencode($message);
            $url = $baseurl . 'user=' . $userkey . '&&key=' . $key . '&&mobile=+918427671570,+918728903025&&senderid=' . $senderid . '&&message=' . $msg . '&&accusage=7';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            $data = curl_exec($ch);
            curl_close($ch);
            $sms_data = array('user_id' => $user_id , 'message' => $msg , 'response' => $data);
            $ci->Main_model->add('tbl_sms_counter', $sms_data);
            /*for sms */
        // }
    }

}
