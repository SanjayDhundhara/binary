<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title><?php echo title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" /> -->
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
            background: url('https://profitshare365.com/stake/uploads/body-bg.jpeg');
            background-size: cover;
            background-position: top center;
            position: relative;
            height: 100vh;
        }
        body::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            top: 0;
            left: 0;
        }
        a.login-btn {
            background: #2a2a43 !important;
            color: #fff;
            padding: 6px 14px;
            border-radius: 2px;
            font-size: 15px;
            margin-top: 10px;
            display: inline-block;
            width: 100%;
            font-weight: bold;
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
                background:#055aaa !important;
                border: 0px;
                font-size: 18px;
            }
            a.login-btn {
                background: #ff9800;
                color: #fff;
                padding: 6px 14px;
                border-radius: 2px;
                font-size: 15px;
                margin-top: 10px;
                    display: inline-block;
            }
            .title-head {
                background:#055aaa;
                color: #fff;
                text-align: center;
                padding: 14px 0 14px;
                text-transform: uppercase;
                border-radius: 4px;
                position: relative;
                top: -46px;
                box-shadow: 0px 0px 10px rgb(230,230,230);
            }
            .title-head h3 {
                margin: 0px;
                font-size: 20px;
            }
            a.nav-link i {
                font-size: 19px;
                padding-right: 2px;
            }
            .top-bg{
                margin-top:50px;
            }
          
    </style>

    </head>

    <body>



	<div class="account-pages">
        <div class="container">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-6">
                        <a class="navbar-brand" href="https://login.vozcoin.io/">
                        <img src="<?php echo base_url('uploads/'); ?>logo.png" class="img-fluid" style="width: 200px;background: #fff;padding: 3px;border-radius: 4px;">
                    </a>
                    </div>
                    <div class="col-6">
                        <nav class="navbar navbar-expand-lg navbar-light">
                              <div class="collapse navbar-collapse d-flex justify-content-end">
                                <ul class="navbar-nav">
                                  <li class="nav-item">
                                    <a class="nav-link text-white" href="https://zaaracoin.io/"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link text-white" href="<?php echo base_url('Dashboard/User/MainLogin'); ?>"><i class="fa fa-user-plus" aria-hidden="true"></i> Sign In</a>
                                  </li>
                                </ul>
                              </div>
                            </nav>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5 top-bg">
                    <div class="card">
                        <div class="card-body">
                            <div class="title-head">
                                <h3>Register!</h3>
                            </div>
                            <div class="">
                                <div class="panel panel-primary">

								<div class="">

<div class="">
	<div class="">
		<div class="form-element">
<!-- <h5><?php //echo title;   ?></h5> -->
<span class="text-danger"><?php echo $this->session->flashdata('error'); ?></span>
<div class="form-group has-feedback text-danger mb-2 d-none">Do you have Sponsor ID
	<input type="radio" onclick="docload('yes')" id="yes"> Yes
	<input type="radio" onclick="docload('no')" id="no"> No
</div>
<?php echo form_open('Dashboard/Register?sponser_id=' . $sponser_id, array('id' => 'RegisterForm')); ?>

    <div class="form-group has-feedback ">
        <input type="text" class="form-control" id="sponser_id" placeholder="Sponser ID" value="<?php echo $sponser_id; ?>" name="sponser_id" required />
        <span class="ion ion-locked form-control-feedback "></span>
        <span class="text-danger"><?php echo form_error('sponser_id'); ?></span>
        <span id="errorMessage" class="text-danger"> </span>
    </div>

    <div class="form-group has-feedback ">

        <div class="form-field">
            <input type="text" class="form-control" placeholder="Enter Name" name="name" value="<?php echo set_value('name'); ?>" required />
            <span class="ion ion-locked form-control-feedback "></span>
        </div>

        <span class="text-danger"> <?php echo form_error('name'); ?></span>
    </div>

    <div class="form-field ">
        <input type="text" class="form-control" placeholder="Enter Phone Number" name="phone" value="<?php echo set_value('phone'); ?>" required />
        <span class="ion ion-locked form-control-feedback "></span>
    </div>

    <div class="form-field ">
        <input type="text" class="form-control" placeholder="Enter Email" name="email" value="<?php echo set_value('email'); ?>" required>
        <span class="ion ion-locked form-control-feedback "></span>
    </div>

    <div class="form-group has-feedback">
        <div class="form-field form-control">
            <!-- Material inline 1 -->
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input"
                    id="materialInline1" name="Lposition" value="L"
                    <?php if(!empty($_GET['position']) && $_GET['position'] == 'L'){ echo 'checked';}?>>
                <label class="form-check-label"
                    for="materialInline1">Left</label>
            </div>

            <!-- Material inline 2 -->
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input"
                    id="materialInline2" name="Lposition" value="R"
                    <?php if(!empty($_GET['position']) && $_GET['position'] == 'R'){ echo 'checked';}?>>
                <label class="form-check-label"
                    for="materialInline2">Right</label>
            </div>
        </div>
    </div>

    <div class="form-field d-none">
        <input type="number" onchange="total_hub(this)" class="form-control" placeholder="$100" name="package" value="<?php echo empty(set_value('package'))?'100':set_value('package'); ?>" required />
        <span class="ion ion-locked form-control-feedback "></span>
    </div>

    <div class="form-group has-feedback">
            <button type="submit"  dfdfdf id="deposit" class="btn btn-info btn-block mt-3 submit-btn otp-btn">Submit</button>
    </div>
<!-- 
    <div class="form-group has-feedback text-center">
        <p><a class="login-btn text-capitalize"  href="<?php echo base_url('Dashboard/User/MainLogin'); ?>">Have Account Login?</a> </p>
    </div> -->

<?php echo form_close(); ?>




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
        <!-- <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/node-waves/waves.min.js"></script> -->
        <script src="<?php echo base_url('NewDashboard/') ?>assets/js/app.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />



        <script src="<?php echo base_url('NewDashboard/') ?>assets/binance/toastr.js"></script>

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="//cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script> 

		

            <!----------------------->
     <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/binance/web3.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/web3modal@1.9.0/dist/index.js"></script>
    <script type="text/javascript" src="https://unpkg.com/evm-chains@0.2.0/dist/umd/index.min.js"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/binance/bn.js"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/binance/register.js"></script> -->
    <!----------------------->



		<script>
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
						document.getElementById("sponser_id").value = 'amvswap';
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
	            	if(total_hub > 0){

	            		fetch("<?php echo base_url('Admin/Settings/getHubRate/'); ?>"+total_hub, {
	                       method: "GET",
	                       headers: {
	                         "X-Requested-With": "XMLHttpRequest"
	                       },
	                       // body: formData,
	                   })
	                   .then(response => response.json())
	                   .then(result => {
	                       if(result.success == '1'){
	                       		document.getElementById('total_hub').innerHTML = 'Total Hub: '+result.message;
	                       }else{
	                          document.getElementById('total_hub').innerHTML = 'Please enter vaild amount!';
	                       }
	                    });
	            	}else{
                      document.getElementById('total_hub').innerHTML = 'Invaild Package Amount!';
                   }
	            }

		</script>

	</body>
</html>
