<?php
if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
}

$user_info = userinfo();
$bankinfo = bankinfo();
$mynews = mynews();
$none = 0;
?>
<!DOCTYPE html>
<html lang="en">
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>

		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="">
		<meta name="Author" content="">
		<meta name="Keywords" content=""/>

		<!-- Title -->
		<title> <?php echo title;?></title>

        <!-- Favicon -->
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" /> -->
		<link rel="icon" href="https://stacking.murphycoin.us/Latestdashboard/img/brand/logo.png" type="image/x-icon"/>
		<link rel="icon" href="<?php echo base_url('Latestdashboard/');?>img/brand/logo.png" type="image/x-icon"/>

		<!-- Icons css -->
		<link href="<?php echo base_url('Latestdashboard/');?>plugins/icons/icons.css" rel="stylesheet">

		<!-- Bootstrap css -->
		<link href="<?php echo base_url('Latestdashboard/');?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

		<!--  Right-sidemenu css -->
		<link href="<?php echo base_url('Latestdashboard/');?>plugins/sidebar/sidebar.css" rel="stylesheet">

		<!-- P-scroll bar css-->
		<link href="<?php echo base_url('Latestdashboard/');?>plugins/perfect-scrollbar/p-scrollbar.css" rel="stylesheet" />

		<!-- Sidemenu css -->
		<link id="theme" rel="stylesheet" href="<?php echo base_url('Latestdashboard/');?>css/sidemenu.css">

		<!--- Style css --->
		<link href="<?php echo base_url('Latestdashboard/');?>css/style.css" rel="stylesheet">
		<link href="<?php echo base_url('Latestdashboard/');?>css/boxed.css" rel="stylesheet">
		<link href="<?php echo base_url('Latestdashboard/');?>css/dark-boxed.css" rel="stylesheet">

		<!--- Dark-mode css --->
		<link href="<?php echo base_url('Latestdashboard/');?>css/style-dark.css" rel="stylesheet">

		<!---Skinmodes css-->
		<link href="<?php echo base_url('Latestdashboard/');?>css/skin-modes.css" rel="stylesheet" />


		<!-- Maps css -->
		<link href="<?php echo base_url('Latestdashboard/');?>plugins/jqvmap/jqvmap.min.css" rel="stylesheet">

		<!--  Owl-carousel css-->
		<link href="<?php echo base_url('Latestdashboard/');?>plugins/owl-carousel/owl.carousel.css" rel="stylesheet" />


		<!--- Animations css-->
		<link href="<?php echo base_url('Latestdashboard/');?>css/animate.css" rel="stylesheet">

		<!---Switcher css-->
		<link href="<?php echo base_url('Latestdashboard/');?>switcher/css/switcher.css" rel="stylesheet">
		<link href="<?php echo base_url('Latestdashboard/');?>switcher/demo.css" rel="stylesheet">
		<style>
			.app-sidebar {
			    background:#000 !important;
			    box-shadow: none;
			}
			.header-icon {
			    color: #fff;
			}
			li.slide:hover {
			    background: rgba(33, 33, 33, 0.1);
			    color: #fff !important;
			}
			.side-menu__label {
			    color: #fff;
			    font-size: 15px !important;
			}
			.side-menu .side-menu__icon {
			    fill: #fff;
			}
			.angle {
			    color: #ffffff!important;
			}
			.slide:hover .angle, .slide:hover .side-menu__icon, .slide:hover .side-menu__label {
			    fill: #bb7207!important;
			    color: #bb7207!important;
			}
			.slide.is-expanded a {
			    color: #fff;
			}
			span.top-header {
			    font-size: 18px;
			}
		    .main-sidebar-header{
		       	background:#000 !important;
		    }
	      	.main-header {
		    	background:#000;
		    	color: #fff;
			}
			.panel-heading {
			    background: #6b6b6b;
			    color: #fff;
			    font-weight: bold;
			}
