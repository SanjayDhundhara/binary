<?php
    defined('BASEPATH') or exit('No direct script allowed');

    class Game extends CI_Controller {

        public function __construct(){
            parent::__construct();
            $this->load->library(array('session', 'form_validation', 'security'));
            $this->load->model(array('User_model'));
            $this->load->helper(array('user'));
            if(is_logged_in() === false){
                // redirect('Dashboard/User/logout');
                // exit;
            }
        }

        public function index(){
            redirect('Dashboard/Game/register_game');
            // $REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];
            // echo $REMOTE_ADDR;
            // echo '<br>';
            // echo '<a href="'.base_url('Dashboard/User').'" style="color:red;margin-left:50%;">Go Home</a>';
            // die;
            // $userinfo = $this->User_model->get_single_record('tbl_users',['user_id' => $this->session->userdata['user_id']],'user_id,name');
            // $return_array["username"] = '11111';$userinfo['user_id']; //"your system user id";
            // $return_array["password"] = rand('100000','999999');//"user login password"; // you can send any password
            // $return_array["name"] = $userinfo['name'];//"user first name";
            // $token_hash = $this->getHash($return_array);
            // $return_array["token_hash"] = $token_hash;
            // $jsonds = $this->add_member($return_array);
            // // if user successfully register in gamex21 system then you will get the user_id in response. Next further all communication will be done with this user_id.
            // if($jsonds["status"]){
            //     $gamex_id = $jsonds["user_id"];
            //     if($gamex_id > 0){
            //         $return_array_t = array();
            //         $return_array_t["user_id"] = $gamex_id;
            //         $jsonds_t = $this->get_jw_token($return_array_t);
            //         if($jsonds_t["status"]){
            //             $token = $jsonds_t["token"]; //this today will be launch the gamex application.
            //             $this->User_model->update('tbl_users',['user_id' => $userinfo['user_id']],['game_token' => $token]);

            //         }
            //     }
            // }
        }


        public function register_game($value='')
        {
            if (is_logged_in()) {
                $response['title'] = 'Register Game';
                $response['game'] = $this->User_model->get_single_record('tbl_game_users', array('user_id' => $this->session->userdata['user_id']), '*');
                $response['user_id'] = $this->get_regiter_user_id();
                if ($this->input->server('REQUEST_METHOD') == 'POST') {

                    $data = $this->security->xss_clean($this->input->post());
                    $this->form_validation->set_rules('user_id', 'User Id', 'trim|required');
                    $this->form_validation->set_rules('name', 'Name', 'trim|required');
                    $this->form_validation->set_rules('password', 'Password', 'trim|required');
                    if ($this->form_validation->run() != FALSE) {
                        $user = $this->User_model->get_single_record('tbl_game_users', array('loggin_id' => $data['user_id']), '*');
                        if(empty($user)){
                            $return_array["username"] = $data['user_id'];//str_replace('MPY', '', $userinfo['user_id']);
                            $return_array["password"] = $data['password'];
                            $return_array["name"] = $data['name'];
                            $token_hash = $this->getHash($return_array);
                            $return_array["token_hash"] = $token_hash;
                            $jsonds = $this->add_member($return_array);
                            // pr($jsonds,1);
                            if($jsonds["status"]){
                                $gamex_id = $jsonds["user_id"];
                                if($gamex_id > 0){
                                    $return_array_t = array();
                                    $return_array_t["user_id"] = $gamex_id;
                                    $jsonds_t = $this->get_jw_token($return_array_t);
                                    if($jsonds_t["status"]){
                                        $token = $jsonds_t["token"];
                                        $this->User_model->update('tbl_users',['user_id' => $this->session->userdata['user_id']],['game_token' => $token]);
                                        $createUser = [
                                            'user_id' => $this->session->userdata['user_id'],
                                            'loggin_id' => $data['user_id'],
                                            'login_user_id' => $gamex_id,
                                            'name' => $data['name'],
                                            'password' => $data['password'],
                                            'token' => $token,
                                        ];
                                        $this->User_model->add('tbl_game_users', $createUser);
                                        $this->session->set_flashdata('message', '<h5 class="text-success">User Register Successfully!</h5>');

                                        $this->session->set_flashdata('success', '<h6 class="text-info">
                                            User Id: '.$data['user_id'].'<br>
                                            Game User Id: '.$gamex_id.'<br>
                                            Password: '.$data['password'].'<br>
                                            Name: '.$data['name'].'<br>
                                            </h6>');
                                    }else{
                                        $this->session->set_flashdata('message', '<h5 class="text-danger">Regiration Failed!</h5>');
                                    }
                                }else{
                                    $this->session->set_flashdata('message', '<h5 class="text-danger">Api Not Responding!</h5>');
                                }
                            }else{
                                $this->session->set_flashdata('message', '<h5 class="text-danger">Api Not Responding!</h5>');
                            }
                        }else{
                            $this->session->set_flashdata('message', '<h5 class="text-danger">User Already Register!</h5>');
                        }
                    }else{
                        $this->session->set_flashdata('message', '<h5 class="text-danger">'. validation_errors().'</h5>');
                       
                    }
                    redirect('Dashboard/Game/register_game/');
                }else{
                    $this->load->view('register_game', $response);
                }
        } else {
            redirect('Dashboard/User/login');
        }
        }


        


        public function game_recharge($value='')
        {
            if (is_logged_in()) {
                $response['title'] = 'Register Game';
                $response['game'] = $this->User_model->get_single_record('tbl_game_users', array('user_id' => $this->session->userdata['user_id']), '*');
                if ($this->input->server('REQUEST_METHOD') == 'POST') {
                    $data = $this->security->xss_clean($this->input->post());
                    $this->form_validation->set_rules('user_id', 'User Id', 'trim|required');
                    $this->form_validation->set_rules('amount', 'Amount', 'trim|required');
                    if ($this->form_validation->run() != FALSE) {
                        $user = $this->User_model->get_single_record('tbl_game_users', array('loggin_id' => $data['user_id']), '*');
                        if(!empty($user)){
                            $return_array_t["user_id"] = $user['login_user_id'];
                            $return_array_t["amount"] = $data['amount'];
                            $token_hash = $this->getHash($return_array_t);
                            $return_array_t["token_hash"] = $token_hash;
                            $jsonds_t = $this->fund_add_gamex($return_array_t);

                            if($jsonds_t['status'] == 1){
                                $createAmount = [
                                    'user_id' => $this->session->userdata['user_id'],
                                    'game_id' => $user['id'],
                                    'amount' => $data['amount'],
                                    'token' => $jsonds_t['token_hash'],
                                ];
                                $this->User_model->add('tbl_game_recharge', $createAmount);
                                $this->session->set_flashdata('message', '<h5 class="text-success">Fund Credit Successfully!</h5>');
                            }else{
                                $this->session->set_flashdata('message', '<h5 class="text-danger">Api Not Responding!</h5>');
                            }

                        }else{
                            $this->session->set_flashdata('message', '<h5 class="text-danger">User Not Regitered!</h5>');
                        }
                    }else{
                        $this->session->set_flashdata('message', '<h5 class="text-danger">'. validation_errors().'</h5>');
                       
                    }
                    redirect('Dashboard/Game/game_recharge/');
                }else{
                    $this->load->view('game_recharge', $response);
                }
            } else {
                redirect('Dashboard/User/login');
            }
        }


        public function game_recharge_history($value='')
        {
            if (is_logged_in()) {
                $response['title'] = 'Game Recharge History';
                $response['games'] = $this->User_model->get_records('tbl_game_recharge', array('user_id' => $this->session->userdata['user_id']), '*');
                $response['total_income'] = $this->User_model->get_single_record('tbl_game_recharge', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as total_income');
                $this->load->view('game_recharge_history', $response);

            } else {
                redirect('Dashboard/User/login');
            }
        }


        public function get_regiter_user_id($value='')
        {
            $user_id = 'murf'.rand(10000,99999);
            $user = $this->User_model->get_single_record('tbl_game_users', ['loggin_id' => $user_id],'*');
            if(!empty($user)){
                return $this->get_regiter_user_id();
            }else{
                return $user_id;
            }
        }


        public function login_token(){
            $userinfo = $this->User_model->get_single_record('tbl_users',['user_id' => $this->session->userdata['user_id']],'user_id,name,game_token');
            if(!empty($userinfo['game_token'])){
               $return_array_t["user_id"] = 'mua'.$userinfo['user_id'];
                $jsonds_t = $this->get_jw_token($return_array_t);
                $response['token'] = $jsonds_t['token'];
                if($response['token']){
                    $this->User_model->update('tbl_users',['user_id' => $userinfo['user_id']],['game_token' => $response['token']]);
                }
            }else{
                $return_array["username"] = 'mua'.$userinfo['user_id'];//str_replace('MPY', '', $userinfo['user_id']);
                $return_array["password"] = rand('100000','999999');
                $return_array["name"] = $userinfo['name'];
                $token_hash = $this->getHash($return_array);
                $return_array["token_hash"] = $token_hash;
                $jsonds = $this->add_member($return_array);
                if($jsonds["status"]){
                    $gamex_id = $jsonds["user_id"];
                    if($gamex_id > 0){
                        $return_array_t = array();
                        $return_array_t["user_id"] = $gamex_id;
                        $jsonds_t = $this->get_jw_token($return_array_t);
                        if($jsonds_t["status"]){
                            $token = $jsonds_t["token"];
                            $this->User_model->update('tbl_users',['user_id' => $userinfo['user_id']],['game_token' => $token]);
                            $response['token'] = $token;
                        }
                    }
                }
            }
            pr($jsonds_t);
            // pr($jsonds);
            die('ok');
            if(!empty($response['token'])){
                header("Location: https://www.gamex21.com/sso-login/".$response['token']);
                exit();
            }else{
                redirect('Dashboard/User/');
            }
        }


        public function getToken($user_id)
        {
            // if (is_logged_in()) {
                $user = $this->User_model->get_single_record('tbl_game_users', ['user_id' => $user_id],'*');
                if(!empty($user)){
                    $return_array_t["user_id"] = $user['login_user_id'];
                    $jsonds_t = $this->get_jw_token($return_array_t);

                    if(!empty($jsonds_t['token'])){
                        header("Location: https://www.gamex21.com/sso-login/".$jsonds_t['token']);
                        exit();
                    }else{
                        redirect('Dashboard/User/');
                    }
                }else{
                    redirect('Dashboard/Game/register_game');
                }
            // } else {
            //     redirect('Dashboard/User/login');
            // }

        }

        public function getFund(){
            //  After User Register your can send amount in Gamex21 system for this you need to call this API.
            $return_array_t = array();
            $return_array_t["user_id"] = "gamex21 ID that you get after registeration. line number 13";
            $return_array_t["amount"] = $amount;
            $token_hash = $this->getHash($return_array_t);
            $return_array_t["token_hash"] = $token_hash;
            $jsonds_t = $this->fund_add_gamex($return_array_t);
            if($jsonds_t["status"]){
            //if successfully transfer the amount in gamex21 system then here you can debit the amount from your system.
            }
        }

        // please do not make any changes in getHash function.
        private function getHash($arr){
            $arr["sourse_key"] = "4ffc4b3d2441736bf0416cac8a7614b5a2fb82fb025c1d0f9c48e47da7753361"; // this is the public token for your site please do not make changes in this.
            ksort($arr);
            $hmac_base = implode('', array_values($arr));
            $hash = md5($hmac_base);
            return $hash;
        }


        private function add_member($postDate){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://www.gamex21.com/api-add-user-murphy");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$postDate);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_TIMEOUT, 100);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
            $response = json_decode(curl_exec($ch),true);
            curl_close($ch);
            if (isset($response[0]->error)) {
                return 'ER101';
            } else {
                return $response;
            }
        }


        private function get_jw_token($postDate){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://www.gamex21.com/api-generate-token");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$postDate);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_TIMEOUT, 100);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
            $response = json_decode(curl_exec($ch),true);
            curl_close($ch);
            if (isset($response[0]->error)) {
                return 'ER101';
            } else {
                return $response;
            }
        }


        private function fund_add_gamex($postDate){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://www.gamex21.com/transfer-in-murphy");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$postDate);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_TIMEOUT, 100);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
            $response = json_decode(curl_exec($ch),true);
            curl_close($ch);
            if (isset($response[0]->error)){
                return 'ER101';
            } else {
                return $response;
            }
        }

        public function gameTransfer(){
            $REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];
            echo $REMOTE_ADDR;
            die;
            if($REMOTE_ADDR=="88.202.186.199"){
                $amount = trim($_POST["amount"]);
                $uname = trim($_POST["uname"]);
                $arr = array();
                $arr["amount"] = $amount;
                $arr["uname"] = $uname;
                $hash = $this->getHash($arr);
                $token_hash = trim($_POST["token_hash"]);
                if($hash!=$token_hash){
                    $response = array("status" => "0", "message" => "request not valid");
                    echo json_encode($response);
                    exit;
                }

                if($uname!="" && $amount!="" && $amount>0 && $token_hash!=""){
                    $user_name = trim($uname);

                    $sql_member = "SELECT * FROM user_tbl WHERE uname='".trim($user_name)."'";
                    $rs_member = db_query($sql_member);
                    $num_member = mysqli_num_rows($rs_member);
                    if($num_member > 0){
                        // credit fund in you system.
                        $response = array("status" => "1", "message" => "Amount credited successfully.");
                    } else {
                        $response = array("status" => "0", "message" => "username not found.");
                    }
                } else {
                    $response = array("status" => "0", "message" => "username and amount missing");
                }
            } else {
                $response = array("status" => "0", "message" => "Out side request not allow.");
            }
            echo json_encode($response);
            exit;
        }
    }




?>