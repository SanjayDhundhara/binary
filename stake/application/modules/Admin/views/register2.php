<?php
    $none = 0;
?>
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title><?php echo title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo.png') ?>">

        <!-- Bootstrap Css -->
        <link href="<?php echo base_url('NewDashboard/') ?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?php echo base_url('NewDashboard/') ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?php echo base_url('NewDashboard/') ?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <script src='https://www.google.com/recaptcha/api.js'></script>

		<style>
    body{
        	background: #000000;
        	background-size: cover;
        	background-position: center;
        }
        .bg-black{
            background-color:#000;
            padding: 5px 0 0px;
        }
        /* .form-control{
            border: 0;
            border-bottom: 1px solid #ced4da;
        }*/
        .form-group{
            margin-bottom: 0px;
        }
        .form-control {
            padding: 7px 20px;
    font-size: 17px;
    border-radius: 2px;
    /* box-shadow: 0px 0px 10px rgb(230 230 230); */
    border: 0px;
    background: #000000;
    color: #fff;
    border: 1px #313132 solid;
        }
        .form-control:focus{
            box-shadow: 0px 0px 10px rgb(230 230 230);
        }
        .submit-btn {
            font-size: 18px;
            background: linear-gradient(to right, #da8cff, #9a55ff) !important;
            border: 0px;
            margin-top: 15px;
        }
        .otp-btn {
                background: #0b73bf !important;
                border: 0px;
                font-size: 18px;
            }
            .card
            {
                background-color: #000 !important;
            }
    </style>

    </head>

    <body>


	<div class="account-pages pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">

                        <div class="bg-black">
                            <div class="text-primary text-center">
                                <a href="/" class="logo logo-admin">
                                   <img src="<?php echo base_url('uploads/'); ?>logo.png" style="max-width: 150px;background: #000;margin: 0;border-radius: 10px;padding: 10px;" alt="logo">
                                </a>
                                <h5 class="mt-3" style="text-transform: uppercase;background: #000;color: #fff;font-weight: bold;font-size: 25px;padding: 5px 0;">Welcome Back !</h5>

                            </div>
                        </div>

                        <div class="card-body py-0">
                            <div class="">
                                <div class="panel panel-primary">

								<div class="">

<div class="card-body p-2">
	<div class="p-3">
		<div class="form-element">
<!-- <h5><?php //echo title;   ?></h5> -->
<span class="text-danger"><?php echo $this->session->flashdata('error'); ?></span>
<div class="form-group has-feedback text-danger mb-2">Do you have Sponsor ID
	<input type="radio" onclick="docload('yes')" id="yes"> Yes
	<input type="radio" onclick="docload('no')" id="no"> No
</div>
<?php echo form_open('Dashboard/User/Register2?sponser_id=' . $sponser_id, array('id' => 'RegisterForm')); ?>

<div class="form-group has-feedback">
	<input type="text" class="form-control" id="sponser_id" placeholder="Sponser ID" value="<?php echo $sponser_id; ?>" name="sponser_id" required />
	<span class="ion ion-locked form-control-feedback "></span>
	<span class="text-danger"><?php echo form_error('sponser_id'); ?></span>
	<span id="errorMessage" class="text-danger"> </span>
</div>


<div class="form-field">
	<label></label>
    <input type="text" class="form-control" placeholder="Enter Name" name="name" value="<?php echo set_value('name'); ?>" required />
    <span class="ion ion-locked form-control-feedback "></span>
    <span class="text-danger"> <?php echo form_error('name'); ?></span>
</div>

<div class="form-group has-feedback">

    <div class="form-field">
     <label></label>
    <input type="text" class="form-control" placeholder="Enter Email" name="email" value="<?php echo set_value('email'); ?>" required>
    <span class="ion ion-locked form-control-feedback "></span>
    <span class="text-danger"> <?php echo form_error('email'); ?></span>
 </div>

<style>
    .selected_address {
    background: #fff;
    padding: 6px;
}
    </style>

<div class="form-field" id="selectedAddress" style="display:none">
	<label>Your Select Account </label>
    <div class="selected_address">
       0x0FDc11A591A8694544b8A713C6A0f13f0E6b5278
    </div>
</div>



<?php if($none == 1):?>
    <div class="form-field">
        <label></label>
    <select class="form-control" name="months" id="months">
        <option value="18">18 Months 20% Extra</option>
        <option value="24">24 Months 36% Extra</option>
        <option value="36">36 Months 48% Extra</option>
        <option value="48">48 Months 60% Extra</option>
    <select>
    </div>

    <div class="form-field">
        <label></label>
        <input type="number" onkeyup="total_hub(this)" class="form-control" placeholder="Amount You want to Stacked $100" name="package" value="<?php echo set_value('package'); ?>" required>
        <span class="ion ion-locked form-control-feedback "></span>
    </div>

    <span class="text-danger"> <?php echo form_error('package'); ?></span>
    <span id="total_hub" class="text-info"> </span><br>
    <span id="usd_amount" class="text-warning"> </span>
    </div>

    <span class="text-danger"> <?php echo form_error('package'); ?></span>
    <span id="total_hub" class="text-info"> </span><br>
    <span id="usd_amount" class="text-warning"> </span>
    </div>
<?php endif;?>

<div class="form-group has-feedback">
		<button type="submit" class="btn btn-info btn-block mt-3 submit-btn otp-btn">Submit</button>
</div>

<div class="form-group has-feedback text-center">
                                <a class="forgot-password text-capitalize" style="color:yellow;margin: 10px 0px;display: inline-block;" href="<?php echo base_url('Dashboard/User/MainLogin'); ?>">Have Account Login?</a>
                            </div>

<?php echo form_close(); ?>
<p style="display:none"><a href="<?php echo base_url('Site/Main/Register'); ?>">REGISTER NOW!</a></p>



</div>

            </div>
					</div>

                            </div>




    </div>
        <!-- <div class="home-btn d-none d-sm-block">
            <a href="index-2.html" class="text-dark"><i class="fas fa-home h2"></i></a>
        </div> -->


        <!-- JAVASCRIPT -->
        <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/simplebar/simplebar.min.js"></script>
        <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/node-waves/waves.min.js"></script>




        <script src="<?php echo base_url('NewDashboard/') ?>assets/js/app.js"></script>

 




		<script>
			  function checkWhiteSpace(){
                var username = document.getElementById('user_id').value;
                if(username.indexOf(' ') >= 0){
                    //document.getElementById('user_id').value = username.trim();
                    toastr.error('Space not allowed in Username', {timeOut: 5000})
                } 
            }

            $(document).on('blur', '#sponser_id', function () {
                check_sponser();
            })

				$(document).on('blur', '#sponser_id', function () {
						check_sponser();
				})
				function check_sponser() {
						var user_id = $('#sponser_id').val();
						if (user_id != '') {
								var url = '<?php echo base_url("Dashboard/User/get_user/") ?>' + user_id;
								$.get(url, function (res) {
										$('#errorMessage').html(res);
								})
						}
				}
				check_sponser();
			

				function docload(check){
					if(check == 'yes'){
						var radioButton = document.getElementById("no");
						radioButton.checked = false;
						document.getElementById("sponser_id").value = '';
						$('#errorMessage').html('');
					}else if(check == 'no'){
						var radioButton = document.getElementById("yes");
						radioButton.checked = false;
						document.getElementById("sponser_id").value = 'MPY11111';
						check_sponser();
					}
				}


				function sendEmailOtp() {
	                var email = document.getElementById('confirm_email').value;
	                if(email != ''){
	                    var formData = new FormData();
	                    var csrf = document.getElementsByName("<?php echo $this->security->get_csrf_token_name(); ?>")[0].value;
	                    formData.append("<?php echo $this->security->get_csrf_token_name(); ?>", csrf);
	                    formData.append("email", email);
	                    fetch("<?php echo base_url('Dashboard/User/getMailOtp/'); ?>", {
	                       method: "POST",
	                       headers: {
	                         "X-Requested-With": "XMLHttpRequest"
	                       },
	                       body: formData,
	                   })
	                   .then(response => response.json())
	                   .then(result => {
	                       document.getElementsByName("<?php echo $this->security->get_csrf_token_name(); ?>")[0].value = result.token;
	                       if(result.success == '1'){
	                           toastr.success(result.message, {timeOut: 5000})
	                       }else{
	                          toastr.error(result.message, {timeOut: 5000})
	                       };
	                    });
	                }
	            }


	            function total_hub(evt) {
	            	const total_hub = evt.value;
                    const tokenValue = '<?php echo $tokenValue['amount'];?>';
                    if(total_hub <= 10000) {
                        //if(total_hub%5 == 0){
                            // fetch("<?php echo base_url('Admin/Settings/getHubRate/'); ?>"+total_hub, {
                            //     method: "GET",
                            //     headers: {
                            //         "X-Requested-With": "XMLHttpRequest"
                            //     },
                            //     // body: formData,
                            // })
                            // .then(response => response.json())
                            // .then(result => {
                            //     if(result.success == '1'){
                                    var percent ;
                                    var finalAmount ;
                                    var month = document.getElementById('months').value;
                                    var amount = total_hub/tokenValue;
                                    if(month == 18){
                                        percent = 20;
                                        finalAmount = amount*0.2;
                                    } else if(month == 24) {
                                        percent = 36;
                                        finalAmount = amount*0.36;
                                    } else if(month == 36) {
                                        percent = 48;
                                        finalAmount = amount*0.48;
                                    } else if(month == 48) {
                                        percent = 60;
                                        finalAmount = amount*0.6;
                                    }
                                    document.getElementById('usd_amount').innerHTML = 'Total MPY You pay: '+total_hub/tokenValue;
                                    document.getElementById('total_hub').innerHTML = 'Extra MPY: '+finalAmount;
                            //     }else{
                            //         document.getElementById('total_hub').innerHTML = 'Please enter vaild amount!';
                            //     }
                            // });
                        // }else{
                        //     document.getElementById('total_hub').innerHTML = 'Invaild Package Amount!';
                        // }
                    } else {
                        document.getElementById('total_hub').innerHTML = 'Invaild Package Amount!';
                    }
	            }

		</script>


              
    <!----------------------->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/binance/web3.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/web3modal@1.9.0/dist/index.js"></script>
    <script type="text/javascript" src="https://unpkg.com/evm-chains@0.2.0/dist/umd/index.min.js"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/binance/bn.js"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/binance/register.js"></script>
    <!----------------------->
    

	</body>
</html>
