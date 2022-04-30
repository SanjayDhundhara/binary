<?php include_once'header.php'; ?>
  <div class="main-content">
    <div class="page-content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <section class="content-header">
            <span class=""><?php echo $header;?></span>
          </section>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Fund Management</li>
              <li class="breadcrumb-item active"><?php echo $header;?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
    <div>
        <div class="row">
          <div class="col-md-12 card">
            <div class="card-body">
          <div class="col-md-6">
            <?php echo form_open('',array('id' => 'walletForm'));?>
            <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
            <div class="form-group">
                <label>User ID</label>
                <input type="text" class="form-control" name="user_id" value="<?php echo set_value('user_id');?>" id="user_id" placeholder="User ID"/>
                <span class="text-danger"><?php echo form_error('user_id')?></span>
                <span id="errorMessage"></span>
            </div>
            <div class="form-group">
                <label>Amount</label>
                <input type="number" class="form-control" name="amount" placeholder="Amount" value="<?php echo set_value('amount');?>"/>
                <span class="text-danger"><?php echo form_error('amount')?></span>
            </div>

            <!-- <div class="form-group">
                <label>OTP *</label>
                <input type="number" class="form-control" name="otp" placeholder="Enter OTP" value="<?php //echo set_value('otp');?>"/>
                <span class="text-danger"><?php //echo form_error('otp')?></span>
            </div> -->
            <!-- <div class="form-group">
                <a href="<?php //echo base_url('Admin/Management/adminSendWalletOtp'); ?>" class="btn btn-info">Get OTP</a>
            </div> -->
            <div class="form-group">
                <button type="subimt" name="save" class="btn btn-success" />Send</button>
            </div>
            <?php echo form_close();?>
          </div>
        </div>
      </div>
       </div>
      </div>
    </div>
  </div>
    </div>
<?php include_once'footer1.php'; ?>
<script>
  $(document).on('blur','#user_id',function(){
    var user_id = $(this).val();
    var url  = '<?php echo base_url("Admin/Management/get_user/")?>'+user_id;
    $.get(url,function(res){
      $('#errorMessage').html(res);
    })
  })
  $(document).on('submit','#walletForm',function(){
      if (confirm('Do you want to Send Fund on This Account?')) {
           yourformelement.submit();
       } else {
           return false;
       }
  })
</script>