<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Network extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email','Binance'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user','security'));
        if(is_logged_in() === false){
            redirect('Dashboard/User/logout');
            exit;
        }
    }

    public function levelView(){
        $response['header'] = 'Magnetic Level View';
        $response['users'] = $this->User_model->getLevelMember($this->session->userdata['user_id']);
        $totalBusiness = 0;
        $totalBusiness2 = 0;
        foreach($response['users'] as $key => $user){
            $levelUser = $this->User_model->get_records('tbl_sponser_count',['user_id' => $this->session->userdata['user_id'],'level' => $user['level']],'*');
            foreach($levelUser as $key2 => $lu){
                $getBusiness = $this->User_model->get_single_record('tbl_roi',['user_id' => $lu['downline_id']],'ifnull(sum(package),0) as investment');
                $totalBusiness += $getBusiness['investment'];
                //$totalBusiness2 += $getBusiness['investment2']; 
            }
            
            $response['users'][$key]['teamBusiness'] = $totalBusiness;
            //$response['users'][$key]['teamBusiness2'] = $totalBusiness2;
            $totalBusiness = 0;
            $totalBusiness2 = 0;
        }
        $this->load->view('levelView',$response);
    }

    public function stakeLevelView(){
        $response['header'] = 'Stake Level View';
        $response['stake'] = 1;
        $response['users'] = $this->User_model->getLevelMember($this->session->userdata['user_id']);
        $totalBusiness = 0;
        $totalBusiness2 = 0;
        foreach($response['users'] as $key => $user){
            $levelUser = $this->User_model->get_records('tbl_sponser_count',['user_id' => $this->session->userdata['user_id'],'level' => $user['level']],'*');
            foreach($levelUser as $key2 => $lu){
                $getBusiness = $this->User_model->get_single_record('tbl_stack_wallet',['user_id' => $lu['downline_id']],'ifnull(sum(amount),0) as investment,ifnull(sum(investment_amount),0) as investment2');
                $totalBusiness += $getBusiness['investment'];
                $totalBusiness2 += $getBusiness['investment2'];  
            }
            $response['users'][$key]['teamBusiness'] = $totalBusiness;
            $response['users'][$key]['teamBusiness2'] = $totalBusiness2;
            $totalBusiness = 0;
            $totalBusiness2 = 0;
        }
        $this->load->view('levelView',$response);
    }

    // public function levelView(){
    //     $response['header'] = 'Magnetic Level View';
    //     $response['users'] = $this->User_model->getLevelMember($this->session->userdata['user_id']);
    //     foreach($response['users'] as $key => $user){
    //         $response['users'][$key]['teamBusiness'] = $this->User_model->getLevelBusiness($this->session->userdata['user_id'],$user['level']);
    //     }
    //     $response['userinfo'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'directs');
    //     $this->load->view('levelView',$response);
    // }

    public function levelDetails($level){
        $response['users'] = $this->User_model->get_records('tbl_sponser_count',['user_id' => $this->session->userdata['user_id'],'level' => $level],'*');
        foreach($response['users'] as $key => $user){
            $response['users'][$key]['userinfo'] = $this->User_model->get_single_record('tbl_users',['user_id' => $user['downline_id']],'*');
            $response['users'][$key]['business'] = $this->User_model->get_single_record('tbl_roi',['user_id' => $user['downline_id']],'ifnull(sum(package),0) as business');
        }
        $this->load->view('levelDetails',$response);
    }

    // public function stakeLevelView(){
    //     $response['header'] = 'Stake Level View';
    //     $response['users'] = $this->User_model->getLevelMember($this->session->userdata['user_id']);
    //     $response['stake'] = 1;
    //     $response['userinfo'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'directs');
    //     foreach($response['users'] as $key => $user){
    //         $response['users'][$key]['teamBusiness'] = $this->User_model->getStakeLevelBusiness($this->session->userdata['user_id'],$user['level']);
    //     }
    //     $this->load->view('levelView',$response);
    // }

    public function stakeLevelDetails($level){
        $response['stake'] = 1;
        $response['users'] = $this->User_model->get_records('tbl_sponser_count',['user_id' => $this->session->userdata['user_id'],'level' => $level],'*');
        foreach($response['users'] as $key => $user){
            $response['users'][$key]['userinfo'] = $this->User_model->get_single_record('tbl_users',['user_id' => $user['downline_id']],'*');
            $response['users'][$key]['business'] = $this->User_model->get_single_record('tbl_stack_wallet',['user_id' => $user['downline_id']],'ifnull(sum(amount),0) as business,ifnull(sum(investment_amount),0) as investment2');
        }
        $this->load->view('levelDetails',$response);
    }
}

?>