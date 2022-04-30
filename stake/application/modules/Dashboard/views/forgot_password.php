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

    <style>
     body{
            background: url('https://profitshare365.com/stake/uploads/body-bg.jpeg');
            background-size: cover;
            background-position: center;
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
        .account-pages {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100%;
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
            background: transparent;
            color: #fff;
            border:1px solid #055aaa;
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
                background: #055aaa !important;
                border: 0px;
                font-size: 18px;
            }
             a.login-btn {
                background: #055aaa;
                color: #fff;
                padding: 6px 14px;
                border-radius: 2px;
                font-size: 15px;
            }
            @media screen and (max-width: 575px){
                .top-head{
                    text-align: center;
                }
           }
                </style>
</head>

<body>

<div class="account-pages pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                   
                    <div class="card overflow-hidden mt-3">
                        <div class="card-body py-0">
                             <div class="row align-items-center top-head">
                        <div class="col-md-12 text-center">
                          <a href="/" class="logo logo-admin">
                                <img src="<?php echo base_url('uploads/'); ?>logo.png" alt="logo" style="width: 250px;padding: 3px;border-radius: 4px;">
                            </a>  
                        </div>
                        <div class="col-md-12 text-center text-dark">
                            <h5 style="text-transform: uppercase;color: #055aaa;font-weight: bold;font-size: 22px;">Forgot Password!</h5>
                            <p class="m-0">Create New AMV Account</p>
                        </div>
                    </div>
                            <div class="">
                                <div class="panel panel-primary">
                                <?php echo form_open(); ?>
                <p style="color:red;text-align: center;"><?php echo $this->session->flashdata('message'); ?></p>
              <div class="panel-body">
                  <div class="details password-form">
                      <fieldset>
                          <div class="form-group">
                              <div class="label-area">
                              </div>
                              <div class="row-holder">
                                  <input id="SiteURL" type='text' name='email' maxlength='50' class="form-control" placeholder="Enter Your Email"/>
                              </div>
                          </div>
                          <div class="form-group my-3" style="text-align: right;">
                              <button style="background:#01667f" id="signupBtn" type="submit" class="btn btn-primary w-100 submit-btn otp-btn" name='Submit' value='Login'>Forget Password Account </button>
                          </div>

                          <div class="form-group has-feedback text-center">
                            <p>Have Account? <a class="login-btn"  href="<?php echo base_url('Dashboard/User/MainLogin'); ?>"> Login Now
                        </a></p>
                                
                            </div>

                      </fieldset>
                  </div>
              </div>
              <?php echo form_close(); ?>
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
