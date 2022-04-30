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
<html lang="en" dir="ltr">
	<head>

		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="" name="description">
		<meta content="" name="author">
		<meta name="keywords" content=""/>

		<!-- Title -->
		<title><?php echo title;?></title>

		<!--Favicon -->
		<link rel="icon" href="<?php echo base_url('Dashboard/');?>images/brand/favicon.ico" type="image/x-icon"/>

		<!-- Bootstrap css -->
		<link href="<?php echo base_url('Dashboard/');?>plugins/bootstrap/css/bootstrap.css" rel="stylesheet" />

		<!-- Style css -->
		<link href="<?php echo base_url('Dashboard/');?>css/style.css" rel="stylesheet" />

		<!-- Dark css -->
		<link href="<?php echo base_url('Dashboard/');?>css/dark.css" rel="stylesheet" />

		<!-- Skins css -->
		<link href="<?php echo base_url('Dashboard/');?>css/skins.css" rel="stylesheet" />

		<!-- Animate css -->
		<link href="<?php echo base_url('Dashboard/');?>css/animated.css" rel="stylesheet" />

		<!--Sidemenu css -->
        <link href="<?php echo base_url('Dashboard/');?>css/sidemenu.css" rel="stylesheet">

		<!-- P-scroll bar css-->
		<link href="<?php echo base_url('Dashboard/');?>plugins/p-scrollbar/p-scrollbar.css" rel="stylesheet" />

		<!---Icons css-->
		<link href="<?php echo base_url('Dashboard/');?>css/icons.css" rel="stylesheet" />

		<!-- INTERNAl Select2 css -->
		<link href="<?php echo base_url('Dashboard/');?>plugins/select2/select2.min.css" rel="stylesheet" />

		<!-- INTERNAL Morris Charts css -->
		<link href="<?php echo base_url('Dashboard/');?>plugins/morris/morris.css" rel="stylesheet" />

		<!-- INTERNAL Data table css -->
		<link href="<?php echo base_url('Dashboard/');?>plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />

		<style>
			body {
			    background:#edeff5 !important;
			 
			}
			.app-sidebar {
			    background: #fff;
			}
			.profile-user {
				color: #fff;
			    padding-left: 15px;
			}
			.profile-user i{
				color: #fff;
			}
			.profile-data span{
			    padding-left: 15px;
			}
			.profile-img {
			    max-width: 40px;
			}
			.side-menu h3 {
			    color: #055aaa;
			}
			.side-menu__item:hover .side-menu__icon, .side-menu__item:focus .side-menu__icon {
			    fill: rgba(255, 255, 255, 0.05);
			    color: rgb(5 90 170);
			}
			.slide-item.active, .slide-item:hover, .slide-item:focus {
			    color: #055aaa;
			}
			.side-menu__item.active:before {
			    border-right: 20px solid #fff;
			}
			.side-menu__item.active:after {
			    border-right: 20px solid #fff;
			}
		
.slide-item{
	color: #000;
}
.side-menu .side-menu__icon {
    color: #055aaa;
}
.side-menu__item
{
	color:#000 !important;
}

	.app-sidebar__logo{
		background-color: #fff;
		border-radius: 0px;
		padding: 8px;
	}
.app-sidebar__user {
    background: #055aaa;
}

