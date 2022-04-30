<?php include'header.php' ?>
<div id="content" class="content">
<div class="container">
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
     <div class="panel-heading">
        <span style="">Withdraw Request/   Withdraw summary </span> 
    </div>
  
    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <div id="rootwizard" class="wizard wizard-full-width mt-4">
        <!-- BEGIN wizard-header -->

        <!-- END wizard-header -->
        <!-- BEGIN wizard-form -->

            <div class="wizard-content tab-content">
                <!-- BEGIN tab-pane -->
                <div class="tab-pane active show" id="tabFundRequestForm">
                    <!-- BEGIN row -->
                    <div class="row">
                        <!-- BEGIN col-6 -->
                        <div class="col-md-6">
                          <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>User ID</th>
                                      <th>Amount</th>
                                      <th>Status</th>
                                      <th>Remark</th>
                                      <th> Date</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                  foreach ($withdraw_transctions as $key => $transaction) {
                                      ?>
                                      <tr>
                                          <td><?php echo ($key + 1) ?></td>
                                          <td><?php echo $transaction['user_id']; ?></td>
                                          <td>$<?php echo $transaction['amount']; ?></td>
                                          <td><?php
                                              if($transaction['status'] == 0){
                                                  echo'Pending';
                                              }elseif($transaction['status'] == 1){
                                                  echo'Approved';
                                              }elseif($transaction['status'] == 2){
                                                  echo'Rejected';
                                              }
              //                                echo $transaction['status'];
                                              ?></td>
                                          <td><?php echo $transaction['remark']; ?></td>
                                          <td><?php echo $transaction['created_at']; ?></td>
                                      </tr>
                                      <?php
                                  }
                                  ?>

                              </tbody>
                          </table>
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




<?php include'footer.php' ?>
