<?php
    include_once 'header.php';
    date_default_timezone_set('Asia/Kolkata');
?>

<div class="container-fluid pt-5">
  <div class="page-content">
<div class="container">
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
  <div class="panel-heading">
        <span style="">Withdrawal</span>
    </div>

    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <div class="card">
          <div class="card-body">
    
    <div id="rootwizard" class="wizard-full-width border-0">
        <!-- BEGIN wizard-header -->

        <!-- END wizard-header -->
        <!-- BEGIN wizard-form -->

            <div class="wizard-content tab-content p-0">
                <!-- BEGIN tab-pane -->
                <div class="tab-pane active show" id="tabFundRequestForm">
                    <!-- BEGIN row -->
                    <div class="row">
                        <!-- BEGIN col-6 -->
                        <div class="col-md-6">

                            <?php
                                // if(date('D') == 'Mon' && date('D') != 'Sun'):
                                //     if(date('H:i') >= '00:00' && date('H:i') <= '23:50'): 
                                        echo form_open('',array('id' => 'TopUpForm'));
                            ?>
                                        <span class="text-danger"><?php echo $this->session->flashdata('message'); ?></span>
                                        <div class="form-group">
                                            <label style="font-size:20px; color:#00ecc6">Available balance ($<?php echo round($balance['balance'],2);?>)</label><br>
                                        </div>
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input type="text" class="form-control" onkeyup="total_hub(this)" name="amount" id="amount" placeholder="Amount" value="<?php echo set_value('amount');?>"/>
                                            <span class="text-danger"><?php echo form_error('amount')?></span>
                                            <span class="text-danger" id="coinGet"></span><br>
                                            <span class="text-danger" id="usdtget"></span>
                                        </div>
                                       <!--  <div class="form-group">
                                            <label>Transaction Pin</label>
                                            <input type="password" class="form-control" name="master_key" placeholder="Transaction Key" value=""/>
                                            <span class="text-danger"><?php echo form_error('master_key')?></span>
                                        </div>
 -->                                     <!--    <div class="form-group">
                                            <label>Deposit Type</label>
                                            <select class="form-control" name="creditType">
                                                <option value="USDT">USDT</option>
                                                <option value="Bank">Bank</option>
                                            </select>
                                        </div>
 -->                                        <div class="form-group">
                                            <label>Wallet Address</label>
                                            <input type="text" class="form-control" value="<?php echo $user['eth_address'];?>" />
                                        </div>
                                        <!-- <div class="form-group">
                                            <label>OTP</label>
                                            <input type="password" class="form-control" name="otp" placeholder="Enter OTP"
                                                value="" />
                                            <span class="text-danger"><?php  //echo form_error('otp') ?></span>
                                            <button type="button" class="btn btn-success" id="otp">GET OTP</button>
                                        </div> -->
                                        <div class="form-group">
                                            <?php if(!empty($user['eth_address'])){ ?>
                                            <button type="subimt" name="save" class="btn btn-success" />Withdrawal Now</button>
                                            <?php }else{ ?>
                                                <a href ="<?php echo base_url('Dashboard/Profile/zilUpdate') ?>"  class="btn btn-danger" />Please Update <?php echo currency; ?> Address</a>
                                        <?php } ?>
                                        </div>
                            <?php 
                                        echo form_close();
                                //     else:
                                //         echo '<span class="text-danger">Withdraw From 8AM to 11AM</span>';
                                //     endif;
                                // else:
                                //     echo '<span class="text-danger">Withdraw Request From Monday to Friday!</span>';
                                // endif;

                            ?>

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
  </div>
    <!-- END wizard -->
</div>
</div>
</div>
</div>

<?php include_once'footer.php'; ?>
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
<script>
    $(document).on('blur','#user_id',function(){
        var user_id = $('#user_id').val();
        if(user_id != ''){
            var url  = '<?php echo base_url("Dashboard/get_app_user/")?>'+user_id;
            $.get(url,function(res){
                if(res.success == 1){
                    $('#errorMessage').html(res.user.name);
                }else{
                    $('#errorMessage').html(res.message);
                }

            },'json')
        }
    })
    $(document).on('submit','#TopUpForm',function(){
        if (confirm('Are You Sure U want to Withdraw This Account')) {
            yourformelement.submit();
        } else {
            return false;
        }
    })


    function total_hub(evt) {
        var tokenValue = "<?php echo $tokenValue['amount']; ?>";
        var usdt = 80; 
        var amount = evt.value;
        //console.log(tokenValue)
        document.getElementById('usdtget').innerHTML = 'Estimated Value on USD '+ amount/usdt +' USDT';
        document.getElementById('coinGet').innerHTML = 'You Have to Get ZAARA '+ amount/tokenValue +' USDT';
    }

</script>
