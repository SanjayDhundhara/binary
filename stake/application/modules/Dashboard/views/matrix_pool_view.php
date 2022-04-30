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
<div class="container-fluid">
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <section class="content-header">
    <span><?php echo $header;?></span>
   </section>
   <div class="card">
    <div class="card-body">
   <div class="col-md-12">
    <h4 class="page-header">
        <small>You can see all of your all Downline</small>
    </h4>
  </div>
    <!-- END page-header -->
    <!-- BEGIN wizard -->
     <div class="col-md-12">
                  <div class="box box-solid bg-black">
      <div class="box-header with-border">
        <div class="box-tools pull-right" style="top: 4px;">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
          <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="table-responsive">
    <div id="rootwizard" class="wizard wizard-full-width">
        <!-- BEGIN wizard-header -->

        <!-- END wizard-header -->
        <!-- BEGIN wizard-form -->

            <div class="wizard-content tab-content">
                <!-- BEGIN tab-pane -->
                <div class="tab-pane active show" id="tabFundRequestForm">
                    <!-- BEGIN row -->
                    <div class="table-responsive">
                        <h2><?php echo $this->session->flashdata('message');?></h2>
                      <table class="table table-bordered table-striped dataTable" id="tableView">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>User ID</th>
                                  <th>Pool Amount</th>
                                  <th>Title</th>
                                  <th>Down members</th>
                                  <th>Winning Amount</th>
                                  <th>Next Pool</th>
                                  <th>Action</th>
                                  <th>Date</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php
                              foreach ($pools as $key => $pool) {
                                  ?>
                                  <tr>
                                      <td><?php echo ($key + 1) ?></td>
                                      <td><?php echo $pool['user_id']; ?></td>
                                      <td><?php echo $pool['pool_amount']; ?></td>
                                      <td><?php echo $pool['package_title']; ?></td>
                                      <td><?php echo $pool['level1']; ?></td>
                                      <td><?php echo $pool['winning_amount']; ?></td>
                                      <td><?php echo $pool['next_level'] == 0 ? 'Pending' : 'Clear'; ?></td>
                                      <td>
                                        <?php
                                        if($pool['next_level'] == 1 && $pool['close_status'] == 0){
                                            echo form_open('',['class' => 'upgradeForm']);
                                            echo'<input type="submit" name="method" value="withdraw">';
                                            echo form_input(['type' => 'hidden' , 'name' => 'pool_id', 'value' => $pool['id']]);
                                            echo'<input type="submit" name="method" value="Next Pool">';
                                            echo form_close();
                                        }else{
                                            if($pool['close_type'] == 'withdraw'){
                                                echo' You have withdraw this amount';
                                            }if($pool['close_type'] == 'next_pool'){
                                                echo' You Have Entered in Next Pool';
                                            }
                                        }
                                        ?>  
                                        </td>
                                      <td><?php echo $pool['created_at']; ?></td>
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






<?php include'footer1.php' ?>

<script>
    $(document).on('submit', '#upgradeForm', function() {
    if (confirm('Are You Sure U want to Upgrade This Pool')) {
        yourformelement.submit();
    } else {
        return false;
    }
})
</script>