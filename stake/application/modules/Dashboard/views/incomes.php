<?php include'header.php' ?>
<div class="container-fluid pt-5">
  <div class="page-content">
<div class="container">
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <style>
    .text-success {
    color: #117622!important;
    font-size: 14px;
    font-weight: bold;
}
    </style>
    <div class="panel-heading">

        <span style="">Bonus  /  <?php echo $header; ?> ZNX <?php echo $total_income['total_income'];?></span>
    </div>

    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <div class="card">
      <div class="card-body">
    <div id="rootwizard" class="wizard wizard-full-width border-0">
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
                            <div class="box-solid">
                             
                               <div class="box-body">
                          <div class="table-responsive">
                          <table class="table table-bordered table-striped dataTable" id="tableView">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>User ID</th>
                                      <th>Amount</th>
                                      <th>Type</th>
                                      <th>Description</th>
                                      <th>Credit Date</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                  foreach ($user_incomes as $key => $income) {
                                      ?>
                                      <tr>
                                          <td><?php echo ($key + 1) ?></td>
                                          <td><?php echo $income['user_id']; ?></td>
                                          <?php 
                                          if($income['type'] == 'self_income'){
                                            $currency = 'Byeol ';
                                          }else{
                                            $currency = 'ZNX ';
                                          }
                                          ?>
                                          <td><?php echo $income['amount'] > 0 ? '<span class="text-success"> ' .$currency. $income['amount'] . '</span>' : '<span class="text-danger"> ' .$currency. $income['amount'] . '</span>'; ?></td>
                                          <td><?php echo  get_income_name($income['type']); ?></td>
                                          <td><?php echo $income['description']; ?></td>
                                          <td><?php echo $income['created_at']; ?></td>
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
    <!-- END wizard -->
  </div>
</div>
</div>
</div>
</div>






<?php include'footer.php' ?>
