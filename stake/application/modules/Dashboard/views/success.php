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
           .card-wrapper {
            max-width: 500px;
            width: 100%;
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
        @media screen and (max-width: 575px){
            .top-head{
                text-align: center;
            }
        }
       /*.bg-black{
            background-color:#3b3363;
            padding: 21px 0 0px;
        }*/
    </style>

</head>

<body>

    <div class="account-pages">
        <div class="container">
            <div class="row justify-content-center">
             <div class="col-md-8 col-lg-6 col-xl-5">
                 <div class="row align-items-center top-head">
                        <div class="col-md-12">
                          <a href="/" class="logo logo-admin">
                                <img src="<?php echo base_url('uploads/'); ?>logo.png" style="max-width: 250px;background-color: #fff;padding: 4px;border-radius: 4px;" alt="logo">
                            </a>  
                        </div>
                     <!--    <div class="col-sm-8 col-md-9 text-white">
                            <h5 style="text-transform: uppercase;color: #fff;font-weight: bold;font-size: 22px;">Welcome Back !</h5>
                            <p class="m-0">Sign in to continue to  <?php echo title;?> </p>
                        </div> -->
                    </div>
                <div class="card-wrapper mt-3">
                    <div class="card overflow-hidden top-head">
                        <div class="card-body">
                            <div >
                                <div class="form-wrapper">
                <div class="page-header text-center">

                    <h2 class="page-title">Registration Successfull !</h2>


                    <?php
                    echo'<h5 class="mainboxes" style="margin-top:10px; color:#46afd7">' . $message . '</h5>';
                    ?>
                    <div style="font-size:20px;font-weight: bold; color:#45aed7; margin-top:20px"><a href="<?php echo base_url('Dashboard/User/MainLogin'); ?>"   style="color: white;
background: #FF9800 !important;
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
