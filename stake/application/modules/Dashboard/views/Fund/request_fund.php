
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
<style>
  section.content-header {
    background-color: #e0e0e0;
    padding: 10px;
    font-size: 20px;
    margin: 21px 0px;
    border-radius: 10px;
    width: 100%;
}
.messageBox {
  padding: 1em;
  background: #002e3666;
  border: #eee solid 2px;
  position: absolute;
  top: 50%;
  left: 50%;
  margin-right: -50%;
  transform: translate(-50%, -50%);
  text-shadow: 0px 0px 8px #000;
  color: #fff;
}
#text {
  font-family: Questrial;
  text-align: center;
}
#construction {
  font-family: "Pacifico", cursive;
}
.transaction-box {
    position: relative;
     border-radius: 5px ;
     overflow: hidden;

}
button#btnCopy {
    background: #31a5da;
    color: #fff;
    border: 0px;
    padding: 7px 13px;
    font-weight: bold;
    display: inline-block;
}
div#qrcode img {
    max-width: 100%;
}
.copy-cls{
   background: orange;
    color: #fff;
    padding: 10px 15px;
    display: inline;
}
@media screen and (max-width: 640px){
  .transaction-box{
    width: 100%;
  }
  .copy-cls{
    display: block;
  }
}

div#qrcode img
{
  width:250px !important;
}
</style>
<div class="">
    <!-- <section class="main-content"> -->
        <div class="row">
              <div class="panel-heading">
                <span>Wallet Requests /  Fund Request</span>
            </div>
          
        </div>
        <div class="content">
        <div id="rootwizard" class="card card-body wizard-full-width">
            <div class="wizard-content tab-content">
                <div class="tab-pane active show" id="tabFundRequestForm">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group m-b-10">
                                <div class="row row-space-6">
                                    <!-- <div class="col-md-6">
                                        <a href="Fund-Request.html?TB=tabFundRequestForm#" class="to-padding widget widget-stats">
                                            <div class="widget-stats-info mm-info">
                                                <div class="widget-stats-value to-fontsize" id="FBald58">Rs.</div>
                                                <div class="widget-desc">E-Wallet Balance </div>
                                            </div>
                                        </a>
                                    </div> -->
                                </div>
                            </div>
                            <div class="form-group m-b-10">
                                <div class="row row-space-6">

                                    <!-- <div class="col-md-6 "> -->

                                        <!-- <a href="Fund-Request.html?TB=tabFundRequestForm#" class="to-padding widget widget-stats"> -->
                                            <!-- <div class="widget-stats-info mm-info"> -->
                                                <!-- <div class="widget-stats-value to-fontsize" id="FBald58"> E-Wallet Balance: (<?php //echo currency.''.$amount['amount'] ?>)</div> -->
                                                <!-- <div class="widget-desc">E-Wallet Balance </div> -->
                                            <!-- </div> -->

                                        <!-- </a> -->
                                    <!-- </div> -->
                                </div>
                                <div class="col-md-8 ">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="qr" id="qrcode">
                                    </div>
                                        <div class="row mt-12">
                                        <div class="col-md-12">
                                                    <p> <input class="form-control" type="text" id="linkTxt" value="<?php echo $user['wallet_address']; ?>" readonly></p>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="transaction-box">
                                                <button id="btnCopy" iconcls="icon-save" class="btncopy btn-rounded m-b-5 copy-section">
                                                Copy Address
                                                </button>
                                                <a href="<?php echo base_url('Dashboard/fund/depositHistory');?>" class="copy-cls">Click here to See Transaction at Tron Scan </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            



                                <?php echo form_open_multipart();?>
                                <div class="row" style="display:none;" >
                                    <div class="col-md-6">
                                        <h2><?php echo $this->session->flashdata('message');?></h2>
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
                                                <label>Enter Block ID</label>
                                                <?php
                                                echo form_input(array('type' => 'text', 'name' => 'txn_id', 'class' => 'form-control'));
                                                ?>
                                            </div>


                                            <div class="form-group" style="width:100%">
                                                <img src="https://oxbin.io/stacking/uploads/barcode.png" style="max-width:300px">
                                                <p style="font-size:18px; font-weight:bold"> Address: </p>
                                                <!-- <br> <p>TLEMDheWaSfNSCxyuKxggxFSHJPynB8oLW</p> -->
                                                <input style="" type="text" id="linkTxt" value="0x11060f07A204DCb0e6146744547F8d6e3bd62796" class="form-control">
                                                <a id="btnCopy" iconcls="icon-save" class="btncopy btn-success btn-rounded m-b-5  " style="width: 30%; padding: 5px;">Copy Address</a>
                                            </div>
                                            <div class="form-group">
                                                <?php
                                                echo form_input(array('type' => 'submit' , 'class' => 'btn btn-success pull-right','name' => 'fundbtn','value' => 'Request'));
                                                ?>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-6">
                                            <img src="<?php //echo base_url('classic/no_image.png');?>" title="Payment Slip" id="slipImage" style="width: 100%;">
                                        </div> -->
                                    </div>
                                </div>
                                <?php echo form_close();?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- </section> -->
</div>
<?php  $this->load->view('footer');?>
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
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
	<script type="text/javascript">
		var code = '<?php echo $user['wallet_address']; ?>';
		new QRCode(document.getElementById("qrcode"),code);
	</script>
<script>
    $('#global-loader').hide()
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#slipImage').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#payment_slip").change(function () {
        readURL(this);
    });
    $(document).on('submit', '#paymentForm', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $('#savebtn').css('display', 'none');
        $('#uploadnot').css('display', 'block');
        var action = $(this).attr('action');
        $.ajax({
            url: action,
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data)
            {
                data = JSON.parse(data);
                if (data.success === 1)
                {
                    toastr.success(data.message);
//                    swal("Thank You", data.message);
                    //window.location = "https://soarwaylife.in/Dashboard/request_money.php" + data.message;
                    location.reload();
                } else {
                    toastr.error(data.message);
                }
                $('#savebtn').css('display', 'block');
                $('#uploadnot').css('display', 'none');
            }
        });
    });


</script>
