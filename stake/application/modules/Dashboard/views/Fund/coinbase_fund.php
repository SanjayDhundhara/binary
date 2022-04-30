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
<div class="content-header">
        <span>Request Wallet by Online Payment</span>
    </div>

    <div class="card">
        <div class="card-body">
        <!-- BEGIN page-header -->

        <div id="content">
        <h1 class="page-header">

            <small>Request Wallet</small>
        </h1>
                    <div class="tab-pane active show" id="tabFundRequestForm" style="margin-top:30px">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- <div class="form-group m-b-10">
                                    <div class="row row-space-6">
                                        <div class="col-md-6">
                                            <a href="Fund-Request.html?TB=tabFundRequestForm#" class="to-padding widget widget-stats">
                                                <div class="widget-stats-info mm-info">
                                                    <div class="widget-stats-value to-fontsize" id="FBald58">Rs.</div>
                                                    <div class="widget-desc">E-Wallet Balance </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="form-group m-b-10">
                                    <h2><?php echo $this->session->flashdata('message');?></h2>
                                    <?php echo form_open();?>
                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Enter Amount you want to Request in $</label>
                                            <?php
                                            echo form_input(array('type' => 'number', 'name' => 'amount', 'class' => 'form-control'));
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Choose Payment Method</label>
                                            <?php
                                            $option = [
                                                // 'coinbase' => 'Coinbase',
                                                //'coin_payment' => 'Coin Payment',
                                                'usdt' => 'USDT Payment',
                                            ];
                                            echo form_dropdown('payment_method',$option,'','class = form-control');
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Enter Hash ID</label>
                                            <?php
                                            echo form_input(array('type' => 'text', 'name' => 'hash_id', 'class' => 'form-control'));
                                            ?>
                                        </div>


                                        <div class="form-group" style="width:100%">
                                            <img src="https://billiondream.online/uploads/usdt.jpg" style="max-width:300px">
                                            <p style="font-size:18px; font-weight:bold">TRC20 USDT Address: </p>
                                            <!-- <br> <p>TLEMDheWaSfNSCxyuKxggxFSHJPynB8oLW</p> -->
                                            <input style="" type="text" id="linkTxt" value="TLEMDheWaSfNSCxyuKxggxFSHJPynB8oLW" class="form-control">
                                            <a id="btnCopy" iconcls="icon-save" class="btncopy btn-success btn-rounded m-b-5  " style="width: 30%; padding: 5px;">Copy Address</a>
                                        </div>
                                        <div class="form-group">
                                            <?php
                                            echo form_input(array('type' => 'submit' , 'class' => 'btn btn-success pull-right','name' => 'fundbtn','value' => 'Request'));
                                            ?>
                                        </div>
                                    </div>

                                    </div>
                                    </div>
                                    <?php echo form_close();?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php  $this->load->view('footer1');?>
<script type="">
    $(document).on('click', '#btnCopy', function () {
    //linkTxt
    var copyText = document.getElementById("linkTxt");
    copyText.select();
    copyText.setSelectionRange(0, 99999)
    document.execCommand("copy");
    alert("Copied the text: " + copyText.value);
})
</script>