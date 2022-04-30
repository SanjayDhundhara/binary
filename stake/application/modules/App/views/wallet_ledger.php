<style>
    table {
        color: #000 !important;
    }
    .card{
        background: transparent;
        box-shadow: 0px 0px 10px rgb(64 43 140);
    }
    .head-top-heading h4, small {
        color: #000;
    }

    .text-danger {
    color: white !important;
    font-size: 15px;
    font-weight: bold;
    background: #ff9100;
    padding: 5px;
    margin: 20px 0px 0px 0px;
    float: right;
}
.text-success {
    background: green !important;
    color: white !important;
    font-size: 15px;
    font-weight: bold;
    padding: 5px;
    margin: 20px 0px 0px 0px;
    float: right;
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
       <h4 class="panel-title">Activate Account History</h4>
    </div>
   
    <!-- END page-header -->
    <!-- BEGIN wizard -->


     <div class="mt-4" >
          <div class="">
            <div class="head-top-heading mb-4">
                  <h4 class="page-header" style="margin:0px">
        <?php echo'Wallet Ledger';?>(ZIL.<?php echo $wallet_amount['wallet_amount'];?>)</h4>
        
            </div>
           
             <?php
                foreach ($records as $key => $record) {
                    ?>

                     <div class="boxesmain">
                      <div style="float: left;font-weight:bold;color:#000;width: 75%;text-transform: capitalize;">
                            User id: <?php echo $record['user_id']; ?>
                          <p>Date: <?php echo $record['created_at']; ?></p>
                          <p style="font-weight: normal;color: #000;font-weight: 600;"><?php echo ucwords(str_replace('_', ' ', $record['type'])); ?></p>
                      </div>
                          <div style="float: right;width:25%;text-align: right;"> 
                            <span class="text-<?php echo $record['amount'] > 0 ? 'success' : 'danger';?>">Zil <?php echo $record['amount']; ?></span>
                          </div>
                    </div>

            <?php
                }
                    ?>
    <div id="rootwizard" class="wizard wizard-full-width" >
        <!-- BEGIN wizard-header -->

        <!-- END wizard-header -->
        <!-- BEGIN wizard-form -->

            <div class="wizard-content tab-content" >
                <!-- BEGIN tab-pane -->
                <div class="tab-pane active show" id="tabFundRequestForm">
                    <!-- BEGIN row -->
                     <div class="box box-solid bg-black">
                              
                               <div class="box-body" style="display:none;">
                    <div class="table-responsive">
                        <!-- BEGIN col-6 -->
                        <table class="table table-bordered table-striped dataTable" id="tableView">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User ID</th>
                                    <th>Amount</th>
                                    <th>Sender ID</th>
                                    <th>Type</th>
                                    <th>Remark</th>
                                    <th>CreatedAt</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($records as $key => $record) {
                                    ?>
                                    <tr>
                                        <td><?php echo ($key + 1) ?></td>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo $record['sender_id']; ?></td>
                                        <td></td>
                                        <td><?php echo $record['remark']; ?></td>
                                        <td></td>
                                    </tr>
                                    <?php
                                }
                                ?>

                            </tbody>
                        </table>
                        <!-- END col-6 -->
                    </div>
                </div>
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
</div>

    <!-- END wizard -->
</div>
</div>
</div>
<?php  $this->load->view('footer');?>

