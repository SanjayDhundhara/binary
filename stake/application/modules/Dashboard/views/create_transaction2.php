<?php
include_once('header.php');
?>
<style>
.panel-heading {
    background: #e0e0e0;
    color: #000;
    padding: 8px 16px;
    border-radius: 10px;
}
.table-bg{
    background: #0b1323;
    padding: 15px;
    box-shadow: 0px 0px 10px;
}
.table td, .table th{
    border: none;
}
tr {
    border-bottom: 1px #424242 solid;
}
.table-bg h4 {
    color: #fff;
    padding: 12px 0;
    border-bottom: 1px #424242 solid;
}
td {
    color: #b5b2b2;
}
.table-bg h5 {
    text-align: center;
    padding: 0;
    color:#fff;
    margin-bottom: 20px;
    display: inline-block;
}
</style>
<div class="main-content">
  <div class="page-content">
<div class="container-fluid">
            <div class="trans-bg" >
            <div class="col-md-12">
            <div class="row">
                <div class="col-md-5">
                    <div class="table-bg text-center" >
                        <h5>Scan QR Code to make payment</h5>
                        <img src="<?php echo $data['result']['qrcode_url'];?>">
                        <h5 class="mt-4" style="font-size:13px"><?php echo $data['result']['address'];?></h5>
                    </div>
                </div>
                <div class="col-md-7">
                <div class="table-bg">
                    <h4>Payment Details</h4>
                  <p style="color:white; font-size:16px">  Total Confirm Need :<?php echo $data['result']['confirms_needed'];?> <br>
                    Amount To Send: <?php echo $currency;?> <?php echo $data['result']['amount'];?> <br>
                    Payment ID: <?php echo $data['result']['txn_id'];?></p>

                </div>
                </div>
            </div>
            </div>
            </div>
        </div>
    </div>
</div>
<?php include_once('footer1.php');?>
<script>
    docload();
    function docload(){
        const url = '<?php echo base_url('Dashboard/Payment/coinPaymentCheck');?>';
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            //document.getElementById("demo").innerHTML = this.responseText;
        }
        xhttp.open("GET",url);
        xhttp.send();
    }
</script>
