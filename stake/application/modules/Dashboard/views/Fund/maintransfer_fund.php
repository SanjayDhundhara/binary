
<style>
    .container-scroller{
      background:#2c254a
    }
  section.content-header span {
    color: #000;
    padding: 4px 12px;
    font-weight: bold;
    background: #f5f5f5;
    width: 100%;
    display: block;
    border-radius: 4px;
  }
  .head-top {
      padding: 20px 0;
  }
  h4.page-header {
      color: #fff;
      margin:0px;
  }
  small{
      font-size: 16px;
  }
</style>

<div class="content-wrapper">
<section class="container-fluid pt-5">
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
      <div class="row">
    <section class="col-md-12 content-header">
        <span style="">Wallet Request /  Transfer Request </span>
    </section>
    </div>

    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <div class="content">
      <div class="head-top">
        <h4 class="page-header text-dark">Income Wallet To <?php echo currency; ?>-Wallet (<?php echo $wallet_amount['wallet_amount']?> <?php echo currency; ?>) </h4>
        
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
                          <?php echo form_open(); ?>
                              <div class="row">
                                  <span class="text-center">
                                      <h3><?php echo $this->session->flashdata('message');?></h3>
                                  </span>
                              </div>
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="col-md-12 form-group">
                                          <label>Amount</label>
                                          <?php
                                          echo form_input(array('type' => 'number', 'name' => 'amount', 'class' => 'form-control'));
                                          ?>
                                      </div>
                                      <!-- <div class="form-group">
                                          <label>User ID:</label>
                                          <?php
                                         // echo form_input(array('type' => 'text', 'name' => 'user_id', 'class' => 'form-control' , 'id' => 'user_id'));
                                          ?>
                                          <span class="text-danger" id="userName"></span>
                                      </div> -->
                                      <div class="col-md-12 form-group">
                                          <label>Remark:</label>
                                          <?php
                                          echo form_input(array('type' => 'text', 'name' => 'remark', 'class' => 'form-control'));
                                          ?>
                                      </div>
                                      <div class="col-md-12 form-group">
                                          <?php
                                          echo form_input(array('type' => 'submit' , 'class' => 'btn btn-success pull-right','name' => 'fundbtn','value' => 'Transfer'));
                                          ?>
                                      </div>
                                  </div>
                              </div>
                          <?php echo form_close();?>
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
  </section>
</div>













<?php $this->load->view('footer');?>
<script>
$(document).on('blur','#user_id',function(){
    var url = '<?php echo base_url("Dashboard/User/get_user/")?>'+$(this).val();
    $.get(url,function(res){
        $('#userName').html(res)
    })
})
</script>
