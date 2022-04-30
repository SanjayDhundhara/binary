<?php include'header.php' ?>
<div id="content" class="container-fluid pt-5">
<div  class="container">
    <style>
    .text-success {
        color: #117622!important;
        font-size: 14px;
        font-weight: bold;
    }
    </style>
     <div class="panel-heading">
        <span>Rewards List </span>
    </div>
    <div id="rootwizard" class="wizard wizard-full-width">
            <div class="wizard-content tab-content">
                <!-- BEGIN tab-pane -->
                <div class="tab-pane active show" id="tabFundRequestForm">
                    <!-- BEGIN row -->
                    <div class="row">
                        <!-- BEGIN col-6 -->
                        <div class="col-md-12">
                        <div class="card card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped dataTable" id="tableView">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Matching</th>
                                        <th>Left Business</th>
                                        <th>Right Business</th>
                                        <th>Bonus</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $pair = 0;
                                    foreach ($rewards as $key => $reward) {
                                        $pair += $reward['pair'];
                                        $user = $this->User_model->get_single_record('tbl_users',array('user_id' => $this->session->userdata['user_id']),'leftBusiness,rightBusiness');

                                        ?>
                                        <tr>
                                            <td><?php echo $key;?></td>
                                            <td><?php echo $reward['pair'];?></td>
                                            <td>
                                            <?php if($key > 1){
                                               if($user['leftBusiness'] > $rewards[$key-1]['team']){
                                                 $Achived_team = $user['leftBusiness']-$rewards[$key-1]['team'];
                                                  if($user['leftBusiness'] > $rewards[$key]['team']){
                                                 echo $reward['pair'];
                                                 }else{
                                                    echo $Achived_team;
                                                 }
                                            }else{
                                                echo 0;
                                             }
                                             }else{
                                                if($user['leftBusiness'] > $rewards[$key]['team']){
                                                   echo $rewards[$key]['team'];

                                               }else{
                                                  if(!empty($user['leftBusiness'])){
                                                    echo $user['leftBusiness'];
                                               }else{
                                                   echo 0;
                                                }
                                                }
                                           }  ?></td>
                                            <!-- <td><?php echo $userinfo['leftBusiness'];?></td> -->
                                            <td>
                                            <?php if($key > 1){
                                               if($user['rightBusiness'] > $rewards[$key-1]['team']){
                                                 $Achived_team = $user['rightBusiness']-$rewards[$key-1]['team'];
                                                  if($user['rightBusiness'] > $rewards[$key]['team']){
                                                    echo $reward['pair'];
                                                    }else{
                                                       echo $Achived_team;
                                                    }
                                            }else{
                                                echo 0;
                                             }
                                             }else{
                                                if($user['rightBusiness'] > $rewards[$key]['team']){
                                                   echo $rewards[$key]['team'];

                                               }else{
                                                  if(!empty($user['rightBusiness'])){
                                                    echo $user['team'];
                                               }else{
                                                   echo 0;
                                                }
                                                }
                                           }  ?></td>
                                            <!-- <td><?php echo $userinfo['rightBusiness'];?></td> -->
                                            <td><?php echo $reward['amount'];?></td>
                                            <td>
                                                <?php
                                                    if($userinfo['leftBusiness'] >= $pair && $userinfo['rightBusiness'] >= $pair):
                                                        echo '<span class ="badge badge-success">Achieved</span>';
                                                    else:
                                                        echo '<span class ="badge badge-danger">Pending</span>';
                                                    endif;
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                        </div>
                        </div>
                        <!-- END col-6 -->
                    </div>
                    <!-- END row -->
                </div>
                <!-- END tab-pane -->
                <!-- BEGIN tab-pane -->

            </div>
            <!-- END wizard-content -->

        <!-- END wizard-form -->
    </div>
    <!-- END wizard -->
</div>
</div>






<?php include'footer1.php' ?>
