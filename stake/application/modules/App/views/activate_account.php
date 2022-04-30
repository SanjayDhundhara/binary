<?php include_once'header.php'; ?>
<style>
    .card{
        background: transparent;
        box-shadow: 0px 0px 10px rgb(64 43 140);
    }
    h4.page-header span {
        color: #000;
    }
    .form-group label{
        color: #000;
    }
</style>

<div class="main-content ">

    <div class="page-content">
        <div class="container">

    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->

   
<div class="panel-heading">
                          <h4 class="panel-title">Activate your Account</h4>
                                                              </div>
 


    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <div class="card mt-4">
                                   <div class="card-body">
      <h4 class="page-header">
        <span style=""> Wallet balance (ZIL. <?php echo $wallet['wallet_balance']; ?>)</span><br>


    </h4>

        <!-- BEGIN wizard-header -->

        <!-- END wizard-header -->
        <!-- BEGIN wizard-form -->

        <div class="wizard-content tab-content p-0">
            <!-- BEGIN tab-pane -->
            <div class="tab-pane active show" id="tabFundRequestForm">
                <!-- BEGIN row -->
                <div class="col-md-12 p-0">
                    <!-- BEGIN col-6 -->
                    <?php echo form_open('', array('id' => 'TopUpForm')); ?>
                    <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
                    <div class="form-group">
                        <label>User ID</label>
                        <input type="text" class="form-control" id="user_id" name="user_id"
                            value="<?php echo set_value('user_id'); ?>" placeholder="User ID"
                            style="max-width: 400px" />
                        <span class="text-danger"><?php echo form_error('user_id') ?></span>
                        <span class="text-danger" id="errorMessage"></span>
                    </div>
                    <div class="form-group">
                        <label>Choose Package</label>
                        <select class="form-control" name="package_id" style="max-width: 400px">
                            <?php
                            foreach($packages as $key => $package){
                                echo'<option value="'.$package['id'].'">'.$package['title'].' With ZIL. '.$package['price'].' </option>';
                            }
                            ?>
                            
                        </select>
                        <p style="color:green; font-weight:bold">You will get 220% Return</p>
                    </div>

                    <div class="form-group" id="SaveBtn">
                        <button type="subimt" name="save" class="btn btn-success">Activate</button>
                    </div>
                   <!--  <div class="form-group">
                        <label></label>
                        <input type="button" name="updateProfileBtn" value="Pay With BTC" id="PayBtcBtn"
                            style="display:none;" class="btn btn-primary">
                    </div> -->
                    <?php echo form_close(); ?>

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
  </div></div>
     </div> 
</div>

<?php include_once'footer.php'; ?>
<script>
$(document).on('blur', '#user_id', function() {
    var user_id = $('#user_id').val();
    if (user_id != '') {
        var url = '<?php echo base_url("Dashboard/check_sponser_packages/") ?>' + user_id;
        var html = '';
        $.get(url, function(res) {

            console.log(res);
            $('#errorMessage').html(res.message);
            $('#user_id').val(res.user.user_id);
            $.each(res.packages,function(key,value){
                html +='<option value="'+ value.id +'">'+value.title+' With Rs. ' + value.price+' </option>';
            })
            $('#packages').html(html);
        },'json')
    }
})
$(document).on('submit', 'form', function() {
    if (confirm('Are You Sure U want to Topup This Account')) {
        yourformelement.submit();
    } else {
        return false;
    }
})
$(document).on('change', '#PackageId', function() {
    var package_price = parseInt($(this).children("option:selected").data('price'));
    $('#Payamount').val(package_price);
    // alert(package_price)
})
$(document).on('change', '#payment_method', function() {
    $('#SaveBtn').toggle();
    $('#PayBtcBtn').toggle();
})
$(document).on('click', '#PayBtcBtn', function(e) {
    var formData = $(this).serialize();
    var user_id = $('#user_id').val();
    console.log(formData);
    if (user_id == '') {
        alert('Please Fill User ID');
        return;
    }
    $('#BtcForm').submit();
})
</script>