@media screen and (min-width: 768px){

			.app-header {
			    background: #055aaa !important;
			}
			.app-sidebar__toggle svg {
			    fill: #ffffff;
			}
.svg-icon, .header-icon, .header-icon2 {
    color: transparent !important;
    fill: #ffffff;
}
}
</style>
	</head>
	<body class="app sidebar-mini">

		<!---Global-loader-->
		<div id="global-loader" >
			<img src="<?php echo base_url('Dashboard/');?>images/svgs/loader.svg" alt="loader">
		</div>
		<!---/Global-loader-->

		<!-- Page -->
		<div class="page">
			<div class="page-main">

				<!--aside open-->
				<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
				<aside class="app-sidebar">
					<div class="app-sidebar__logo">
						<a class="header-brand" href="index.html">
							<img src="<?php echo base_url('uploads/');?>logo.png" class="header-brand-img desktop-lgo" alt="Covido logo">
							<img src="<?php echo base_url('uploads/');?>logo.png" class="header-brand-img dark-logo" alt="Covido logo">
							<img src="<?php echo base_url('uploads/');?>logo.png" class="header-brand-img mobile-logo" alt="Covido logo">
						</a>
					</div>
					<div class="app-sidebar3">
						<div class="app-sidebar__user">
							<ul>
							<li class="slide">
								<a class="side-menu__item p-0" data-toggle="slide" href="#">
								<span class="shape1"></span>
								<span class="shape2"></span>
									<?php if(!empty($bankinfo->profile_image)):?>
                                    	<img  alt="" src="<?php echo base_url('uploads/'.$bankinfo->profile_image);?>" class="rounded-circle mb-1 profile-img">
									<?php else:?>
										<img alt="" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png"  class="rounded-circle mb-1">
									<?php endif;?>
								<span class="side-menu__label profile-user"><?php echo $user_info->name; ?><br> <?php echo $user_info->user_id; ?></span><i class="angle fa fa-angle-right text-white"></i></a>
								<ul class="slide-menu p-0 profile-data">
									<li><a href="#" class="slide-item text-white">ID <span></span></a></li>
									<li><a href="#" class="slide-item text-white">MP <span> My Profile</span></a></li>
									<li><a href="#" class="slide-item text-white">CP <span></span>Change Password</a></li>
									<li><a href="#" class="slide-item text-white">LO <span>Logout</span></a></li>
								
								</ul>
							</li>
							</ul>
						</div>
						<ul class="side-menu">
							<li><h3>MAIN MENU</h3></li>
							<li class="slide">
								<a class="side-menu__item"   href="<?php echo base_url('Dashboard/User/'); ?>">
									<span class="shape1"></span>
									<span class="shape2"></span>
									<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
									<span class="side-menu__label">Dashboard</span>
								</a>
							</li>
							<li class="slide">
								<a class="side-menu__item" data-toggle="slide" href="#">
								<span class="shape1"></span>
								<span class="shape2"></span>
									<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
								<span class="side-menu__label">Profile</span><i class="angle fa fa-angle-right"></i></a>
								<ul class="slide-menu">
								<li><a href="<?php echo base_url('Dashboard/Profile/'); ?>" class="slide-item"> Edit Profile</a></li>
									<li><a href="<?php echo base_url('Dashboard/Profile/zilUpdate'); ?>" class="slide-item"> Update Wallet Address</a></li> 
									
								<li><a href="<?php echo base_url('Dashboard/transaction-password'); ?>" class="slide-item">Change Security Password</a></li>
									
								</ul>
							</li>
							
							<li class="slide">
								<a class="side-menu__item" data-toggle="slide" href="#">
								<span class="shape1"></span>
								<span class="shape2"></span>
									<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
								<span class="side-menu__label">Account</span><i class="angle fa fa-angle-right"></i></a>
								<ul class="slide-menu">
									<li><a href="<?php echo base_url('Dashboard/Activation'); ?>" class="slide-item">Activate Account</a></li>
								
									<li><a href="<?php echo base_url('Dashboard/staking-history'); ?>" class="slide-item">Coin History</a></li>
								</ul>
							</li>
							
						
							
							
							
							<li class="slide">
								<a class="side-menu__item" data-toggle="slide" href="#">
								<span class="shape1"></span>
								<span class="shape2"></span>
								<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
								<span class="side-menu__label">Income Reports</span><i class="angle fa fa-angle-right"></i></a>
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
								<a class="side-menu__item" data-toggle="slide" href="#">
								<span class="shape1"></span>
								<span class="shape2"></span>
								<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
								<span class="side-menu__label">Deposit Management</span><i class="angle fa fa-angle-right"></i></a>
								<ul class="slide-menu">
									<li><a  class="slide-item" href="<?php echo base_url('Dashboard/fund/Request_fund'); ?>">Deposit</a></li>
									<li><a  class="slide-item" href="<?php echo base_url('Dashboard/fund/depositHistory'); ?>">Deposit Transactions</a></li>
									<li><a  class="slide-item" href="<?php echo base_url('Dashboard/fund/transfer_fund'); ?>">P2P Transfer</a></li>
									<li><a  class="slide-item" href="<?php echo base_url('Dashboard/fund/wallet_ledger'); ?>">Fund History</a></li>
								</ul>
							</li>
							<li><h3>TEAM BUSINESS</h3></li>
							<li class="slide">
								<a class="side-menu__item" data-toggle="slide" href="#">
								<span class="shape1"></span>
								<span class="shape2"></span>
								<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path></svg>
								<span class="side-menu__label">My Team</span><i class="angle fa fa-angle-right"></i></a>
								<ul class="slide-menu">
									
			                    <li><a  class="slide-item" href="<?php echo base_url('Dashboard/User/Genelogy'); ?>">Team View</a></li>
			                    <li><a  class="slide-item" href="<?php echo base_url('Dashboard/User/Tree/' . $user_info->user_id); ?>">My Directs Tree</a></li>
			                    <li><a  class="slide-item" href="<?php echo base_url('Dashboard/Network/levelView'); ?>">Business Report</a></li>
								
			                      <li><a class="slide-item" href="<?php echo base_url('Dashboard/User/Downline/L'); ?>">Left Downline</a></li>
			                      <li><a class="slide-item" href="<?php echo base_url('Dashboard/User/Downline/R'); ?>">Right Downline</a></li>
			                      <li><a class="slide-item" href="<?php echo base_url('Dashboard/User/GenelogyTree/' . $user_info->user_id); ?>">Team Tree</a></li>
								</ul>
							</li>
						<!-- 	<li class="slide">
								<a class="side-menu__item" data-toggle="slide" href="#">
								<span class="shape1"></span>
								<span class="shape2"></span>
								<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
								<span class="side-menu__label">Account Statement</span><i class="angle fa fa-angle-right"></i></a>
								<ul class="slide-menu">
								//	<li><a href="<?php// echo base_url('Dashboard/Settings/payout_summary'); ?>" class="slide-item">Payout Summary</a></li>

								//	 <?php
								//	$incomes = incomes();
								//	foreach($incomes as $key => $inc):
								//?>
                            	//<li><a class="slide-item" href="<?php// echo base_url('Dashboard/Reports/incomes/'.$key.'/'.date('Y-m-d')); //?>"><?php// echo 'Daily '.$inc;?></a></li>
                           // <?php
  								//	endforeach;
  								//?>


								</ul>
							</li> -->
						
							
							<li class="slide">
								<a class="side-menu__item" data-toggle="slide" href="#">
								<span class="shape1"></span>
								<span class="shape2"></span>
								<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
								<span class="side-menu__label">Withdraw <?php echo currency; ?></span><i class="angle fa fa-angle-right"></i></a>
								<ul class="slide-menu">
									<li><a class="slide-item"  href="<?php echo base_url('Dashboard/DirectIncomeWithdraw') ?>">Withdrawal</a></li>
									
		                     		<!-- <li><a class="slide-item"  href="<?php echo base_url('Dashboard/Fund/maintransfer_fund') ?>">Transfer to <?php echo currency; ?>-Wallet</a></li> -->
		                      		<li><a class="slide-item"  href="<?php echo base_url('Dashboard/withdraw_history') ?>">Withdrawal History</a></li>
								</ul>
							</li>
							<li class="slide">
								<a class="side-menu__item" data-toggle="slide" href="#">
								<span class="shape1"></span>
								<span class="shape2"></span>
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="side-menu__icon"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
								<span class="side-menu__label">Support</span><i class="angle fa fa-angle-right"></i></a>
								<ul class="slide-menu">
									<li><a  class="slide-item" href="<?php echo base_url('Dashboard/Support/ComposeMail'); ?>"> Create Ticket</a></li>
		                    		<li ><a class="slide-item"  href="<?php echo base_url('Dashboard/Support/Inbox'); ?>"> Inbox</a></li>
		                    		<li ><a class="slide-item"  href="<?php echo base_url('Dashboard/Support/Outbox'); ?>"> Outbox</a></li>
								</ul>
							</li>
							<li class="slide">
								<a class="side-menu__item" href="<?php echo base_url('Dashboard/User/logout'); ?>">
								<span class="shape1"></span>
								<span class="shape2"></span>
								<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
								<span class="side-menu__label">Logout</span></a>
							</li>
						</ul>
					</div>
				</aside>
				<!--aside closed-->

				<div class="app-content">
					<div class="side-app">

						<!--app header-->
						<div class="app-header header">
							<div class="container-fluid">
								<div class="d-flex">
									<a class="header-brand" href="index.html">
										<img src="<?php echo base_url('uploads/');?>logo.png" class="header-brand-img desktop-lgo" alt="Zendashlogo">
										<img src="<?php echo base_url('uploads/');?>logo.png" class="header-brand-img dark-logo" alt="Zendashlogo">
										<img src="<?php echo base_url('uploads/');?>logo.png" class="header-brand-img mobile-logo" alt="Zendashlogo">
									</a>
									<div class="app-sidebar__toggle" data-toggle="sidebar">
										<a class="open-toggle" href="#">
											<svg class="header-icon mt-1" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M21 11.01L3 11v2h18zM3 16h12v2H3zM21 6H3v2.01L21 8z"></path></svg>
										</a>
									</div>
								
									<div class="d-flex order-lg-2 ml-auto">
										<a href="#" data-toggle="search" class="nav-link nav-link-lg d-md-none navsearch">
											<svg class="header-icon search-icon" x="1008" y="1248" viewBox="0 0 24 24"  height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
												<path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
											</svg>
										</a>
										<div class="dropdown header-message">
											<a class="nav-link icon p-0" data-toggle="dropdown">
												<svg class="header-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3"/><path d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z"/></svg>
												<span class="badge badge-success">8</span>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow  animated p-0">
												<div class="message-menu">
													<a class="dropdown-item d-flex pb-3 border-bottom" href="#">
														<span class="avatar avatar-md brround mr-3 align-self-center cover-image" data-image-src="<?php echo base_url('Dashboard/');?>images/users/1.jpg"></span>
														<div>
															<strong>Madeleine</strong> Hey! there I' am available....
															<div class="small text-muted">
																3 hours ago
															</div>
														</div>
													</a>
													<a class="dropdown-item d-flex pb-3 border-bottom" href="#">
														<span class="avatar avatar-md brround mr-3 align-self-center cover-image" data-image-src="<?php echo base_url('Dashboard/');?>images/users/12.jpg"></span>
														<div>
															<strong>Anthony</strong> New product Launching...
															<div class="small text-muted">
																5 hour ago
															</div>
														</div>
													</a>
													<a class="dropdown-item d-flex pb-3 border-bottom" href="#">
														<span class="avatar avatar-md brround mr-3 align-self-center cover-image" data-image-src="<?php echo base_url('Dashboard/');?>images/users/4.jpg"></span>
														<div>
															<strong>Olivia</strong> New Schedule Realease......
															<div class="small text-muted">
																45 mintues ago
															</div>
														</div>
													</a>
													<a class="dropdown-item d-flex pb-3 border-bottom" href="#">
														<span class="avatar avatar-md brround mr-3 align-self-center cover-image" data-image-src="<?php echo base_url('Dashboard/');?>images/users/15.jpg"></span>
														<div>
															<strong>Sanderson</strong> New Schedule Realease......
															<div class="small text-muted">
																2 days ago
															</div>
														</div>
													</a>
												</div>
												<a href="#" class="dropdown-item text-center">See all Messages</a>
											</div>
										</div>
										<div class="dropdown header-notify">
											<a class="nav-link icon p-0" data-toggle="dropdown">
												<svg class="header-icon" x="1008" y="1248" viewBox="0 0 24 24"  height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false"><path opacity=".3" d="M12 6.5c-2.49 0-4 2.02-4 4.5v6h8v-6c0-2.48-1.51-4.5-4-4.5z"></path><path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-11c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2v-5zm-2 6H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6zM7.58 4.08L6.15 2.65C3.75 4.48 2.17 7.3 2.03 10.5h2a8.445 8.445 0 013.55-6.42zm12.39 6.42h2c-.15-3.2-1.73-6.02-4.12-7.85l-1.42 1.43a8.495 8.495 0 013.54 6.42z"></path></svg>
												<span class="pulse "></span>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow  animated p-0">
												<div class="notifications-menu">
													<a class="dropdown-item d-flex pb-4 border-bottom" href="#">
														<span class="avatar avatar-md mr-3 align-self-center cover-image bg-gradient-danger brround">
															<i class="fe fe-download"></i>
														</span>
														<div>
															<span class="font-weight-bold"> New file has been Uploaded </span>
															<div class="small text-muted d-flex">
																5 hour ago
															</div>
														</div>
													</a>
													<a class="dropdown-item d-flex pb-4 border-bottom" href="#">
														<span class="avatar avatar-md  mr-3 align-self-center cover-image bg-gradient-teal brround">
															<i class="fe fe-user"></i>
														</span>
														<div>
															<span class="font-weight-bold"> User account has Updated</span>
															<div class="small text-muted d-flex">
																20 mins ago
															</div>
														</div>
													</a>
													<a class="dropdown-item d-flex pb-4 border-bottom" href="#">
														<span class="avatar avatar-md  mr-3 align-self-center cover-image bg-gradient-info brround">
															<i class="fe fe-shopping-cart"></i>
														</span>
														<div>
															<span class="font-weight-bold"> New Order Recevied</span>
															<div class="small text-muted d-flex">
																1 hour ago
															</div>
														</div>
													</a>
													<a class="dropdown-item d-flex pb-4 border-bottom" href="#">
														<span class="avatar avatar-md mr-3 align-self-center cover-image bg-gradient-pink brround">
															<i class="fe fe-server"></i>
														</span>
														<div>
															<span class="font-weight-bold">Server Rebooted</span>
															<div class="small text-muted d-flex">
																2 hour ago
															</div>
														</div>
													</a>
												</div>
												<a href="#" class="dropdown-item text-center">View all Notification</a>
											</div>
										</div>
									<!-- 	<div class="dropdown   header-fullscreen" >
											<a  class="nav-link icon full-screen-link p-0"  id="fullscreen-button">
												<svg class="header-icon" x="1008" y="1248" viewBox="0 0 24 24"  height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false"><path d="M7,14 L5,14 L5,19 L10,19 L10,17 L7,17 L7,14 Z M5,10 L7,10 L7,7 L10,7 L10,5 L5,5 L5,10 Z M17,17 L14,17 L14,19 L19,19 L19,14 L17,14 L17,17 Z M14,5 L14,7 L17,7 L17,10 L19,10 L19,5 L14,5 Z"></path></svg>
											</a>
										</div> -->
										<div class="dropdown profile-dropdown">
											<a href="#" class="nav-link pr-0 pl-2 leading-none" data-toggle="dropdown">
												<span>
												<?php if(!empty($bankinfo->profile_image)):?>
                                    	<img alt="" src="<?php echo base_url('uploads/'.$bankinfo->profile_image);?>" class="avatar avatar-md brround">
									<?php else:?>
										<img alt="" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png" class="avatar avatar-md brround">
									<?php endif;?>
												</span>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated p-0">
												<div class="text-center border-bottom pb-4 pt-4">
													<a href="#" class="text-center user pb-0 font-weight-bold"><?php echo $user_info->name; ?></a>
													<p class="text-center user-semi-title mb-0"><?php echo $user_info->user_id; ?></p>
												</div>
												<a class="dropdown-item border-bottom" href="#">
													<i class="dropdown-icon mdi mdi-account-outline"></i> My Profile
												</a>
												<a class="dropdown-item border-bottom" href="<?php echo base_url('Dashboard/Profile'); ?>">
													<i class="dropdown-icon zmdi zmdi-edit"></i> Edit Profile
												</a>
												<a class="dropdown-item border-bottom" href="#">
													<i class="dropdown-icon  mdi mdi-settings"></i> Account Settings
												</a>
												<a class="dropdown-item border-bottom" href="#">
													<i class="dropdown-icon mdi  mdi-message-outline"></i> Inbox
												</a>
												<a class="dropdown-item border-bottom" href="#">
													<i class="dropdown-icon mdi mdi-comment-check-outline"></i> Message
												</a>
												<a class="dropdown-item border-bottom" href="#">
													<i class="dropdown-icon mdi mdi-compass-outline"></i> Need help?
												</a>
												<a class="dropdown-item border-bottom" href="<?php echo base_url('Dashboard/User/logout'); ?>">
													<i class="dropdown-icon mdi  mdi-logout-variant"></i> Sign out
												</a>
											</div>
										</div>


										
									</div>
								</div>
							</div>
						</div>
						<!--/app header-->