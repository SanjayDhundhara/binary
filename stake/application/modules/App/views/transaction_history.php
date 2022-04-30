<?php include'header.php' ?>

<style>
  span.bg-successs {
    background: green;
    color: #fff;
    padding: 5px 14px;
    border-radius: 4px;
}
.withdraw-bg {
  border: 1px #dddcdc solid;
  border-radius: 5px;
  margin-top: 20px;
}
.withdraw-amount {
    width: 39%;
    text-align: center;
    background: #03657e;
    height: 100%;
    display: inline-block;
    min-height: 100%;
}
.withdraw-address {
  width: 59%;
  display: inline-block;
  padding-left: 15px;
}
.withdraw-address p {
    font-size: 14px;
    margin-bottom: 0px;
    color: #000;
    font-weight: 500;
}
.withdraw-amount span {
    padding: 4px 0;
    color: #fff;
}
.withdraw-amount h4 {
     color: #fff;
    align-items: center;
    justify-content: center;
    vertical-align: middle;
    display: flex;
} 
.withdraw-amount p {
    background: #024252;
    color: #fff;
    margin: 0px;
    padding: 12px 0;
}
.withdraw-amount span {
    display: block;
    margin-top: 7px;
}
</style>
<div class="main-content">
  <div class="page-content">
<div class="container">
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <div class="panel-heading">
        <span style="">Withdraw Request  /   Withdraw History</span>
    </div>

    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <div class="">
      <div class="">
          <?php
                                  foreach ($transactions as $key => $transaction) {
                                      if($transaction['status'] == 0)
                                          $status = '<span style="color:red; font-weight:bold">Pending</span>';
                                      elseif($transaction['status'] == 1)
                                          $status = '<span style="color:green; font-weight:bold">Approved</span>';
                                      elseif($transaction['status'] == 2)
                                          $status = '<span style="color:yellow; font-weight:bold">Rejected</span>';
                                      ?>
        <div class="withdraw-bg text-dark">
          <div class="withdraw-amount">
            <span>Amount</span>
            <h4>  <?php echo $transaction['amount']; ?></h4>
          
            <p>Credit Date  <span><?php echo $transaction['created_at']; ?></span></p>
          </div>
          
          <div class="withdraw-address">
            <p>User Id :  <?php echo $transaction['user_id']; ?></p>
            <p>Type : <?php echo ucwords(str_replace('_', ' ', $transaction['type'])); ?></p>
            <p>Admin Charges : <?php echo $transaction['admin_charges']; ?></p>
            <p>Payable Amount : <?php echo $transaction['payable_amount']; ?></p>
            <p>Description : <?php echo $transaction['remark']; ?></p>
            <p>Status : <?php echo $status; ?></p>
            
          </div>
          
        </div>
 <?php
                                  }
                                  ?>
     <!--    <div class="boxesmain">
                      <div style="float: left;font-weight:bold;color:#000;width: 75%;text-transform: capitalize;">
                          
                           <p></p>
                           <p>Status: </p>
                           <p>Admin Charges: </p>
                           <p>Payable Amount:</p>
                          <p style="font-weight: normal;color: #000;font-weight: 600;"></p>
                      </div>
                          <div style="float: right;width:25%;text-align: right;"> 
                            <span class="bg-successs "></span>
                          </div>
                    </div> -->
                        

    <div id="rootwizard" class="wizard wizard-full-width">
        <!-- BEGIN wizard-header -->

        <!-- END wizard-header -->
        <!-- BEGIN wizard-form -->

            <div class="wizard-content tab-content">
                <!-- BEGIN tab-pane -->
                <div class="tab-pane active show" id="tabFundRequestForm">
                    <!-- BEGIN row -->
                    <div class="row">
                        <!-- BEGIN col-6 -->
                        <div class="col-md-12" style="display: none;">
                           <div class="box box-solid bg-black">
                               <div class="box-body">
                          <div class="table-responsive">
                          <table class="table table-bordered table-striped dataTable" id="tableView">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>User ID</th>
                                      <th>Amount</th>
                                      <th>Type</th>
                                      <th>Status</th>

                                      <th>Deductions</th>
                                      <!-- <th>TDS</th> -->
                                      <th>Payable Amount</th>
                                      <th>Description</th>
                                      <th>Credit Date</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                  foreach ($transactions as $key => $transaction) {
                                      if($transaction['status'] == 0)
                                          $status = '<span style="color:blue; font-weight:bold">Pending</span>';
                                      elseif($transaction['status'] == 1)
                                          $status = '<span style="color:green; font-weight:bold">Approved</span>';
                                      elseif($transaction['status'] == 2)
                                          $status = '<span style="color:red; font-weight:bold">Rejected</span>';
                                      ?>
                                      <tr>
                                          <td><?php echo ($key + 1) ?></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>

                                          <td></td>
                                          <!-- <td><?php //echo $transaction['tds']; ?></td> -->
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                      </tr>
                                      <?php
                                  }
                                  ?>

                              </tbody>
                          </table>
                        </div>
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
  </div>
    <!-- END wizard -->
</div>
</div>
</div>
</div>



<?php include'footer.php' ?>
