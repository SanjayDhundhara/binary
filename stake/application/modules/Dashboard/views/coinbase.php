<?php include_once'header.php'; ?>

<style>
.fund-box h1 {
    text-transform: capitalize;
    font-size: 50px;
    font-weight: bold;
    margin-bottom: 30px;
}
.fund-box span {
    color: #23c4bf;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
input.form-control {
    padding-right: 150px;
    height: 60px;
    background: #0c1a32;
    border-color: rgba(255,255,255,.12);
}
select.form-control {
    height: 60px;
    padding: 0 47px;
}
.form-control:focus {
    color: #fff;
    background-color: transparent;
    border-color: #23c4bf;

}
.form-control, select.form-control:not([size]):not([multiple]){
    color: #000;
    background-color: #fff;
}
option {
    color: #000 !important;
}
form#TopUpForm {
    margin-top: 43px;
}
@media screen and (max-width: 480px){
    input.form-control{
        padding: 0px 11px;
    }
}

</style>

<div class="container-fluid pt-5">
  <div class="page-content">
<div class="container">
            <div class="content-header">
            <div class="row align-items-center">
                  <div class="col-md-12">
                      <div class="panel-heading">
                        <span><?php echo $header;?></span>
                    </div>
                </div>
               <!--  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right m-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Account Management</li>
                        <li class="breadcrumb-item active"><?php echo $header;?></li>
                    </ol>
                </div> -->
            </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container">
        <div class="card card-body" style="background: #0b1323;">
        <div class="col-md-10 m-auto fund-box text-center text-dark">
            <h1><?php echo $header; ?> <span><?php echo $header1; ?></span></h1>
            <h4>Make payment <br> by scaning QR code</h4>

            <div id="qrcode" style="    margin: 0 auto;"></div>

            <h6 class="text-center">Wallet Address : <b><?php echo $wallet[0]['wallet_address']; ?></b></h6>
            <h6 class="text-center">Zil Current Balance : <b class="zil_current_balznce"><?php
            $wallet_balance['result'];

            if($wallet_balance['result'] == 0){
                echo '0 ZIL';
            }else{
                echo $wallet_balance['result'] / 1e12. ' ZIL';
            }

              ?></b></h6>


        </div>
        </div>
        </div>
    </div>
</div>
<?php include_once 'footer.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.6.1-rc.3/web3.min.js" integrity="sha512-0KTZZdA9E3vaLClQkC6S9roiHr9J2A79Q/BvcIwd8LjRVAQcwrT1zorS7hfZ7B3Nr/u6bYzNG/wXOAOADdJ7qQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="module">
    import EthereumQRPlugin from 'https://cdn.skypack.dev/ethereum-qr-code';
    // later in code
    const qr = new EthereumQRPlugin();
    const qrCode = qr.toCanvas({
        to: '<?php echo $wallet[0]['wallet_address']; ?>',
        gas: 21000,
        }, {
        selector: '#qrcode',
        })


        async function getBalance(){
            if (window.web3) {
                window.web3 = new Web3(window.web3.currentProvider);
              //  window.ethereum.enable();
            } else {
                return true;
            }

            let minABI = [{"inputs":[{"internalType":"address","name":"logic","type":"address"},{"internalType":"address","name":"admin","type":"address"},{"internalType":"bytes","name":"data","type":"bytes"}],"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"address","name":"previousAdmin","type":"address"},{"indexed":false,"internalType":"address","name":"newAdmin","type":"address"}],"name":"AdminChanged","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"implementation","type":"address"}],"name":"Upgraded","type":"event"},{"stateMutability":"payable","type":"fallback"},{"inputs":[],"name":"admin","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"newAdmin","type":"address"}],"name":"changeAdmin","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"implementation","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"newImplementation","type":"address"}],"name":"upgradeTo","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"newImplementation","type":"address"},{"internalType":"bytes","name":"data","type":"bytes"}],"name":"upgradeToAndCall","outputs":[],"stateMutability":"payable","type":"function"},{"stateMutability":"payable","type":"receive"}];
            let contractAddress = "0xb86AbCb37C3A4B64f74f59301AFF131a1BEcC787";
            const contract = new web3.eth.Contract(minABI, contractAddress);


            const balanceOfTx = await contract.methods.balance('<?php echo $wallet[0]['wallet_address']; ?>').call()
        .then(res => {
            console.log(res);
        });
        console.log(balanceOfTx);

            // var bal = await web3.eth.getBalance('<?php echo $wallet[0]['wallet_address']; ?>');
            // alert(bal);
        }
        getBalance();

</script>

<script>

    $(document).on('blur', '#user_id', function () {
        var user_id = $('#user_id').val();
        if (user_id != '') {
            var url = '<?php echo base_url("Dashboard/User/get_user/") ?>' + user_id;
            $.get(url, function (res) {
                $('#errorMessage').html(res);
            })
        }
    })
    $(document).on('submit', '#TopUpForm', function () {
        if (confirm('Are You Sure for this action')) {
            yourformelement.submit();
        } else {
            return false;
        }
    })
</script>
