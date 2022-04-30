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
   body {
    background: #01667f;
    background-size: cover;
    background-position: center;
    overflow-x: hidden;
}
        .card-wrapper {
            max-width: 500px;
            width: 100%;
        }

        .top-head {
            border-radius: 50px 50px 0px 0px;
        }
        .login-top-heading{
            text-transform: uppercase;
            color: #fff;
            font-weight: bold;
            font-size: 20px;
            display: inline-block;
        }
     /*   .bg-black{
            background-color:#3b3363;
            padding: 21px 0 0px;
        }*/
        /* .form-control{
            border: 0;
            border-bottom: 1px solid #ced4da;
        }*/
        .form-group{
            margin-bottom: 0px;
        }
        .form-control {
            padding: 7px 20px;
            font-size: 15px;
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
            background: #05647d!important;
            border: 0px;
            font-size: 18px;
        }
        a.back-to-home {
            color: #fff;
            padding: 0 20px;
            font-size: 21px;
        }
        .robo-btn p {
                border-bottom: 1px #c3c3c3 solid;
                width: 70%;
                margin: auto;
                padding-bottom: 5px;
            }
            .robo-img img {
                max-width: 50px;
                margin: 11px;
            }
        @media screen and (max-width: 767px){
           .card{
             margin-bottom:0px;
           }
           .card-wrapper{
                max-width: 100%;
                width: 100%;
           }

        }
    </style>

</head>
<body>
    <div class="account-pages pt-5" style="padding-top:5px !important">
        <div class="">
            <div class="row justify-content-center m-0">
                <div class="card-wrapper">
                  <!--   <a href="/" class="back-to-home"><i class="fa fa-arrow-left" aria-hidden="true"></i></a> -->
                    <div class="text-center top-head-logo">
                      <a href="https://zilgrow.io/app/" class="logo logo-admin">
                            <img src="<?php echo base_url('uploads/'); ?>logo.png" style="max-width: 200px;background: #03657e;margin: 0;border-radius: 10px;" alt="logo">
                        </a>
                    </div>
                     <div class="bg-black">
                            <div class="text-primary text-center">
                                <h5 class="my-3 login-top-heading" style="">Welcome Back !</h5>
                               <!--  <p class="text-white">Sign in to continue to  <?php echo title;?></p> -->
                            </div>
                        </div>
                    <div class="card overflow-hidden top-head">

                        <div class="card-body py-0">
                            <div class="">
                                <div class="panel panel-primary">

                <p style="color:red;text-align: center;"><?php echo $this->session->flashdata('message'); ?></p>
                <?php echo form_open('', array('id' => 'loginForm')); ?>
                <!-- <form id="loginForm" method="post" action=""> -->
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
                                <a class="forgot-password text-capitalize" style="color:#000;margin-bottom: 10px;display: inline-block;" href="<?php echo base_url('App/Dashboard/forgot_password'); ?>">Forgot password?</a>
                            </div>
                            <!-- <div class="g-recaptcha" data-sitekey="6LdbuCwdAAAAANGXao-fIMTvQWKO43uvoJBOLbg-" name = ""></div>  -->
                            <div class="form-group has-feedback">
                                <button id="loginBtn" type="submit" class="btn btn-info btn-block margin-top-10 submit-btn otp-btn" name="Submit" value="Login" >Sign In </button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
					</div>

                            </div>


                <div class="text-center sign-up-btn mt-4">
                    <p><a href="<?php echo base_url(); ?>App/User/Register" class="m-l-5 btn btn-success border-0" style="    background-color: #00252f!important;
    width: 90%;
    font-size: 18px;"> Sign Up</a></p>
                </div>
                <div class="robo-btn text-center">
                    <p>Not have an account?</p>
                    <div class="robo-img">
                        <img src="<?php echo base_url('uploads/ssl-img.png');?>">
                        <img src="<?php echo base_url('uploads/100-img.png');?>">
                        <h3>Be Relax ! <br>Robot is Working for you.</h3>
                        <img style="margin:0px; max-width:150px" src=" https://purepng.com/public/uploads/large/robots-glo.png">

                    </div>
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
