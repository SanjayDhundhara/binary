<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email','pagination'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
    }

    public function index() {
        if (is_admin()) {
            $response['packages'] = $this->Main_model->get_records('tbl_package', array(), '*');
            $this->load->view('package_list', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function news() {
        if (is_admin()) {
            $response['news'] = $this->Main_model->get_records('tbl_news', array(), '*');
            $this->load->view('news', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function deleteNews($id) {
        if (is_admin()) {
            $get = $this->Main_model->get_single_record('tbl_news', array('id' => $id), '*');
            if(!empty($get['id'])){
                $delete = $this->Main_model->delete('tbl_news', $id);
                if($delete){
                    $this->session->set_flashdata('message', 'News Deleted Successfully!');
                }else{
                    $this->session->set_flashdata('message', 'Request not found!');
                }
            }else{
                $this->session->set_flashdata('message', 'Invaild Request ID!');
            }
            redirect('/Admin/Settings/news');
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function ResetPassword(){
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $cpassword = $data['cpassword'];
                $npassword = $data['npassword'];
                $cnpassword = $data['cnpassword'];
                $user = $this->Main_model->get_single_record('tbl_admin', array('user_id' => 'admin'), 'id,user_id,password');
                if ($npassword !== $cnpassword) {
                    // $response['message'] = 'Verify Password Doed Not Match';
                    $this->session->set_flashdata('message', 'Verify Password Does Not Match');
                } elseif ($cpassword !== $user['password']) {
                    // $response['message'] = 'Wrong Current Password';
                    $this->session->set_flashdata('message', 'Wrong Current Password');
                } else {
                    $updres = $this->Main_model->update('tbl_admin', array('user_id' =>  'admin'), array('password' => $cnpassword));
                    if ($updres == true) {
                        // $response['message'] = 'Password Updated Successfully';
                        $this->session->set_flashdata('message', 'Password Updated Successfully');
                        $response['success'] = 1;
                    } else {
                        // $response['message'] = 'There is an error while Changing Password Please Try Again';
                        $this->session->set_flashdata('message', 'There is an error while Changing Password Please Try Again');
                    }
                }
                // $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
                // $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
                // $this->form_validation->set_rules('phone', 'Phone', 'trim|numeric|required|xss_clean');
                // if ($this->form_validation->run() != FALSE) {
                //     $UserData = array(
                //         'name' => $data['name'],
                //         'email' => $data['email'],
                //         'phone' => $data['phone'],
                //     );
                //     $res = $this->Main_model->update('tbl_users', array('user_id' => $user_id),$UserData);
                //     if ($res == TRUE) {
                //         $this->session->set_flashdata('message', 'User Details Updated Successfully');
                //     } else {
                //         $this->session->set_flashdata('message', 'Error While Updating Details Please Try Again ...');
                //     }
                // }
            }
            $this->load->view('reset_password', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function EditUser($user_id) {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if($data['form_type'] == 'personal'){
                    // $this->form_validation->set_rules('otp', 'OTP', 'trim|required|numeric|xss_clean');
                    $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('direct', 'Directs', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('phone', 'Phone', 'trim|numeric|required|xss_clean');
                    $this->form_validation->set_rules('leftPower', 'Left Power', 'trim|numeric|required|xss_clean');
                    $this->form_validation->set_rules('rightPower', 'Right Power', 'trim|numeric|required|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                        // if(!empty($_SESSION['otp']) && $data['otp'] == $_SESSION['otp']){
                            $UserData = array(
                                'name' => $data['name'],
                                'email' => $data['email'],
                                'phone' => $data['phone'],
                                'directs' => $data['direct'],
                                'leftPower' => $data['leftPower'],
                                'rightPower' => $data['rightPower'],
                            );
                            $res = $this->Main_model->update('tbl_users', array('user_id' => $user_id),$UserData);
                            if ($res == TRUE) {
                                $this->session->set_flashdata('message', 'User Details Updated Successfully');
                            } else {
                                $this->session->set_flashdata('message', 'Error While Updating Details Please Try Again ...');
                            }
                        // }else {
                        //     $this->session->set_flashdata('message', 'Invaild OTP!');
                        // }
                    }
                }elseif($data['form_type'] == 'password'){
                    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                        $UserData = array(
                            'password' => $data['password']
                        );
                        $res = $this->Main_model->update('tbl_users', array('user_id' => $user_id),$UserData);
                        if ($res == TRUE) {
                            $this->session->set_flashdata('message', 'Password Updated Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Password Please Try Again ...');
                        }
                    }
                }elseif($data['form_type'] == 'master_key'){
                    $this->form_validation->set_rules('master_key', 'Transaction Password', 'trim|required|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                        $UserData = array(
                            'master_key' => $data['master_key']
                        );
                        $res = $this->Main_model->update('tbl_users', array('user_id' => $user_id),$UserData);
                        if ($res == TRUE) {
                            $this->session->set_flashdata('message', 'Transaction Password Updated Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Transaction Password Please Try Again ...');
                        }
                    }
                }elseif($data['form_type'] == 'walletAddress'){
                    $this->form_validation->set_rules('eth_address', 'Etherum Address', 'trim|required|xss_clean');
                    //$this->form_validation->set_rules('master_key', 'Transaction Password', 'trim|required|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                        $UserData = array(
                            'eth_address' => $data['eth_address']
                        );
                        $res = $this->Main_model->update('tbl_users', array('user_id' => $user_id),$UserData);
                        if ($res == TRUE) {
                            $this->session->set_flashdata('addressMessage', 'Address Updated Successfully');
                        } else {
                            $this->session->set_flashdata('addressMessage', 'Error While Updating Address Please Try Again ...');
                        }
                    }
                }else{
                    // pr($data,true);
                    $this->form_validation->set_rules('account_holder_name', 'Account Holder Name', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('bank_account_number', 'Bank Account Number', 'trim|numeric|required|xss_clean');
                    $this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('btc', 'BTC', 'trim|required|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                        $UserData = array(
                            'account_holder_name' => $data['account_holder_name'],
                            'bank_name' => $data['bank_name'],
                            'bank_account_number' => $data['bank_account_number'],
                            'ifsc_code' => $data['ifsc_code'],
                            'btc' => $data['btc'],
                            'tron' => $data['tron'],
                            'ethereum' => $data['ethereum'],
                            'litecoin' => $data['litecoin'],
                        );
                        $res = $this->Main_model->update('tbl_bank_details', array('user_id' => $user_id),$UserData);
                        if ($res == TRUE) {
                            $this->session->set_flashdata('message', 'BANK Details Updated Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Updating Bank Details Please Try Again ...');
                        }
                    }
                }
            }
            $response['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
            $response['user']['bank'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $user_id), '*');
            $this->load->view('edit_user', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function UpdateRank(){
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                $this->form_validation->set_rules('directs', 'Directs', 'trim|numeric|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), '*');
                    if(!empty($user)){
                        $res = $this->Main_model->update('tbl_users', array('user_id' => $data['user_id']),array('directs' => $data['directs']));
                        if ($res == TRUE) {
                            $this->session->set_flashdata('message', 'Rank Updated Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Updating Rank  Please Try Again ...');
                        }
                    }else{
                        $this->session->set_flashdata('message', 'Invalid user');
                    }
                }
            }
            $this->load->view('update_rank', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function CreateNews() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
                $this->form_validation->set_rules('news', 'News', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $packArr = array(
                        'title' => $data['title'],
                        'news' => $data['news'],
                    );
                    $res = $this->Main_model->add('tbl_news', $packArr);
                    if ($res == TRUE) {
                        $this->session->set_flashdata('message', 'News Added Successfully');
                    } else {
                        $this->session->set_flashdata('message', 'Error While Creating News  Please Try Again ...');
                    }
                }
            }
            $this->load->view('create_news', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function editNews($id) {
        if (is_admin()) {
            $response = array();
            $response['news'] = $this->Main_model->get_single_record('tbl_news',array('id' => trim(addslashes($id))), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
                $this->form_validation->set_rules('news', 'News', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $packArr = array(
                        'title' => $data['title'],
                        'news' => $data['news'],
                    );
                    $res = $this->Main_model->update('tbl_news',array('id' => $id), $packArr);
                    if ($res == TRUE) {
                        $this->session->set_flashdata('message', 'News Edit Successfully');
                    } else {
                        $this->session->set_flashdata('message', 'Error While Creating News  Please Try Again ...');
                    }
                    redirect('Admin/Settings/editNews/'.$id);
                }
            }
            $this->load->view('edit_news', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function token_value() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $promoArr = array(
                    'amount' => $this->input->post('token_value'),
                ); 
                $res = $this->Main_model->update('tbl_token_value', array('id' => 1),$promoArr);
                if ($res) {
                    $this->session->set_flashdata('message', 'Buy value Updated Successfully');
                } else {
                    $this->session->set_flashdata('message', 'Error While Updating Buy value Please Try Again ...');
                }                
            }
            $token_value = $this->Main_model->get_single_record('tbl_token_value', array(), '*');
            $response['token_value'] = ['amount' => $token_value['amount']];
            $response['header'] = 'Update Buy Value';
            $this->load->view('token_value', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function sellValue() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $promoArr = array(
                    'sellValue' => $this->input->post('token_value'),
                ); 
                $res = $this->Main_model->update('tbl_token_value', array('id' => 1),$promoArr);
                if ($res) {
                    $this->session->set_flashdata('message', 'Sell Value Updated Successfully');
                } else {
                    $this->session->set_flashdata('message', 'Error While Updating Sell Value Please Try Again ...');
                }                
            }
            $token_value = $this->Main_model->get_single_record('tbl_token_value', array(), '*');
            $response['token_value'] = ['amount' => $token_value['sellValue']];
            $response['header'] = 'Update Sell Value';
            $this->load->view('token_value', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function popup() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'doc|pdf|jpg|png';
                $config['file_name'] = 'am' . time();
                if($this->input->post('type') == 'image'){
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('media')) {
                        $this->session->set_flashdata('message', $this->upload->display_errors());
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                        $promoArr = array(
                            'caption' => $this->input->post('caption'),
                            'media' => $data['upload_data']['file_name'],
                            'type' => 'image'
                        ); 
                        $res = $this->Main_model->update('tbl_popup', array('id' => 1),$promoArr);
                        if ($res) {
                            $this->session->set_flashdata('message', 'Image Update Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Adding Popup Please Try Again ...');
                        }
                    }
                }else{
                    $promoArr = array(
                        'caption' => $this->input->post('caption'),
                        'media' => $this->input->post('media'),
                        'type' => 'video'
                    ); 
                    $res = $this->Main_model->update('tbl_popup', array('id' => 1),$promoArr);
                    if ($res) {
                        $this->session->set_flashdata('message', 'Image Updated Successfully');
                    } else {
                        $this->session->set_flashdata('message', 'Error While Adding Popup Please Try Again ...');
                    }
                }
                
            }
            $response['materials'] = $this->Main_model->get_records('tbl_popup', array(), '*');
            $this->load->view('popup', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function roiList() {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array($field => $value);
            // pr($where,true);
            if (empty($where[$field]))
                $where = array();
            $config['total_rows'] = $this->Main_model->get_sum('tbl_roi', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Management/users';
            $config ['uri_segment'] = 4;
            $config['per_page'] = 10;
            $config['attributes'] = array('class' => 'page-link');
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li class="paginate_button page-item ">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="paginate_button page-item  active"><a href="#" class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li class="paginate_button page-item ">';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="paginate_button page-item next">';
            $config['last_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
            $config['prev_tag_open'] = '<li class="paginate_button page-item previous">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li  class="paginate_button page-item next">';
            $config['next_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['records'] = $this->Main_model->get_limit_records('tbl_roi', $where, '*', $config['per_page'], $segment);

            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];

            $this->load->view('roi_list', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function BoosterroiList() {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array($field => $value);
            // pr($where,true);
            if (empty($where[$field]))
                $where = array();
                
            $where['booster_status'] = 1;
            $config['total_rows'] = $this->Main_model->get_sum('tbl_roi', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Management/users';
            $config ['uri_segment'] = 4;
            $config['per_page'] = 10;
            $config['attributes'] = array('class' => 'page-link');
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li class="paginate_button page-item ">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="paginate_button page-item  active"><a href="#" class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li class="paginate_button page-item ">';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="paginate_button page-item next">';
            $config['last_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
            $config['prev_tag_open'] = '<li class="paginate_button page-item previous">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li  class="paginate_button page-item next">';
            $config['next_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['records'] = $this->Main_model->get_limit_records('tbl_roi', $where, '*', $config['per_page'], $segment);

            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];

            $this->load->view('roi_list', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function popup_upload() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $data = html_escape($data);
                if ($data['type'] == 'image') {
                    if (!empty($_FILES['media']['name'])) {
                        $config['upload_path'] = './uploads/';
                        $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
                        $config['file_name'] = 'payment_slip';
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('media')) {
                            $this->session->set_flashdata('error', $this->upload->display_errors());
                        } else {
                            $fileData = array('upload_data' => $this->upload->data());
                            $fileData = array('upload_data' => $this->upload->data());
                            $userData['media'] = $fileData['upload_data']['file_name'];
                            $userData['type'] = 'image';
                            $userData['caption'] = $this->input->post('caption');
                            $updres = $this->Main_model->update('tbl_user_popup',['id' => 1],$userData);
                            if ($updres == true) {
                                $this->session->set_flashdata('error', 'Popup Uploaded Successfully');
                            } else {
                                $this->session->set_flashdata('error', 'There is an error while uploading Popup Image, Please try Again ..');
                            }
                        }
                    } else {
                        $this->session->set_flashdata('error', 'There is an error while uploading Popup Image, Please try Again ..');
                    }
                } 
            }
            $response['popup'] = $this->Main_model->get_single_record('tbl_user_popup',[],'*'); 
            $response['user'] = 1;
            $this->load->view('popup.php', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function popupSetting(){
        if(is_admin()){
            $popup = $this->Main_model->get_single_record('tbl_user_popup',[],'*'); 
            if($popup['status'] == 0){
                $status = 1;
            }else{
                $status = 0;
            }
            $this->Main_model->update('tbl_user_popup',['id' => 1],['status' => $status]);
            redirect('Admin/Settings/popup_upload');
        }else{
            redirect('Admin/Management/login');
        }
    }



    public function setHubRate(){
        if (is_admin()) {
            $response = array();
            $response['hub_rate'] = $this->Main_model->get_single_record('tbl_admin',array('id' => 1), 'hub_rate,title');

            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('rate', 'Hub Rate', 'trim|required|xss_clean|numeric');
                $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $packArr = array(
                        'title' => $data['title'],
                        'hub_rate' => $data['rate'],
                    );
                    $res = $this->Main_model->update('tbl_admin',array('id' => 1), $packArr);
                    if ($res == TRUE) {
                        $this->session->set_flashdata('message', '<h3 class="text-success">Hub Price Update Successfully!</h3>');
                    } else {
                        $this->session->set_flashdata('message', '<h3 class="text-danger">Error While Set Hub Price Please Try Again!</h3>');
                    }
                    
                }else{
                    $this->session->set_flashdata('message', validation_errors());
                }

                redirect('Admin/Settings/setHubRate');
            }

            $this->load->view('setHubRate', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function getHubRate($package = '')
    {
        if ($this->input->server('REQUEST_METHOD') == 'GET') {
            if($this->input->is_ajax_request()){
                $hub_rate = $this->Main_model->get_single_record('tbl_admin',array('id' => 1), 'hub_rate');
                $data['success'] = 1;
                $amount = $package/$hub_rate['hub_rate'];
                if($package == 100){
                    $finalAmount = $amount + $amount*0.05;
                } elseif($package == 250) {
                    $finalAmount = $amount + $amount*0.1;
                } elseif($package == 500) {
                    $finalAmount = $amount + $amount*0.15;
                } elseif($package == 1250) {
                    $finalAmount = $amount + $amount*0.2;
                } elseif($package == 2500) {
                    $finalAmount = $amount + $amount*0.25;
                } elseif($package == 5000) {
                    $finalAmount = $amount + $amount*0.3;
                } elseif($package == 10000) {
                    $finalAmount = $amount + $amount*0.5;
                } else {
                    $finalAmount = $amount;
                }

                $data['message'] = number_format(round($finalAmount),2);
            }else{
                $data['success'] = 0;
                $data['message'] = 'Invaild Request!';
            }
            echo json_encode($data);
        }else {
            redirect('Dashbord/User/login');
        }
    }

    public function zeroPin(){
        if (is_admin()) {
            $response = array();
            $response['header'] = 'Zero Pin Update';
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), '*');
                    if(!empty($user)){
                        if($user['paid_status'] == 0){
                            $res = $this->Main_model->update('tbl_users', array('user_id' => $data['user_id']),array('paid_status' => 1,'capping' => 5000));
                            if ($res == TRUE) {
                                $this->session->set_flashdata('message', 'Request Updated Successfully');
                            } else {
                                $this->session->set_flashdata('message', 'Error While Updating Please Try Again ...');
                            }
                        }else{
                            $this->session->set_flashdata('message','This User ID Already Activated!');
                        }    
                    }else{
                        $this->session->set_flashdata('message', 'Invalid user');
                    }
                }
            }
            $this->load->view('zeroPin', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

      public function update_user_business(){
        if (is_admin()) {
            $response['header'] = 'Update Business';
            $data = $this->security->xss_clean($this->input->post());
            $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|numeric|xss_clean');
            if ($this->form_validation->run() != FALSE) {
                $user = $this->Main_model->get_single_record('tbl_users',['user_id' => $data['user_id']],'*');
                if(!empty($user)){
                    $this->update_business($user_name = $data['user_id'], $downline_id = $data['user_id'], $level = 1, $business = $data['amount'], $type = 'admin') ;
                    $this->session->set_flashdata('message', 'Business Updated Successfully');
                }else{
                    $this->session->set_flashdata('message', 'Invalid User ID');
                }
            }
            $this->load->view('update_user_business', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    function update_business($user_name = 'A915813', $downline_id = 'A915813', $level = 1, $business = '40', $type = 'topup') {
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
            // $downlineArray = array(
            //     'user_id' => $user['upline_id'],
            //     'downline_id' => $downline_id,
            //     'position' => $user['position'],
            //     'business' => $business,
            //     'type' => $type,
            //     'created_at' => date('Y-m-d h:i:s'),
            //     'level' => $level,
            // );
            // $this->Main_model->add('tbl_downline_business', $downlineArray);
            $user_name = $user['upline_id'];

            if ($user['upline_id'] != '') {
                $this->update_business($user_name, $downline_id, $level + 1, $business, $type);
            }
        }
    }
}



