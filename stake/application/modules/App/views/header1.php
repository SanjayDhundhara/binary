<?php
if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
}
$user_info = userinfo();
$bankinfo = bankinfo();
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
        <link rel="icon" href="<?php echo base_url('NewDashboard/');?>assets/images/favicon.png">
        <link href="<?php echo base_url('NewDashboard/') ?>assets/libs/chartist/chartist.min.css" rel="stylesheet">

        <!-- Bootstrap Css -->
        <link href="<?php echo base_url('NewDashboard/') ?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?php echo base_url('NewDashboard/') ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?php echo base_url('NewDashboard/') ?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

       <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
       <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
       <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <style>
        body{
        	/*background:url(https://1fxcoin.com/uploads/dashboard-bg.jpg) !important;*/
            background-color: #f5f5f5;
        	background-size:cover;
        	background-position:center;
        	background-attachment: fixed;
        	
        }
        .text-white-50 {
            color: #fff !important;
            padding: 30px 0;
            margin: 0px;
        	    text-align: center;
        }
       .font-weight-medium {
            font-weight: 500;
            background: #cb3441;
            padding: 12px 40px;
            margin: auto;
            border-radius: 4px;
            font-size: 20px !important;
            font-weight: bold;
        }
        /*body[data-sidebar=dark] .navbar-brand-box {
             background: #000;
             border-right:1px #ffffff61 solid; 
        }*/

        body[data-sidebar=dark] .vertical-menu {
            background: #a87b20;
            border: 0px;
            padding-right: 12px;
        }
        body[data-sidebar=dark] .mm-active .active {
            background: linear-gradient(87deg,#ffb21d,#e8ac39)!important;
            border-radius: 0px 30px 30px 0px;
            color: #fff !important;
        }
        body[data-sidebar=dark] #sidebar-menu ul li a {
            color: #fff;
            font-size: 16px;
             font-family: 'Poppins', sans-serif;
             padding: 12px 8px;
        }
        #page-topbar {
            background:linear-gradient(87deg,#ca3142,#ffa500)!important;
        }
        button#vertical-menu-btn {
            position: absolute;
            right: 0;
            color: #fff;
            top: 0;
        }
        .metismenu li {
            display: block;
            width: 100%;
            background:linear-gradient(87deg,#ca3142,#ffa500)!important;
            margin-bottom: 20px;
            border-radius: 0px 30px 30px 0px;
        }
        ul#side-menu li.active {
            background: #000;
        }
        body[data-sidebar=dark] #sidebar-menu ul li a i {
            color: #fff !important;
        }
        body[data-sidebar=dark] #sidebar-menu ul li ul.sub-menu li a {
            color: #fff !important;
            background: 0 0;
        }
        body[data-sidebar=dark] #sidebar-menu ul li ul.sub-menu li a:hover {
            color: #fff;
        }
        body[data-sidebar=dark] #sidebar-menu ul li a:hover {
            color: #fff;
        }
        body[data-sidebar=dark] #sidebar-menu ul li a:hover i {
            color: #fff;
        }
        .page-title-box {
            background: #fff;
            padding: 20px;
            border-radius: 6px;
            margin-top: 20px;
            box-shadow: 0px 0px 10px rgb(230 230 230);
        	margin-bottom: 20px;
            min-height: 110px;
        }
        .footer {
            background-color: #18191e;
        }
        .main-content {
            margin-top: 20px;
        }
    </style>
    </head>

    <body data-sidebar="dark">

        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="#" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="<?php echo base_url('uploads/'); ?>logo.png" alt="" style="max-width:80px;">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?php echo base_url('uploads/'); ?>logo.png" alt="" style="max-width:80px;">
                                </span>
                            </a>

                            <a href="#" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="<?php echo base_url('uploads/'); ?>logo.png" alt="" style="max-width:80px;">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?php echo base_url('uploads/'); ?>logo.png" alt="" style="max-width:80px;">
                                </span>
                            </a>
                        </div>

                        
                            <a href="#" class="btn btn-sm header-item waves-effect">
                                <i class="ti-more"></i>
                            </a>
                        
                       <!-- <div class="d-none d-sm-block">
                            <div class="dropdown pt-3 d-inline-block">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Create <i class="mdi mdi-chevron-down"></i>
                                    </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Separated link</a>
                                </div>
                            </div>
                        </div>-->
                    </div>

                    <div class="d-flex">
                          <!-- App Search-->
                          <!--<form class="app-search d-none d-lg-block">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="fa fa-search"></span>
                            </div>
                        </form>-->

                        <!--<div class="dropdown d-inline-block d-lg-none ml-2">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-magnify"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                                aria-labelledby="page-header-search-dropdown">

                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>-->

                       


                        

                        

                        <div class="dropdown d-none">
                            <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                                <i class="mdi mdi-settings-outline"></i>
                            </button>
                        </div>

                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            

                            <li class="active">
                                <a href="<?php echo base_url('Dashboard/User/'); ?>" class="waves-effect">
                                    <i class="ti-home"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo base_url('uploads/plan.pdf'); ?>" class=" waves-effect" target="_blank">
                                    <i class="ti-calendar"></i>
                                    <span>Business Plan</span>
                                </a>
                            </li>

                            <!-- <li>
                                <a href="<?php// echo base_url('Dashboard/User/Profile'); ?>" class=" waves-effect">
                                    <i class="ti-calendar"></i>
                                    <span>Edit Profile</span>
                                </a>
                            </li> -->

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="ti-package"></i>
                                    <span>Profile</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                  <li><a href="<?php echo base_url('Dashboard/Profile'); ?>">Edit Profile</a></li>
                                 
                                  <li><a href="<?php echo base_url('Dashboard/Profile/changePassword'); ?>">Change Password</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="<?php echo base_url('Dashboard/User/Register/?sponser_id=' . $user_info->user_id); ?>" class=" waves-effect">
                                    <i class="ti-calendar"></i>
                                    <span>Register New</span>
                                </a>
                            </li>





                            <!-- <li class="menu-title">Components</li> -->

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="ti-package"></i>
                                    <span>Request Wallet</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                  <li><a href="<?php echo base_url('Dashboard/Payment'); ?>">Buy Fund</a></li>
                                  
                                  <!-- <li><a href="<?php //echo base_url('Dashboard/fund/requests'); ?>">Requests History</a></li>
                                  <li><a href="<?php //echo base_url('Dashboard/fund/wallet_ledger'); ?>">Wallet Ledger</a></li>
                                    <li><a href="<?php //echo base_url('Dashboard/fund/transfer_fund'); ?>">Fund Transfer</a></li> -->
                                  <!-- <li><a href="<?php //echo base_url('Dashboard/User/addBalanceHistory'); ?>">Topup Wallet History</a></li> -->
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="waves-effect">
                                    <i class="ti-receipt"></i>
                                  
                                    <span>Account Active</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                  <li><a href="<?php echo base_url('Dashboard/Activation'); ?>"> Active New Account</a></li>
                                 
                                  <li><a href="<?php echo base_url('Dashboard/Fund/activation_history'); ?>">Active Account History</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="ti-pie-chart"></i>
                                    <span>My Team</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                  <li><a href="<?php echo base_url('Dashboard/User/Directs'); ?>">My Directs</a></li>
                                  <li><a href="<?php echo base_url('Dashboard/User/Genelogy'); ?>">Team View</a></li>
                             
                                   <li><a href="<?php echo base_url('Dashboard/User/Tree/' . $user_info->user_id); ?>">My Direct Tree</a></li>
                                  <!-- <li><a href="<?php echo base_url('Dashboard/User/Downline'); ?>">My  Downline</a></li>
                                  <li><a href="<?php echo base_url('Dashboard/User/Downline/L'); ?>">Left Downline</a></li>
                                  <li><a href="<?php echo base_url('Dashboard/User/Downline/R'); ?>">Right Downline</a></li>
                                  <li><a href="<?php echo base_url('Dashboard/User/GenelogyTree/' . $user_info->user_id); ?>">Team Tree</a></li> -->
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="ti-view-grid"></i>
                                    <span>Withdraw Money</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                  <!-- <li><a href="<?php echo base_url('Dashboard/DirectIncomeWithdraw') ?>">Withdrawal</a></li>
                                   <li><a href="<?php echo base_url('Dashboard/withdraw_history') ?>">Withdrawal History</a></li> -->
                                    <!-- <li><a href="<?php //echo base_url('Dashboard/matchingWithdraw') ?>">Withdrawal</a></li> -->
                                 <!--   <li><a href="<?php //echo base_url('Dashboard/DirectIncomeWithdraw') ?>">Withdrawal</a></li>
                                  <li><a href="<?php //echo base_url('Dashboard/withdraw_history') ?>">Withdrawal History</a></li> -->
                                  <!-- <li><a href="<?php //echo base_url('Dashboard/IncomeTransfer') ?>"> Transfer to Another Account</a></li>
                                   -->
                                   <!-- <li><a href="<?php echo base_url('Dashboard/eWalletTransfer') ?>"> Transfer to E-Wallet</a></li> -->

                                     <li>
                                        <a href="<?php echo base_url('Dashboard/SecureWithdraw/addBeneficiary') ?>"> 1. Add Beneficiary</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('Dashboard/SecureWithdraw/beneficiaryList') ?>"> 2. Bank Transfer</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('Dashboard/bank_transfer_summary') ?>">Bank Transfer Summary</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="ti-face-smile"></i>
                                    <span>Account Statement</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                  <?php
                                  $incomes = incomes();
                                  foreach ($incomes as $key => $income) {
                                      echo' <li>
                                            <a href="' . base_url('Dashboard/User/Income/' . $key) . '">' . $income . '</a>
                                         </li>';
                                  }
                                  ?>

                                  <li><a href="<?php echo base_url('Dashboard/User/income_ledgar'); ?>">Income Ledger</a></li>
                                  <li><a href="<?php echo base_url('Dashboard/Settings/payout_summary'); ?>">Datewise Payout Summary</a></li>
                                  <li><a href="<?php echo base_url('Dashboard/Settings/week_payout_summary'); ?>">Weekwise Payout Summary</a></li>
                                  <li><a href="<?php echo base_url('Dashboard/rewards'); ?>">Reward Ledger</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="ti-package"></i>
                                    <span>Support Ticket</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                  <li><a href="<?php echo base_url('Dashboard/Support/ComposeMail'); ?>">Create Ticket</a></li>
                                  <li><a href="<?php echo base_url('Dashboard/Support/Inbox'); ?>">Inbox</a></li>
                                  <li><a href="<?php echo base_url('Dashboard/Support/Outbox'); ?>">OutBox</a></li>
                                </ul>
                            </li>


                            <li>
                                <a href="<?php echo base_url('Dashboard/User/logout'); ?>">
                                    <i class="ti-more"></i>
                                    <span>Logout</span>
                                </a>

                            </li>

                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->
