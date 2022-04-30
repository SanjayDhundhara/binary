<?php 
$this->load->view('header');
//include_once APPPATH.'modules/Dashboard/views/header.php'; ?>
<div class="main-content">
  <div class="page-content">
<div class="container-fluid">
  <!-- Breadcrumb-->
   <div class="row pt-2 pb-2">
      <div class="col-sm-9">
      <h4 class="page-title"><?php echo $header; ?></h4>
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url('Dashboard'); ?>">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo $header; ?></li>
       </ol>
   </div>

   </div>

  <div id="rootwizard" class="wizard wizard-full-width">
          <div class="wizard-content tab-content">
              <div class="tab-pane active show" id="tabFundRequestForm">
            <h3 class="text-danger"><?php echo $this->session->flashdata('error'); ?></h3>
            <?php
            // if($user['netbanking'] == 0){

                echo form_open('', array('id' => 'TopUpForm'));
            ?>
            <div class="form-group">
                <label>OTP</label>
                <input type="text" class="form-control" name="otp" value="<?php echo set_value('otp'); ?>"
                    placeholder="OTP" style="max-width: 400px" />
                <span class="text-danger"><?php echo form_error('otp') ?></span>
            </div>
            <div class="form-group">
                <button type="subimt" name="save" class="btn btn-success" />Activate</button>
            </div>
            <?php echo form_close();
            echo'<a class="btn btn-success" href="'.base_url('Dashboard/StagingWithdraw/resendSenderOtp').'">Resend OTP</a>';
            // }else{
            //     echo'Banking is Activate';
            // }

            ?>

        </div></div>
    </div>
</div>
<?php 
$this->load->view('footer');
//include_once APPPATH.'modules/Dashboard/views/footer.php'; ?>
