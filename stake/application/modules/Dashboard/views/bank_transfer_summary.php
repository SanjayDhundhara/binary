<?php include'header.php' ?>
<div class="container-fluid ">
  <div class="page-content">
<div class="container">
<div class="content-header">
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <div class="panel-heading">
        <spna style="">Withdraw Request </spna> /   Withdraw summary
    </div>
    <!-- END page-header -->
    <!-- BEGIN wizard -->
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
                    <div class="col-md-12">
                    <div class="card card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped dataTable" id="tableView">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User ID</th>
                                    <th>Beneficiary ID</th>
                                    <th>Order ID</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Transaction ID</th>
                                    <th>UTR</th>
                                    <th>Deducted Amount</th>
                                    <th>Transfer Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($transactions as $key => $transaction) {
                                    ?>
                                    <tr>
                                        <td><?php echo ($key + 1) ?></td>
                                        <td><?php echo $transaction['user_id']; ?></td>
                                        <td><?php echo $transaction['beneficiaryid']; ?></td>
                                        <td><?php echo $transaction['orderid']; ?></td>
                                        <td>Rs.<?php echo $transaction['amount']; ?></td>
                                        <td><?php echo $transaction['status']; ?></td>
                                        <td><?php echo $transaction['joloorderid']; ?></td>
                                        <td><?php echo $transaction['operatortxnid']; ?></td>
                                        <td>RS.<?php echo $transaction['payable_amount']; ?></td>
                                        <td><?php echo $transaction['created_at']; ?></td>
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
</div>
</div>



<?php include'footer.php' ?>
