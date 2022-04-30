<?php include_once'header.php'; ?>
<style>
@media only screen and (max-width: 1024px){
.footer {
    position: relative;
    left: 0px;
}
}
</style>

<div class="main-content">
  <div class="page-content">
<div class="container">
  <!-- Breadcrumb-->
   <div class="row pt-2 pb-2">
      <div class="col-md-12">
      <div class="panel-heading">
        <span>Add Beneficiary</span>
     <!--  <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url('Dashboard'); ?>">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Beneficiary</li>
       </ol> -->
   </div>
   </div>

   </div>
    <div class="row">
    <div class="col-lg-12">
       <div class="card">
         <div class="card-body">
         <div class="col-md-12">
            <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
            <?php 
            // if($status == 0){
            // if($user['netbanking'] == 1){                
                echo form_open('', array('id' => 'TopUpForm')); 
            ?>
             <div class="form-group">
                <label>Beneficiary Bank Name :</label>
                <input type="text" class="form-control" name="beneficiary_bank" value="<?php echo set_value('beneficiary_bank'); ?>"
                    placeholder="Beneficiary Bank Name." style="max-width: 400px" />
                <span class="text-danger"><?php echo form_error('beneficiary_bank') ?></span>
            </div>
            <div class="form-group">
                <label>Beneficiary Bank Account No. :</label>
                <input type="text" class="form-control" name="beneficiary_account_no" value="<?php echo set_value('beneficiary_account_no'); ?>"
                    placeholder="Beneficiary Bank Account No." style="max-width: 400px" />
                <span class="text-danger"><?php echo form_error('beneficiary_account_no') ?></span>
            </div>
            <div class="form-group">
                <label>Beneficiary Bank IFSC :</label>
                <input type="text" class="form-control" name="beneficiary_ifsc" value="<?php echo set_value('beneficiary_ifsc'); ?>"
                    placeholder="Beneficiary Bank IFSC" style="max-width: 400px" />
                <span class="text-danger"><?php echo form_error('beneficiary_ifsc') ?></span>
            </div>
            <div class="form-group">
                <label>Beneficiary Account Holder Name :</label>
                <input type="text" class="form-control" name="beneficiary_name" value="<?php echo set_value('beneficiary_name'); ?>"
                    placeholder="Beneficiary  Account Holder Name :" style="max-width: 400px" />
                <span class="text-danger"><?php echo form_error('beneficiary_name') ?></span>
            </div>
            <div class="form-group">
                <label>Beneficiary Bank Branch :</label>
                <input type="text" class="form-control" name="beneficiary_branch" value="<?php echo set_value('beneficiary_branch'); ?>"
                    placeholder="Beneficiary Bank Branch" style="max-width: 400px" />
                <span class="text-danger"><?php echo form_error('beneficiary_branch') ?></span>
            </div>
            <div class="form-group">
                <label>Beneficiary Mobile No. :</label>
                <input type="text" class="form-control" name="beneficiary_mobile" value="<?php echo set_value('beneficiary_mobile'); ?>"
                    placeholder="Beneficiary  Mobile No :" style="max-width: 400px" />
                <span class="text-danger"><?php echo form_error('beneficiary_name') ?></span>
            </div>
            <div class="form-group">
                <label>OTP</label>
                <input type="password" class="form-control" name="otp" placeholder="Enter OTP"
                    value="" style="max-width: 400px;" />
                <span class="text-danger"><?php  echo form_error('otp'); ?></span>
                <button type="button" class="btn btn-success" id="otp">GET OTP</button>
            </div>
            <div class="form-group">
                <button type="subimt" name="save" class="btn btn-success" />Add</button>
            </div>
            <?php echo form_close(); 
            // }else{
            //     echo 'Two Beneficiary already added!';
            // }
            
            ?>

        </div>
    </div>
</div>
</div></div></div></div></div>
<?php include'footer.php'; ?>
<script>
$(document).on('click','#otp',function(){
    var url = '<?php echo base_url('Dashboard/secureWithdraw/getOtp');?>'
    $.get(url,function(res){
        if(res.status == 1){
            $("#otp").css("display", "none");
            alert('OTP send to registered mobile number');
        }else{
            alert('Network error,please try later');
        }
    },'JSON')
})
</script>

