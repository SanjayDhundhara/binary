<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email','pagination'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
    }

    public function index(){
        if(is_admin()){
            redirect('Admin/Management');
        }else{
            redirect('Admin/Management/login');
        }
    }   

    public function btcPayment() {
        if (is_admin()) {
            $response['btc'] = $this->Main_model->get_records('BTC_TRANSACTION',[], '*');
            $response['header'] = 'Coin Payment Transaction';
            $this->load->view('coinbase_report', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

     public function coinbaseTransaction() {
        if (is_admin()) {
            $response['btc'] = $this->Main_model->get_records('tbl_coinbase_transactions',[], '*');
            $response['header'] = 'Coinbase Transaction';
            $this->load->view('coinbase_list', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function ActivationHistory(){
        $response['header'] = 'Activation History';
        $type = $this->input->get('type');
        $value = $this->input->get('value');
        $where = [];
        if(!empty($type)){
           $where=[$type => $value];
        }
        $records = $this->pagination('tbl_activation_details',$where,'*','Admin/Report/ActivationHistory',4,10);
        $response['path'] =  $records['path'];
        $response['field'] = '<div class="col-4">
                                  <select class="form-control" name="type">
                                      <option value="user_id" '.$type.' == "user_id" ? "selected" : "";?>
                                          User ID</option>
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
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>User ID</th>
                                <th>Amount</th>
                                <th>Date</th>

                             </tr>';
         $tbody = []; 
         $i = $records['segment'] +1;                   
        foreach ($records['records'] as $key => $rec) {
            extract($rec);
            // $button =  form_open().form_hidden('orderID',$order_id).form_submit(['type' => 'submit','class' => 'btn btn-success','value' => 'Withdraw']); 
            $tbody[$key]  = ' <tr>
                                <td>'.$i.'</td>
                                <td>'.$user_id .'</td>
                                <td>'.$package.'</td>
                                <td>'.$topup_date.'</td>
                             </tr>';
                             $i++;
        }
        $response['tbody'] = $tbody;
        $this->load->view('report',$response);
    }

    public function pagination($table,$where,$select,$base_url,$segment,$per_page){
        $config['total_rows'] = $this->Main_model->get_sum($table, $where, 'ifnull(count(id),0) as sum');
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
        $records = $this->Main_model->get_limit_records($table, $where, $select, $config['per_page'], $segment);
        $response=['records' => $records,'segment' => $segment,'path' => $config['base_url']];
        return $response;
    }

   

}
