<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session','pagination'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user'));
        date_default_timezone_set('Asia/Kolkata');
        if(is_logged_in() === false){
           redirect('Dashboard/Management/logout');
            exit;
        }
    }

    public function stakingHistory(){
        $response['header'] = 'Staking History';
        $type = $this->input->get('type');
        $value = $this->input->get('value');
        $where = ['user_id' => $this->session->userdata['user_id']];
        if(!empty($type)){
           $where=[$type => $value];
        }
        $records = $this->pagination('tbl_roi',$where,'*','Dashboard/staking-history',2,10);
        $response['path'] =  $records['path'];
        $searchField = '<div class="col-4">
                            <select class="form-control" name="type">
                                <option value="name" '.$type.' == "name" ? "selected" : "";?>
                                    Name</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="text" name="value" class="form-control text-white float-right"
                                value="'.$value.'" placeholder="Search">
                        </div>
                        <div class="col-4">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>';
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>Package Amount</th>
                                <th>Total Amount You Will Get</th>
                                <th>Per Month</th>
                                <th>Months</th>
                                <th>Date</th>
                             </tr>';
        $tbody = []; 
        $i = $records['segment'] +1; 
        $tokenValue = $this->User_model->get_single_record('tbl_token_value',['id' => 1],'amount');                  
        foreach ($records['records'] as $key => $rec) {
            extract($rec);
            // $diff = strtotime('+'.$rec['total_days'].' months', strtotime($rec['created_at'])) - strtotime(date('Y-m-d H:i:s'));
            // $timmer = '<div class="text-danger" id="timer'.$key.'"></div><script> countdown("timer'.$key.'","'.$diff.'") </script>';
            // $button =  form_open().form_hidden('orderID',$order_id).form_submit(['type' => 'submit','class' => 'btn btn-success','value' => 'Withdraw']); 
            $tbody[$key]  = ' <tr>
                                <td>'.$i.'</td>
                                <td>$'.$package.'</td>
                                <td>$'.round($roi_amount*10).'</td>
                                <td>$'.$roi_amount.'</td>
                                <td>10</td>
                                <td>'.$created_at.'</td>
                             </tr>';
                             $i++;
        }
        $response['tbody'] = $tbody;
        $this->load->view('reports',$response);
    }

    public function incomes($getType){
        $response['header'] = ucwords(str_replace('_',' ',$getType));
        $type = $this->input->get('type');
        $value = $this->input->get('value');
        $where = ['user_id' => $this->session->userdata['user_id'],'type' => $getType];
        if(!empty($type)){
           $where=[$type => $value];
        }
        $records = $this->pagination('tbl_income_wallet',$where,'*','Dashboard/Reports/incomes/'.$getType,5,10);
        $response['path'] =  $records['path'];
        $searchField = '<div class="col-4">
                            <select class="form-control" name="type">
                                <option value="name" '.$type.' == "name" ? "selected" : "";?>
                                    Name</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="text" name="value" class="form-control text-white float-right"
                                value="'.$value.'" placeholder="Search">
                        </div>
                        <div class="col-4">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>';
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>Amount</th>
                                <th>Dollar</th>
                                <th>Token Price</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Date</th>
                             </tr>';
         $tbody = []; 
         $i = $records['segment'] +1;                   
        foreach ($records['records'] as $key => $rec) {
            extract($rec);
            // $button =  form_open().form_hidden('orderID',$order_id).form_submit(['type' => 'submit','class' => 'btn btn-success','value' => 'Withdraw']); 
            $tbody[$key]  = ' <tr>
                                <td>'.$i.'</td>
                                <td>'.$amount.'</td>
                                <td>'.$dollar.'</td>
                                <td>'.$token_price.'</td>
                                <td>'.ucwords(str_replace('_',' ',$type)).'</td>
                                <td>'.$description.'</td>
                                <td>'.$created_at.'</td>
                             </tr>';
                             $i++;
        }
        $response['tbody'] = $tbody;
        $this->load->view('reports',$response);
    }

    public function incomesLedger(){
        $response['header'] = 'Income Ledger';
        $type = $this->input->get('type');
        $value = $this->input->get('value');
        $where = ['user_id' => $this->session->userdata['user_id']];
        if(!empty($type)){
           $where=[$type => $value];
        }
        $records = $this->pagination('tbl_income_wallet',$where,'*','Dashboard/Reports/incomesLedger',4,10);
        $response['path'] =  $records['path'];
        $searchField = '<div class="col-4">
                            <select class="form-control" name="type">
                                <option value="name" '.$type.' == "name" ? "selected" : "";?>
                                    Name</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="text" name="value" class="form-control text-white float-right"
                                value="'.$value.'" placeholder="Search">
                        </div>
                        <div class="col-4">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>';
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Date</th>
                             </tr>';
         $tbody = []; 
         $i = $records['segment'] +1;                   
        foreach ($records['records'] as $key => $rec) {
            extract($rec);
            // $button =  form_open().form_hidden('orderID',$order_id).form_submit(['type' => 'submit','class' => 'btn btn-success','value' => 'Withdraw']); 
            $tbody[$key]  = ' <tr>
                                <td>'.$i.'</td>
                                <td>'.$amount.'</td>
                                <td>'.ucwords(str_replace('_',' ',$type)).'</td>
                                <td>'.$description.'</td>
                                <td>'.$created_at.'</td>
                             </tr>';
                             $i++;
        }
        $response['tbody'] = $tbody;
        $this->load->view('reports',$response);
    }

    public function pagination($table,$where,$select,$base_url,$segment,$per_page){
        $config['total_rows'] = $this->User_model->get_sum($table, $where, 'ifnull(count(id),0) as sum');
        $config['base_url'] = base_url($base_url);
        $config['suffix'] = '?'.http_build_query($_GET);
        $config ['uri_segment'] = $segment;
        $config['per_page'] = $per_page;
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
        $segment = $this->uri->segment($segment);
        $records = $this->User_model->get_limit_records($table, $where, $select, $config['per_page'], $segment);
        $response=['records' => $records,'segment' => $segment,'path' => $config['base_url']];
        return $response;
    }

      public function coinHistory(){
        $response['header'] = 'Coin Wallet History';
        $type = $this->input->get('type');
        $value = $this->input->get('value');
        $where = ['user_id' => $this->session->userdata['user_id']];
        if(!empty($type)){
           $where=[$type => $value];
        }
        $records = $this->pagination('tbl_coin_wallet',$where,'*','Dashboard/Reports/incomesLedger',4,10);
        $response['path'] =  $records['path'];
        $searchField = '<div class="col-4">
                            <select class="form-control" name="type">
                                <option value="name" '.$type.' == "name" ? "selected" : "";?>
                                    Name</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="text" name="value" class="form-control text-white float-right"
                                value="'.$value.'" placeholder="Search">
                        </div>
                        <div class="col-4">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>';
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Date</th>
                             </tr>';
         $tbody = []; 
         $i = $records['segment'] +1;                   
        foreach ($records['records'] as $key => $rec) {
            extract($rec);
            // $button =  form_open().form_hidden('orderID',$order_id).form_submit(['type' => 'submit','class' => 'btn btn-success','value' => 'Withdraw']); 
            $tbody[$key]  = ' <tr>
                                <td>'.$i.'</td>
                                <td>'.$amount.'</td>
                                <td>'.ucwords(str_replace('_',' ',$type)).'</td>
                                <td>'.$description.'</td>
                                <td>'.$created_at.'</td>
                             </tr>';
                             $i++;
        }
        $response['tbody'] = $tbody;
        $this->load->view('reports',$response);
    }
}
?>