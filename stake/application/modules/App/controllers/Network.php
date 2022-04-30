<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Network extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation','Binance'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user'));
        if(is_logged_in() === false){
            redirect('app-logout');
            exit;
        }
    }

    public function levelReport(){
        $response['header'] = 'Level Report';
        $response['users'] = $this->User_model->getLevelUser($this->session->userdata['user_id']);
        $this->load->view('levelReport',$response);
    }

    public function directReport($level){
        $response['header'] = 'Direct Participants';
        $response['users'] = $this->User_model->get_records('tbl_sponser_count', array('user_id' => $this->session->userdata['user_id'],'level' => $level), '*');
        foreach ($response['users'] as $key => $user) {
            $response['users'][$key]['userinfo'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['downline_id'] ), '*');
        }
        $this->load->view('levelDirect', $response);
    }
}
?>