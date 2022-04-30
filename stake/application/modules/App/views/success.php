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
            background:#01667f;
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
        .card{
          margin-bottom: 0px;
        }
        .login-top-heading{
            text-transform: uppercase;
            color: #fff;
            font-weight: bold;
            font-size: 20px;
            display: inline-block;
        }
        h2.page-title {
            font-size: 23px;
            color: green;
            text-transform: uppercase;
            font-weight: bold;
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
       /*.bg-black{
            background-color:#3b3363;
            padding: 21px 0 0px;
        }*/
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
                            <img src="<?php echo base_url('uploads/'); ?>logo.png" style="max-width: 200px;background: #03657e!important;margin: 0;border-radius: 10px;" alt="logo">
                        </a>
                        </div>
                         <div class="bg-black">
                            <div class="text-primary text-center">
                                <h5 class="my-3 login-top-heading" style="">Welcome Back !</h5>
                               <!--  <p class="text-white">Sign in to continue to  <?php echo title;?> Squire</p>-->
                            </div>
                        </div>
                    <div class="card overflow-hidden top-head">
                        <div class="card-body p-4">
                            <div class="p-3">
                                <div class="form-wrapper">
                <div class="page-header text-center">

                    <h2 class="page-title">Registration Successfull !</h2>


                    <?php
                    echo'<h5 class="mainboxes" style="margin-top:15px; color:#46afd7">' . $message . '</h5>';
                    ?>
                    <div style="font-size:20px;font-weight: bold; color:#45aed7; margin-top:20px"><a href="https://zilgrow.io/app"   style="color: white;
background: #03657e!important;
padding: 10px 30px;
width: 100%;
font-weight:normal;
border-radius: 4px;
display: block;">Clik Here to Login</a></div>

                </div>

            </div>
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
