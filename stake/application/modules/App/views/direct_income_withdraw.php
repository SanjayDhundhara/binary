<?php
    include_once 'header.php';
    date_default_timezone_set('Asia/Kolkata');
?>

<style>
    .form-group label{
        color: #000;
    }
    .text-danger {
    color: #fff !important;
    background: red;
    font-weight: bold;
    font-weight: bold;
    
    margin-bottom: 10px;
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
        <span style=""><?php echo $title; ?> /   Transfer to W-wallet</span>
    </div>

    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <div class="card mt-4">
          <div class="card-body">

    <div id="rootwizard" class="wizard wizard-full-width">
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

                            <?php echo form_open('',array('id' => 'TopUpForm'));?>
                            <span class="text-danger"><?php echo $this->session->flashdata('message'); ?></span>
                            <div class="form-group">
                                <label style="font-size:20px;color: #402b8c;font-weight: bold;">Available balance (ZIL.<?php echo round($balance['balance'],2);?>)</label><br>
                            </div>
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="text" class="form-control" name="amount" id="amount" onblur="calculate_net_amount();" placeholder="Amount" value="<?php echo set_value('amount');?>"/>
                                <span class="text-danger"><?php echo form_error('amount')?></span>
                            </div>
                            <div class="form-group">
                                <label>Service Charges</label>
                                <span class="text-info">10%</span>
                            </div>
                            <div class="form-group" style="display:none">
                                <label>Net Amount</label>
                                <span class="text-success" id="netAmount"></span>
                            </div>
                            <div class="form-group" style="display:none">
                                <label>100% E-wallet Transfer</label><br>
                                <!-- <input type="radio" name="pin_transfer" onclick="calculate_net_amount();" value="1" checked>Yes &nbsp; -->
                                <input type="radio" name="pin_transfer" onclick="calculate_net_amount();" value="0" checked >No
                            </div>
                            <div class="form-group" style="display:none">
                                <label>Transfer Amount to Topup-wallet</label>
                                $<span class="text-success" id="bankAmount"></span>
                            </div>
                            <!-- <div class="form-group">
                                <label>TDS Charges 5%</label>
                                <span class="text-success" id="tds"></span>
                            </div> -->
                            <div class="form-group">
                                <label>Net.  Amount</label>
                                <span class="text-success" id="NetbankAmount"></span>
                            </div>
                            <div class="form-group">
                                <label>Transaction Pin</label>
                                <input type="password" class="form-control" name="master_key" placeholder="Transaction Key" value=""/>
                                <span class="text-danger"><?php echo form_error('master_key')?></span>
                            </div>
                            <div class="form-group">
                                <label>Zil Address<br> <span style="color:red; font-family:Arial">Note: Enter only BEP20 Address You will lost fund if any other address</span></label>
                                <input type="text"  class="form-control"  name="address" placeholder="Zil Address" value=" <?php echo set_value('address'); ?>" >
                            </div>
                            <div class="form-group">
                                <?php //if(!empty($ziladdress['zil_address'])){ ?>
                                <button type="subimt" name="save" class="btn btn-success" />Withdrawal Now</button>
                                <a class="btn btn-danger" href="<?php echo base_url('App/Dashboard/withdraw_history') ?>">Withdrawal History</a>
                                <?php //}else{ ?>
                                    <!-- <a href ="<?php echo base_url('Dashboard/Profile/zilUpdate') ?>"  class="btn btn-danger" />Please Update Zil Address</a> -->
                               <?php //} ?>
                            </div>
                            <?php echo form_close();?>

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
    $(document).on('blur','#amount',function(){
      var amount = $(this).val();
    //   var netAmount = amount * 90 /100;
    //   $('#netAmount').text(netAmount);
    })
    function calculate_net_amount(){
        var amount = $('#amount').val();
        var bankAmount;
        var tds = 0;
        var transfer_wallet = $("input[name='pin_transfer']:checked").val();
        console.log(transfer_wallet);
        if(transfer_wallet == 0){
            bankAmount = amount * 90 /100;
            // tds = amount * 5 /100;
        }else{
            bankAmount = amount * 90 /100;
            // tds = amount * 5 /100;
        }

        var NetbankAmount = (bankAmount);
        $('#NetbankAmount').text(NetbankAmount);
        $('#bankAmount').text(bankAmount);
        $('#tds').text(tds);
    }
</script>
