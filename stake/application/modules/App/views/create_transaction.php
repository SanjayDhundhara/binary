<?php
include_once('header.php');
include_once('coinpayment/CoinpaymentsAPI.php');
require('coinpayment/keys.php');
/** Scenario: Create a simple transaction. **/
// Create a new API wrapper instance
$cps_api = new CoinpaymentsAPI($private_key, $public_key, 'json');
// Enter amount for the transaction
$amount = $data['amount'];
$currency = $data['currency'];
$buyer_email = $data['buyer_email'];

// Make call to API to create the transaction
try {
    $transaction_response = $cps_api->CreateSimpleTransaction($amount, $currency, $buyer_email);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
    exit();
}
//pr($transaction_response);
if ($transaction_response['error'] == 'ok') {

} else {
    $output = 'Error: ' . $transaction_response['error'];
}
?>
<style>
.panel-heading {
    background: #e0e0e0;
    color: #000;
    padding: 8px 16px;
    border-radius: 10px;
}
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="col-md-6">
                    <img src="<?php echo $transaction_response['result']['qrcode_url'];?>">
                    <p><?php echo $transaction_response['result']['address'];?></p>
                </div>
                <div class="col-md-6">
                    <h4>Payment Details</h4>
                    <table class="table table-profile">
                        <tbody>
                            <tr>
                                <td class="field">Amount To Send</td>
                            </tr>
                            <tr>
                                <td class="value">
                                    <?php echo $transaction_response['result']['amount'];?><br>
                                    Total Confirm Need :<?php echo $transaction_response['result']['confirms_needed'];?>
                                </td>
                            </tr>
                            <tr>
                                <td class="field">Payment ID</td>
                            </tr>
                            <tr>
                                <td class="value">
                                    <?php echo $transaction_response['result']['txn_id'];?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> 
        </div>
    </div>
</div>
<?php include_once('footer1.php');?>
<script>
    //docload();
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
