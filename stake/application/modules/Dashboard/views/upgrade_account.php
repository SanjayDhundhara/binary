<?php include_once 'header.php'; ?>
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
        <div class="container-fulid">
            <section class="content-header" style="background:black !important">
                <span style="">Upgrade your Account</span>
            </section>
            <div class="card">
                <div class="card-body">
                    <h1 class="page-header mb-4">
                        <span style="font-size:20px; color:#fff">  Wallet balance (<?php echo currency.' '.$wallet['wallet_balance']; ?>) </span>
                    </h1>
        <div id="rootwizard" class="wizard wizard-full-width">
            <div class="wizard-content tab-content">
                <!-- BEGIN tab-pane -->
                <div class="tab-pane active show" id="tabFundRequestForm">
                    <!-- BEGIN row -->
                    <div class="col-md-12">
                        <!-- BEGIN col-6 -->
                        <?php if(!empty($packages)):?>
                            <?php echo form_open('', array('id' => 'TopUpForm')); ?>
                            <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
                            <div class="form-group">
                                <label>Choose Package</label>
                                <select class="form-control" name="package_id" id="PackageId" style="max-width:400px;">
                                    <?php
                                    foreach($packages as $key => $package){
                                        echo'<option value="'.$package['id'].'">'.$package['title'].' With'.currency.' '.$package['price'].' </option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="payment_method" id="payment_method" style="max-width:400px;">
                                    <option>E-wallet</option>

                                </select>
                            </div>
                            <!-- <div class="form-group">
                                <label>User ID</label>
                                <input type="text" class="form-control" id="user_id" name="user_id" value="<?php echo set_value('user_id'); ?>" placeholder="User ID" style="max-width: 400px"/>
                                <span class="text-danger"><?php echo form_error('user_id') ?></span>
                                <span class="text-danger" id="errorMessage"></span>
                            </div> -->
                            <div class="form-group" id="SaveBtn">
                                <button type="subimt" name="save" class="btn btn-success" />Upgrade</button>
                            </div>
                            <?php echo form_close(); ?>
                        <?php 
                            else: 
                                echo '<span class="badge badge-danger">You are already activated to highest package!</span>'; 
                            endif;
                        ?>
                            <!-- END col-6 -->
                            <!-- <form id="BtcForm" style="display:none;" action="https://www.coinpayments.net/index.php"  method="post" style="text-align:center;">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <label for="amount" style="color:#fff;">Deposited Amount <span class="text-red">*</span></label>
                                        <input type="hidden" name="amountf" value="100" id="Payamount" required="" class="form-control">
                                        <div class="error"></div>
                                    </div>
                                </div>
                                <input type="hidden" name="user_id" value="<?php echo $user_info->user_id; ?>">
                                <input type="hidden" name="cmd" value="_pay">
                                <input type="hidden" name="reset" value="1">
                                <input type="hidden" name="want_shipping" value="0">
                                <input type="hidden" name="merchant" value="d9481e195615de09cd4d4857104a52ed">
                                <input type="hidden" name="currency" value="USD">
                                <input type="hidden" name="item_name" value="Pins Purchase">
                                <input type="hidden" name="user_id" value="<?php echo $user_info->user_id; ?>">
                                <input type="hidden" name="first_name" value="<?php echo $user_info->user_id; ?>">
                                <input type="hidden" name="last_name" value="<?php echo $user_info->name; ?>">
                                <input type="hidden" name="email" value="<?php echo $user_info->email; ?>">
                                <input type="hidden" name="allow_extra" value="1">-->
                                <!-- <input type="image" src="https://www.coinpayments.net/images/pub/buynow-white.png" alt="Buy Now with CoinPayments.net"> -->

                                <!--<input type="hidden" name="success_url" value="<?php echo base_url('Dashboard/payment_response/success'); ?>">
                                <input type="hidden" name="cancel_url" value="<?php echo base_url('Dashboard/payment_response/failure'); ?>">-->
                                <!-- <div class="col-md-12 text-center">  <img src="payment-mode.jpeg" class="img-responsive" style="max-width:100%"></div> -->
                                <!--<div class="form-row text-center">

                                </div>
                            </form> -->
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
</div>
</div>
</div>
</div>
</div>





<?php include_once'footer.php'; ?>
<script>
    // $(document).on('blur', '#user_id', function () {
    //     var user_id = $('#user_id').val();
    //     if (user_id != '') {
    //         var url = '<?php echo base_url("Dashboard/User/get_user/") ?>' + user_id;
    //         $.get(url, function (res) {
    //             $('#errorMessage').html(res);
    //             $('#user_id').val(user_id);
    //         })
    //     }
    // })
    $(document).on('submit', '#TopUpForm', function () {
        if (confirm('Are You Sure U want to Topup This Account')) {
            yourformelement.submit();
        } else {
            return false;
        }
    })
    $(document).on('change','#PackageId',function(){
        var package_price = parseInt($(this).children("option:selected").data('price'));
        $('#Payamount').val(package_price);
        // alert(package_price)
    })
</script>
