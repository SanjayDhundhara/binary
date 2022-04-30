<?php include_once'header.php'; ?>

<div class="container-fluid  ">

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
    <div class="card">
                                   <div class="card-body">
      <h4 class="page-header">
        <span style=""> Wallet balance <span id="walletBalance">($<?php echo ' '.$wallet['wallet_balance']; ?>)</span></span><br>


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
                    <!-- <div class="form-group">
                        <label>Choose Currency</label>
                        <select class="form-control" id="choose_currency" style="max-width: 400px">
                            <option value="BNB">BNB</option>
                            <option value="BUSD">BUSD</option>
                            <option value="ZNX">ZNX</option>
                            <option value="TRX" style="display:none">TRX</option>
                        </select>
                    </div> -->

                    <div class="form-group">
                        <label>User ID</label>
                        <input type="text" class="form-control" id="user_id" name="user_id"
                            value="<?php echo $this->session->userdata('user_id'); ?>" placeholder="User ID"
                            style="max-width: 400px" />  
                        <span class="text-danger"><?php echo form_error('user_id') ?></span>
                        <span class="text-danger" id="errorMessage"></span>
                    </div>


                    <!-- <div class="form-group">
                        <label>Amount</label>
                        <input type="text" class="form-control" name="amount"
                            value="<?php //echo set_value('amount'); ?>" placeholder="Enter Amount"
                            style="max-width: 400px" onkeyup="addOption(this)"/>
                        <span class="text-danger"><?php //echo form_error('amount') ?></span>
                    </div> -->
                    <!-- <div class="form-group">
                        <label>Months</label>
                        <select class="form-control" name="month" onchange="calculateCoin()" id="optionss" style="max-width: 400px">
                            
                        </select>
                        <span class="text-danger"><?php //echo form_error('month') ?></span>
                    </div> -->
                    <div class="form-group">
                        <label>Choose Package</label>
                        <select class="form-control" name="package_id" style="max-width: 400px" onchange="calculateCoin(this)">
                            <option value='0' price="0">--Select Package--</option>
                            <?php
                            foreach($packages as $key => $package){
                                echo'<option value="'.$package['id'].'" price="'.$package['price'].'">'.$package['title'].' With $'.$package['price'].' </option>';
                            }
                            ?>
                        </select>
                        <span class="text-danger" id="getCoin"></span>
                    </div>

                    <div class="form-group" id="SaveBtn">
                        <button type="submit" name="save" class="btn btn-success">Activate</button>
                    </div>
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
    const tokenValue = "<?php echo $tokenValue['amount'];?>";
</script>


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

// var packageAmount = 0;
// function addOption(via){
//     var amount = via.value;
//     packageAmount = amount;
//     if(amount >= 10 && amount <= 499){
//         var option = '<option value="">Select Months</option><option value="3">3 Months 25% Extra</option><option value="6">6 Months 50% Extra</option>';
//     } else if (amount >= 500) {
//         var option = '<option value="">Select Months</option><option value="3">3 Months 50% Extra</option><option value="6">6 Months 100% Extra</option>';
//     } else {
//         var option = '';
//     }
//     document.getElementById('optionss').innerHTML = option;
// }

function calculateCoin(via){
    var amount = via.options[via.selectedIndex].getAttribute('price');
    // console.log(amount);
    var tokenValue = "<?php echo $tokenValue['amount'];?>";
    document.getElementById('getCoin').innerHTML = 'You will get: '+amount/tokenValue+' ZCOIN';

    
    // if(month == 3 && packageAmount < 499){
    //     percent = 1.25;
    // } else if(month == 6 && packageAmount < 499){
    //     percent = 1.5;
    // } else if(month == 3 && packageAmount > 499){
    //     percent = 1.5;
    // } else if(month == 6 && packageAmount > 499){
    //     percent = 2;
    // } 
    // if(month != ''){
    //     document.getElementById('getCoin').innerHTML = 'You will get '+(packageAmount/tokenValue)*percent+' ZNX';
    // }
}

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

<!----------------------->
<!-- <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo base_url('NewDashboard/') ?>assets/tron/TronWeb.js"></script>
<script src="<?php echo base_url('NewDashboard/') ?>assets/binance/web3.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/web3modal@1.9.0/dist/index.js"></script>
<script type="text/javascript" src="https://unpkg.com/evm-chains@0.2.0/dist/umd/index.min.js"></script>
<script src="<?php echo base_url('NewDashboard/') ?>assets/binance/bn.js"></script>
<script src="<?php echo base_url('NewDashboard/') ?>assets/binance/account-activation.js"></script> -->
<!----------------------->
