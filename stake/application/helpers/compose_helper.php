<?php
    if(!function_exists('composeMail')){ 
        function composeMail($email,$header,$subject,$message,$display=false){
            if(!empty($email)){
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.mailjet.com/v3.1/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'{
                    "Messages": [
                        {
                            "From": {
                                "Email": "manishgni20@gmail.com",
                                "Name": "'.title.'"
                            },
                            "To": [
                                {
                                    "Email": "'.$email.'",
                                    "Name": "'.title.'"
                                }
                            ],
                            "Subject": "'.$subject.'",
                            "TextPart": "'.$header.'",
                            

                            "HTMLPart": "<div style=\' background: #000; margin:auto; max-width:500px;\'><center><img style=\'max-width:200px;margin: 0;border-radius: 10px;\' src=\'https://oxbin.io/stacking/uploads/logo.png\' alt=\'logo\'><br><h3 style=\'color:#fff;\'>'.$message.'</h3><div style=\'font-size:20px;font-weight: bold; color:#45aed7; margin-top:20px\'><a href=\'https://oxbin.io/stacking\' style=\'background-color:#17b824; color:#fff;width: 100%; font-weight:normal; border-radius: 4px;  display: block;\'>Click here to login</a></div></center></div>"
                        }
                    ]
                }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Username: 1ff47bac7e7c884454b6d51eee799375',
                    'Password: 6fe3d8a9b6a45c0d194d45da3ee2c12f',
                    'Authorization: Basic MWZmNDdiYWM3ZTdjODg0NDU0YjZkNTFlZWU3OTkzNzU6NmZlM2Q4YTliNmE0NWMwZDE5NGQ0NWRhM2VlMmMxMmY='
                ),
                ));

                $response = curl_exec($curl);
                curl_close($curl);
                $data2 = json_decode($response);
                $status = ($data2->Messages[0]->Status);
                if(!empty($status)){
                    if($status == 'error'){
                        $errors = ($data2->Messages[0]->Errors);
                        $data['success'] = 0;
                        $data['message'] = $errors[0]->ErrorMessage;
                    }else{
                        $data['success'] = 1;
                        $data['message'] = 'Mail Sent Successfully';

                    }
                    $data['response'] = $response;
                }
            }
            if($display == true){
                echo json_encode($data);
            }
        }
    }

?>