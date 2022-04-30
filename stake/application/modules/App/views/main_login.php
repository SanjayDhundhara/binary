<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?php echo title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
     <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo-mini.png') ?>">

    <!-- Bootstrap Css -->
    <link href="<?php echo base_url('NewDashboard/') ?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo base_url('NewDashboard/') ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo base_url('NewDashboard/') ?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
<script src='https://www.google.com/recaptcha/api.js'></script>
    <style>
    body{
        	background: url('https://zilgrow.io/uploads/app-login-bg.jpg');
        	background-size: cover;
        	background-position: center;
        }
        .bg-black{
            background-color:#3b3363;
            padding: 21px 0 0px;
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
            border-radius: 15px;
            box-shadow: 0px 0px 10px rgb(230 230 230);
            border: 0px;
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
                background: #29ccc4 !important;
                border: 0px;
                font-size: 18px;
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
                                   <img src="<?php echo base_url('uploads/'); ?>logo.png" style="max-width: 221px;background: #29ccc4;margin: 0;border-radius: 10px;padding: 10px;" alt="logo">
                                </a>
                                <h5 class="mt-3" style="text-transform: uppercase;background: #29ccc4;color: #fff;font-weight: bold;font-size: 25px;padding: 5px 0;">Welcome Back !</h5>
                                <p class="text-white">Sign in to continue to  <?php echo title;?></p>
                            </div>
                        </div>

                        <div class="card-body py-0">
                            <div class="">
                                <div class="panel panel-primary">

                <p style="color:red;text-align: center;"><?php echo $message; ?></p>
                <?php echo form_open(base_url('Dashboard/User/MainLogin'), array('id' => 'loginForm')); ?>
                <form id="loginForm" method="post" action="/login.asp?ReturnURL=">
                    <div class="panel-body">
                        <div class="details password-form">

                            <div class="form-group has-feedback">
                                <label></label>
                                <div class="row-holder">
                                    <?php
                                    echo form_input(array(
                                        'type' => 'text',
                                        'name' => 'user_id',
                                        'class' => 'form-control',
                                        'placeholder' => 'User ID',
                                        'required' => 'true',
                                    ));
                                    ?>
                                    <span class="ion ion-log-in form-control-feedback "></span>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <label></label>
                                <div class="row-holder">
                                    <?php
                                    echo form_input(array(
                                        'type' => 'password',
                                        'name' => 'password',
                                        'class' => 'form-control',
                                        'placeholder' => 'Password',
                                        'required' => 'true',
                                    ));
                                    ?>
                                    <span class="ion ion-log-in form-control-feedback "></span>
                                </div>
                                   
                            </div>
                              <div class="form-group has-feedback text-right">
                                <a class="forgot-password text-capitalize" style="color:#000;margin-bottom: 10px;display: inline-block;" href="<?php echo base_url('Dashboard/forgot_password'); ?>">Forgot password?</a>
                            </div>

                                  <div class="g-recaptcha" data-sitekey="6LdbuCwdAAAAANGXao-fIMTvQWKO43uvoJBOLbg-" name = ""></div>            
                          
                            <div class="form-group has-feedback">
                                <button id="loginBtn" type="submit" class="btn btn-info btn-block margin-top-10 submit-btn otp-btn" name="Submit" value="Login">Sign In </button>
                            </div>
                            
                        </div>
                    </div>
                </form>
            </div>
					</div>

                            </div>


              <div class="text-center">
                        <p>Don't have an account? <a href="<?php echo base_url(); ?>Dashboard/User/Register" class="m-l-5 btn btn-primary"> Sign Up</a></p>
                    </div>

</div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/node-waves/waves.min.js"></script>

    <script src="<?php echo base_url('NewDashboard/') ?>assets/js/app.js"></script>
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
						$(document).on('submit', '#RegisterForm', function () {
								if (confirm('Please Check All The Fields Before Submit')) {
										yourformelement.submit();
								} else {
										return false;
								}
						})
				</script>
</body>
</html>
