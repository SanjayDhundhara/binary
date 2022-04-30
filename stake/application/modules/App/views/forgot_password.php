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

 <style>
        body{
            background:#03657e;
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
       /* .bg-black{
            background-color:#3b3363;
            padding: 21px 0 0px;
        }*/
        .form-group{
            margin-bottom: 0px;
        }
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
        .card{
          margin-bottom: 0px;
        }
        .submit-btn {
            font-size: 18px;
            background: linear-gradient(to right, #da8cff, #9a55ff) !important;
            border: 0px;
            margin-top: 15px;
        }
        .otp-btn {
                background: #4452cc!important;
                border: 0px;
                font-size: 18px;
            }
            a.back-to-home {
              color: #fff;
              padding: 0 20px;
              font-size: 21px;
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


    <div class="account-pages pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="card-wrapper">
                  <a href="https://zilgrow.io/app/" class="back-to-home"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                        <div class="text-center top-head-logo">
                             <a href="https://zilgrow.io/app/" class="logo logo-admin">
                            <img src="<?php echo base_url('uploads/'); ?>logo.png" style="max-width: 200px;background: #03657e;margin: 0;border-radius: 10px;" alt="logo">
                        </a>
                        </div>
                         <div class="bg-black">
                            <div class="text-primary text-center">
                                <h5 class="my-3 login-top-heading" style="">Forget  Password !</h5>
                               <!--  <p class="text-white">Sign in to continue to  <?php echo title;?> Squire</p>-->
                            </div>
                        </div>
                    <div class="card overflow-hidden top-head">

                        <div class="card-body pb-0">
                            <div class="">
                               <div class="details password-form">
              <?php echo form_open(base_url('App/Dashboard/forgot_password/')); ?>
                <p style="color:red;text-align: center;"><?php echo $this->session->flashdata('message'); ?></p>
              <div class="panel-body">
                  <div class="details password-form">
                      <fieldset>
                          <div class="form-group">
                              <div class="label-area">
                              </div>
                              <div class="row-holder">
                                  <input id="SiteURL" type='text' name='user_id' maxlength='50' class="form-control" placeholder="User ID "/>
                              </div>
                          </div>
                          <div class="form-group my-3" style="text-align: right;">
                              <button style="background:#03657e !important" id="signupBtn" type="submit" class="btn btn-primary w-100 submit-btn otp-btn" name='Submit' value='Login'>Forget Password Account </button>
                          </div>

                      </fieldset>
                  </div>
              </div>
              <?php echo form_close(); ?>
                <!-- <div class="form-group text-center" style="color:#000">
                    Don't have an account? <a href="<?php// echo base_url(); ?>Dashboard/User/Register" style="color: red;font-weight: 600;">Click Here</a>
                </div> -->
               <!--  <div class="form-group mt-4" style="text-align:center;">
                    <center class="text-bold"><p><a style="background: #4CAF50;
color: white;
padding: 10px 20px;
border-radius: 10px;
width: 100%;" href="<?php //echo base_url('Dashboard/User/MainLogin'); ?>">Click Here to Login</a></p></center>
                </div> -->
            </div>
					</div>
                            </div>

                        <div class="text-center">
                        <p>Already have an account? <a href="https://zilgrow.io/app/" class="btn btn-success m-l-5" style="background-color: #000000!important"> Sign In</a></p>
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
