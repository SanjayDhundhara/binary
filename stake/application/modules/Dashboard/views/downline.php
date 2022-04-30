<?php include'header.php' ?>
<style>
 section.content-header {
    background-color: #e0e0e0;
    padding: 10px;
    font-size: 20px;
    margin: 21px 0px;
    border-radius: 10px;
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
    <span>My All Downline</span>
   </div>
   <div class="card">
    <div class="card-body">
   <div class="col-md-12">
    <h4 class="page-header">
        <small>You can see all of your all Downline</small>
    </h4>
  </div>
    <!-- END page-header -->
    <!-- BEGIN wizard -->
     <div class="">
                  <div class="box box-solid bg-black">
      
      <div class="box-body">
        <div class="table-responsive">
    <div id="rootwizard" class="wizard wizard-full-width">
        <!-- BEGIN wizard-header -->

        <!-- END wizard-header -->
        <!-- BEGIN wizard-form -->

            <div class="wizard-content tab-content p-0">
                <!-- BEGIN tab-pane -->
                <div class="tab-pane active show" id="tabFundRequestForm">
                    <!-- BEGIN row -->
                    <div class="table-responsive">

                      <table class="table table-bordered table-striped dataTable" id="tableView">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Name</th>
                                  <th>User ID</th>
                                  <th>Sponser ID</th>
                                  <th>Position</th>
                                  <th>Joining Date</th>
                                  <th>Level</th>
                                  <th>Package</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php
                              foreach ($users as $key => $user) {
                                  ?>
                                  <tr>
                                      <td><?php echo ($key + 1) ?></td>
                                      <td><?php echo $user['user']['name']; ?></td>
                                      <td><?php echo $user['user']['user_id']?></td>
                                      <td><?php echo $user['user']['sponser_id']; ?></td>
                                      <td><?php echo $user['user']['position']; ?></td>
                                      <td><?php echo $user['user']['created_at']; ?></td>
                                      <td><?php echo $user['level']; ?></td>
                                      <td><?php echo $user['user']['package_amount']; ?></td>
                                  </tr>
                                  <?php
                              }
                              ?>

                          </tbody>
                      </table>
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
    </div>
    </div>
    <!-- END wizard -->
</div>
</div>
</div>
</div>
</div>
</div>






<?php include'footer.php' ?>