.card {
    word-wrap: break-word;
    background-clip: border-box;
    border: 1px solid #6b6b6b;
    border-radius: 5px;
    box-shadow:0 2px 28px rgb(0 0 0 / 10%);
    display: flex;
    flex-direction: column;
    margin-bottom: 1.3rem;
    min-width: 0;
    position: relative;
    margin-top: 20px;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: none;
    border-radius: 0.25rem;
    padding: 20px;
}
.table-bordered thead td, .table-bordered thead th {
    background-color: hsl(0deg 0% 2%);
    border-top-width: 1px;
    padding-bottom: 7px;
    padding-top: 7px;
    color: #fff !important;
}
.table tbody tr {
    background-color: hsl(0deg 0% 42%);
    color: #fff !important;
}
.table-striped tbody tr:nth-of-type(odd) {
    background-color: #060606;
}
table.dataTable tbody td.sorting_1 {
    background-color: #000;
}
.breadcrumb-header
{
  margin-top: 0px;
}
.bg-primary {
    background-color: #000!important;
}
.slide i {
    color: #fff !important;
    font-size: 18px;
    padding-right: 12px;
}
.header-icon-svgs {
    color: #ffffff;
}
.sidebar-mini.sidenav-toggled .close-toggle {
    color: #fff;
    font-size: 28px;
}
		</style>
    </head>

    <body class="main-body app sidebar-mini">

        <!-- Loader -->
		<div id="global-loader">
			<img src="<?php echo base_url('Latestdashboard/');?>img/loader.svg" class="loader-img" alt="Loader">
		</div>
		<!-- /Loader -->

		<!-- Page -->
		<div class="page">

        <!-- main-sidebar -->
        <!-- main-sidebar -->
			<div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
			<aside class="app-sidebar sidebar-scroll">
				<div class="main-sidebar-header text-center">
					<a class="desktop-logo logo-light active" href="/"><img src="<?php echo base_url('uploads/');?>logo-n.png" class="main-logo" alt="logo"></a>
					<a class="desktop-logo logo-dark active" href="/"><img src="<?php echo base_url('uploads/');?>logo-n.png" class="main-logo dark-theme" alt="logo"></a>
					<a class="logo-icon mobile-logo icon-light active" href="/"><img src="<?php echo base_url('uploads/');?>logo-n.png" class="logo-icon" alt="logo"></a>
					<a class="logo-icon mobile-logo icon-dark active" href="/"><img src="<?php echo base_url('uploads/');?>logo-n.png" class="logo-icon dark-theme" alt="logo"></a>
					<!-- <span class="top-header"><?php echo $user_info->name; ?></span> -->
				</div>
				<div class="main-sidemenu">
					<ul class="side-menu">
						<li class="slide">
							<a class="side-menu__item" href="<?php echo base_url('Dashboard/User/'); ?>">
								<i class="fa fa-th-large"></i>
								<span class="side-menu__label">Dashboard</span></a>
						</li>
						<li class="slide">
							<a class="side-menu__item" href="<?php echo base_url('Dashboard/Network/levelView'); ?>">
								<i class="img"><img src="<?php echo base_url('uploads/coins.png');?>" style="width:16px" alt=""></i>
								<span class="side-menu__label">Downline Business</span></a>
						</li>
						
						<li class="slide">
							<a class="side-menu__item" href="<?php echo base_url('Dashboard/Activation'); ?>"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/><path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/></svg><span class="side-menu__label">Activate Account</span></a>
						</li>
						<li class="slide">
							<a class="side-menu__item" href="<?php echo base_url('Dashboard/Profile/zilUpdate'); ?>"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/><path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/></svg><span class="side-menu__label">Update Wallet Address</span></a>
						</li>
						<li class="slide">
							<a class="side-menu__item" href="<?php echo base_url('Dashboard/Profile/accountDetails'); ?>"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/><path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/></svg><span class="side-menu__label">Update Bank Detail</span></a>
						</li>
						<li class="slide">
							<a class="side-menu__item" href="<?php echo base_url('Dashboard/transaction-password'); ?>"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/><path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/></svg><span class="side-menu__label">Transaction Password</span></a>
						</li>
            			<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#">
								<i class="fa fa-users"></i>
								<span class="side-menu__label">Income Reports</span><i class="angle fe fe-chevron-down"></i>
							</a>
							<ul class="slide-menu">
								<?php
									$incomes = incomes();
									foreach($incomes as $key => $inc):
								?>

									<li><a  class="slide-item" href="<?php echo base_url('Dashboard/Reports/incomes/'.$key); ?>"><?php echo $inc;?></a></li>
								<?php
									endforeach;
								?>
								<li><a  class="slide-item" href="<?php echo base_url('Dashboard/Reports/incomesLedger'); ?>">Income Ledger</a></li>
								<li><a  class="slide-item" href="<?php echo base_url('Dashboard/Settings/payout_summary'); ?>">Payout Summary</a></li>
								<li><a  class="slide-item" href="<?php echo base_url('Dashboard/Reports/coinHistory'); ?>">Coin Wallet History</a></li>
							</ul>
						</li>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#">
								<i class="fa fa-users"></i>
								<span class="side-menu__label">Fund Management</span><i class="angle fe fe-chevron-down"></i>
							</a>
							<ul class="slide-menu">
							 <li>

								<li><a  class="slide-item" href="<?php echo base_url('Dashboard/fund/Request_fund'); ?>">Deposit</a></li>
								<li><a  class="slide-item" href="<?php echo base_url('Dashboard/fund/depositHistory'); ?>">Fund Transactions</a></li>
							</ul>
						</li>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#">
								<i class="fa fa-users"></i>
								<span class="side-menu__label"> My Team</span><i class="angle fe fe-chevron-down"></i></a>
							<ul class="slide-menu">

			                    <li><a  class="slide-item" href="<?php echo base_url('Dashboard/User/Genelogy'); ?>">Team View</a></li>
			                    <li><a  class="slide-item" href="<?php echo base_url('Dashboard/User/Tree/' . $user_info->user_id); ?>">My Directs Tree</a></li>
			                    <li><a  class="slide-item" href="<?php echo base_url('Dashboard/Network/levelView'); ?>">Level Report</a></li>
			                   <!--    <li><a href="<?php echo base_url('Dashboard/User/Downline/L'); ?>">Left Downline</a></li>
			                      <li><a href="<?php echo base_url('Dashboard/User/Downline/R'); ?>">Right Downline</a></li> -->
			                     <!--  <li><a href="<?php echo base_url('Dashboard/User/GenelogyTree/' . $user_info->user_id); ?>">Team Tree</a></li> -->
							</ul>
						</li>




						<li class="slide">
							<a class="side-menu__item" href="<?php echo base_url('Dashboard/Register/?sponser_id=' . $user_info->user_id); ?>" target="_blank">
								<i class="fa fa-crosshairs"></i>
								<span class="side-menu__label">Register New</span></a>
						</li>

							<!-- <li class="slide">
							<a class="side-menu__item" href="<?php echo base_url('Dashboard/User/rewards/'); ?>"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"  viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 4c-4.42 0-8 3.58-8 8s3.58 8 8 8 8-3.58 8-8-3.58-8-8-8zm3.5 4c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5.67-1.5 1.5-1.5zm-7 0c.83 0 1.5.67 1.5 1.5S9.33 11 8.5 11 7 10.33 7 9.5 7.67 8 8.5 8zm3.5 9.5c-2.33 0-4.32-1.45-5.12-3.5h1.67c.7 1.19 1.97 2 3.45 2s2.76-.81 3.45-2h1.67c-.8 2.05-2.79 3.5-5.12 3.5z" opacity=".3"/><circle cx="15.5" cy="9.5" r="1.5"/><circle cx="8.5" cy="9.5" r="1.5"/><path d="M12 16c-1.48 0-2.75-.81-3.45-2H6.88c.8 2.05 2.79 3.5 5.12 3.5s4.32-1.45 5.12-3.5h-1.67c-.69 1.19-1.97 2-3.45 2zm-.01-14C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/></svg><span class="side-menu__label">Rewards</span></a>
						</li> -->

						<!-- <li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/><path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/></svg><span class="side-menu__label">Wallet</span><i class="angle fe fe-chevron-down"></i></a>
							<ul class="slide-menu">
								 <li><a class="slide-item"  href="<?php echo base_url('Dashboard/Payment'); ?>">Deposit Wallet</a></li>
                   				<li><a class="slide-item"  href="<?php echo base_url('Dashboard/Fund/transfer_fund'); ?>">Transfer Wallet</a></li>

							</ul>
						</li> -->






						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#">
								<i class="mdi mdi-wallet"></i>
								<span class="side-menu__label">Withdraw <?php echo currency; ?></span><i class="angle fe fe-chevron-down"></i></a>
							<ul class="slide-menu">
							<li><a class="slide-item"  href="<?php echo base_url('Dashboard/DirectIncomeWithdraw') ?>">Withdrawal</a></li>
							<li><a class="slide-item"  href="<?php //echo base_url('Dashboard/DirectIncomeWithdraw') ?>">USDT Withdrawal</a></li>
                     		<!-- <li><a class="slide-item"  href="<?php echo base_url('Dashboard/Fund/maintransfer_fund') ?>">Transfer to <?php echo currency; ?>-Wallet</a></li> -->
                      		<li><a class="slide-item"  href="<?php echo base_url('Dashboard/withdraw_history') ?>">Withdrawal History</a></li>
							</ul>
						</li>


						<!-- <li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 4C9.24 4 7 6.24 7 9c0 2.85 2.92 7.21 5 9.88 2.11-2.69 5-7 5-9.88 0-2.76-2.24-5-5-5zm0 7.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" opacity=".3"/><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zM7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 2.88-2.88 7.19-5 9.88C9.92 16.21 7 11.85 7 9z"/><circle cx="12" cy="9" r="2.5"/></svg><span class="side-menu__label">Game</span><i class="angle fe fe-chevron-down"></i></a>
							<ul class="slide-menu">
							 <li><a  class="slide-item" href="<?php //echo base_url('Dashboard/Game/register_game'); ?>"> Gamex21 Registration</a></li>
		                    <li ><a class="slide-item"  href="<?php //echo base_url('Dashboard/Game/game_recharge'); ?>"> Game Recharge</a></li>
							</ul>
						</li> -->



						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#">
								<i class="mdi mdi-ticket"></i>
								<span class="side-menu__label">Support</span><i class="angle fe fe-chevron-down"></i></a>
							<ul class="slide-menu">
							 <li><a  class="slide-item" href="<?php echo base_url('Dashboard/Support/ComposeMail'); ?>"> Create Ticket</a></li>
		                    <li ><a class="slide-item"  href="<?php echo base_url('Dashboard/Support/Inbox'); ?>"> Inbox</a></li>
		                    <li ><a class="slide-item"  href="<?php echo base_url('Dashboard/Support/Outbox'); ?>"> Outbox</a></li>
							</ul>
						</li>
												<li class="slide">
							<a class="side-menu__item" href="<?php echo base_url('Dashboard/User/logout'); ?>">
								<i class="mdi mdi-power"></i>
								<span class="side-menu__label">Logout</span></a>
						</li>




					</ul>
				</div>
			</aside>
			<!-- main-sidebar -->        <!-- main-sidebar -->

        <!-- main-content -->
        <div class='main-content app-content'>

            <!-- main-header -->
            <!-- main-header -->
				<div class="main-header sticky side-header nav nav-item">
					<div class="container-fluid">
						<div class="main-header-left ">
							<div class="responsive-logo">
								<a href="/"><img src="<?php echo base_url('uploads/');?>logo-n.png" style="max-width: 100px;
    height: auto;" class="logo-1" alt="logo"></a>
								<a href="/"><img src="<?php echo base_url('uploads/');?>logo-n.png" style="max-width: 100px;
    height: auto;" class="dark-logo-1" alt="logo"></a>
								<a href="/"><img src="<?php echo base_url('uploads/');?>logo-n.png" style="max-width: 100px;
    height: auto;" class="logo-2" alt="logo"></a>
								<a href="/"><img src="<?php echo base_url('uploads/');?>logo-n.png" style="max-width: 100px;
    height: auto;" class="dark-logo-2" alt="logo"></a>

							</div>
							<div class="app-sidebar__toggle" data-bs-toggle="sidebar">
								<a class="open-toggle" href="#"><i class="header-icon fe fe-align-left" ></i></a>
								<a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
							</div>

						</div>
						<div class="main-header-right">

							<div class="nav nav-item  navbar-nav-right ms-auto">
								
								<div class="dropdown nav-item main-header-message ">
									<a class="new nav-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg><span class=" pulse-danger"></span></a>
									<div class="dropdown-menu">
										<div class="menu-header-content bg-primary text-start">
											<div class="d-flex">
												<h6 class="dropdown-title mb-1 tx-15 text-white fw-semibold">Messages</h6>
												<span class="badge rounded-pill bg-warning ms-auto my-auto float-end">Mark All Read</span>
											</div>
											<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">

											</p>
										</div>
										<div class="main-message-list chat-scroll">

										</div>

									</div>
								</div>
								<div class="dropdown nav-item main-header-notification">
									<a class="new nav-link" href="#">
									<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg><span class=" pulse"></span></a>
									<div class="dropdown-menu">
										<div class="menu-header-content bg-primary text-start">
											<div class="d-flex">
												<h6 class="dropdown-title mb-1 tx-15 text-white fw-semibold">Notifications</h6>
												<span class="badge rounded-pill bg-warning ms-auto my-auto float-end">Mark All Read</span>
											</div>
											<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 "></p>
										</div>
										<div class="main-notification-list Notification-scroll">

										</div>
										<div class="dropdown-footer">
											<a href="notification.html">VIEW ALL</a>
										</div>
									</div>
								</div>

								<div class="dropdown main-profile-menu nav nav-item nav-link">
									<a class="profile-user d-flex" href="#"><img alt="" src="<?php echo base_url('Latestdashboard/');?>img/faces/6.jpg"></a>
									<div class="dropdown-menu">
										<div class="main-header-profile bg-primary p-3">
											<div class="d-flex wd-100p">
												<div class="main-img-user"><img alt="" src="<?php echo base_url('Latestdashboard/');?>img/faces/6.jpg" class=""></div>
												<div class="ms-3 my-auto">
													<h6><?php echo $user_info->name; ?></h6><span></span>
												</div>
											</div>
										</div>
										<a class="dropdown-item" href="<?php echo base_url('Dashboard/Profile'); ?>"><i class="bx bx-cog"></i> Edit Profile</a>
										<a class="dropdown-item" href="<?php echo base_url('Dashboard/User/logout'); ?>"><i class="bx bx-log-out"></i> LogOut</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /main-header --><!--/main-header -->
