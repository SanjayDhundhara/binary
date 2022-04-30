<style>
    #content .page-titel spna
    {
        color: #3fbfd7;
    }

    #content .page-titel
    {
        font-size: 13px;
        font-weight: 500;
        text-transform: uppercase;
    }
    .content-header {
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
            <section class="content-header">
                <span>Coin Payment Gateway</span>
            </section>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="wizard-content tab-content">
                    <div class="tab-pane active show" id="tabFundRequestForm">
                        <div class="col-md-12">
                            <h5>You are going to Purchase E-Wallet of  <b class="text-danger">$<?php echo $amount;?></b></h5>
                            <form action="https://www.coinpayments.net/index.php" id="paymentform" method="post">
                                <input type="hidden" name="cmd" value="_pay_simple">
                                <input type="hidden" name="reset" value="1">
                                <input type="hidden" name="merchant" value="996af0bbd74b28e58c8707294ee61297">
                                <input type="hidden" name="item_name" value="Fund Request">
                                <input type="hidden" name="item_desc" value="Fund Request">
                                <input type="hidden" name="currency" value="USD">
                                <input type="hidden" name="amountf" id="amountf" value="<?php echo $amount;?>">
                                <input type="hidden" name="coins" value="1">
                                <input type="hidden" name="user_id" value="<?php echo $user['user_id'];?>">
                                <input type="hidden" name="first_name" value="<?php echo $user['user_id'];?>">
                                <input type="hidden" name="last_name" value="<?php echo $user['name'];?>">
                                <input type="hidden" name="email" value="<?php echo $user['email'];?>">
                                <input type="hidden" name="success_url" value="">
                                <input type="hidden" name="cancel_url" value="">
                                <input type="hidden" name="want_shipping" value="0">
                                <button type="submit" class="btn btn-success">Click Here to Pay</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php  $this->load->view('footer1');?>
