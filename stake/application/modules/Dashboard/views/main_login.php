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
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
                background:#055aaa !important;
                border: 0px;
                font-size: 18px;
                margin-bottom: 11px;
            }
            a.signup-btn {
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
           .title-head {
                background: #055aaa;
                color: #fff;
                text-align: center;
                padding: 14px 0 14px;
                text-transform: uppercase;
                border-radius: 4px;
                position: relative;
                top: -28px;
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
    </style>

</head>


<body>

    <div class="account-pages">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
        <div class="container">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-6">
                        <a class="navbar-brand" href="https://login.vozcoin.io/">
                        <img src="<?php echo base_url('uploads/'); ?>logo.png" class="img-fluid"  style="width: 200px;background: #fff;padding: 3px;border-radius: 4px;">
                    </a>
                    </div>
                    <div class="col-6">
                        <nav class="navbar navbar-expand-lg navbar-light">
                              <div class="collapse navbar-collapse d-flex justify-content-end">
                                <ul class="navbar-nav">
                                  <li class="nav-item">
                                    <a class="nav-link text-white" href="https://zaaracoin.io/"><i class="fa fa-home"></i> Home</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link text-white" href="<?php echo base_url('Dashboard/Register'); ?>"><i class="fa fa-user-plus" aria-hidden="true"></i> Sign Up</a>
                                  </li>
                                </ul>
                              </div>
                            </nav>
                     
                    </div>
                </div>
            </div>
           
        </div>
    </nav>
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="row align-items-center top-head">
                     <!--    <div class="col-sm-4 col-md-3">
                          <a href="/" class="logo logo-admin">
                                <img src="" style="max-width: 70px;" alt="logo">
                            </a>  
                        </div> -->
                        <!-- <div class="col-sm-8 col-md-9 text-white">
                            <h5 style="text-transform: uppercase;color: #fff;font-weight: bold;font-size: 22px;"></h5>
                            <p class="m-0">Please enter your credentials to login.</p>
                        </div> -->
                    </div>
                    <div class="card mt-3">
                        <div class="card-body py-0">
                            <div class="title-head">
                                <h3>Login Now!</h3>
                            </div>
                            <div class="">
                                <div class="panel panel-primary">

                <p style="color:red;text-align: center;"><?php echo $message; ?></p>
                <?php echo form_open(base_url('Dashboard/User/MainLogin'), array('id' => 'loginForm')); ?>
                <!-- <form id="loginForm" method="post" action="/login.asp?ReturnURL="> -->
                    <div class="panel-body">
                        <div class="details password-form">
                        <div class="form-group has-feedback">
                                <input  type="text" style="padding:10px; margin-bottom:10px; width:100%" class="form_control" name ="user_id" placeholder="User ID">
                            </div>

                            <div class="form-group has-feedback">
                                <input  type="password" style="padding:10px; width:100%"  class="form_control" name ="password" placeholder="Password">
                            </div>

                            <div class="form-group has-feedback text-center">
                                <button id="loginBtn" type="submit" class="btn btn-info margin-top-10 submit-btn otp-btn">Login</button>
                                <!-- <p class="text-center"><a>Wallet Address - Press Refresh For Wallet Address If Trust Wallet</a></p> -->
                            </div>

                            </div>
                              <div class="form-group has-feedback text-center">
                                <p><a class="signup-btn" href="<?php echo base_url('forget-password');?>">Forget Password?</a> | <a class="signup-btn" href="<?php echo base_url('register');?>"> Sign Up?</a></p>
                            </div>

                        </div>
                    </div>
                </form>
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


    <!-- <script src="<?php //echo base_url('NewDashboard/') ?>assets/libs/node-waves/waves.min.js"></script> -->


    <!----------------------->
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="<?php echo base_url('NewDashboard/') ?>assets/binance/web3.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/web3modal@1.9.0/dist/index.js"></script>
    <script type="text/javascript" src="https://unpkg.com/evm-chains@0.2.0/dist/umd/index.min.js"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/binance/bn.js"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/binance/login.js"></script> -->

    <!----------------------->

    <script src="<?php echo base_url('NewDashboard/') ?>assets/js/app.js"></script>
  
</body>
</html>
