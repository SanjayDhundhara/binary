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
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo title;?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="https://pictogrammers.github.io/@mdi/font/2.0.46/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url('');?>assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?php echo base_url('');?>assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo base_url('');?>assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?php echo base_url('');?>assets/css/demo_4/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?php echo base_url('');?>assets/images/logo.png" />
    <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
   <!--  <link href="<?php //echo base_url('');?>assets/css/appstyle.css" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <style>
      .horizontal-menu .top-navbar .navbar-brand-wrapper .navbar-brand img {
    max-width: 55px;
   
}

    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_horizontal-navbar.html -->
      <div class="horizontal-menu">
        <nav class="navbar top-navbar col-lg-12 col-12 p-0">
          <div class="container">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
              <a class="navbar-brand brand-logo" href="/"><img src="<?php echo base_url('');?>assets/images/logo.png" alt="logo" /></a>
              <a class="navbar-brand brand-logo-mini" href="/"><img src="<?php echo base_url('');?>assets/images/logo.png" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            
              <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                  <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    <div class="nav-profile-img">
                      <img src="<?php echo base_url('');?>assets/images/faces/face1.jpg" alt="image">
                      <span class="availability-status online"></span>
                    </div>
                    <div class="nav-profile-text">
                      <!-- <p class="text-black"><?php //echo ($userinfo->name) ?> (<?php //echo ($userinfo->user_id) ?>)</p> -->
                    </div>
                  </a>
                  <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="#">
                      <i class="mdi mdi-cached mr-2 text-success"></i> Activity Log </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo base_url('Dashboard/User/logout'); ?>">
                      <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
                  </div>
                </li>
              
                <li class="nav-item dropdown">
                  <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-email-outline"></i>
                    <span class="count-symbol bg-warning"></span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                    <h6 class="p-3 mb-0">Messages</h6>
                   <?php 
                    // $mynews = $this->User_model->get_records('news',[],'*');
                   // $mynews = mynews();
                   foreach($mynews as $n):
                    ?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item" id="news" href="<?php echo base_url('Dashboard/User/mynews/'.$n['id'])?>">
                      <div class="preview-thumbnail">
                        <img src="<?php echo base_url('');?>assets/images/faces/face4.jpg" alt="image" class="profile-pic">
                      </div>
                      <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                        <p><h6 class="preview-subject ellipsis mb-1 font-weight-normal"><?php echo $n['news'];?></h6></p>
                        <!-- <p class="text-gray mb-0"> 1 Minutes ago </p> -->
                      </div>
                    </a>
                    <?php endforeach; ?>
                    <!-- <div class="dropdown-divider"></div> -->
                   <!--  <a class="dropdown-item preview-item">
                      <div class="preview-thumbnail">
                        <img src="<?php echo base_url('');?>assets/images/faces/face2.jpg" alt="image" class="profile-pic">
                      </div>
                      <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                        <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message</h6>
                        <p class="text-gray mb-0"> 15 Minutes ago </p>
                      </div>
                    </a> -->
                   <!--  <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                      <div class="preview-thumbnail">
                        <img src="<?php echo base_url('');?>assets/images/faces/face3.jpg" alt="image" class="profile-pic">
                      </div>
                      <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                        <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated</h6>
                        <p class="text-gray mb-0"> 18 Minutes ago </p>
                      </div>
                    </a> -->
                    <div class="dropdown-divider"></div>
                    <h6 class="p-3 mb-0 text-center"><?php echo count($mynews)?> new messages</h6>
                  </div>
                </li>
                <li class="nav-item dropdown" style="display: none;">
                  <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                    <i class="mdi mdi-bell-outline"></i>
                    <span class="count-symbol bg-danger"></span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                    <h6 class="p-3 mb-0">Notifications</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                      <div class="preview-thumbnail">
                        <div class="preview-icon bg-success">
                          <i class="mdi mdi-calendar"></i>
                        </div>
                      </div>
                      <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                        <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                        <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today </p>
                      </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                      <div class="preview-thumbnail">
                        <div class="preview-icon bg-warning">
                          <i class="mdi mdi-cog"></i>
                        </div>
                      </div>
                      <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                        <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
                        <p class="text-gray ellipsis mb-0"> Update dashboard </p>
                      </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                      <div class="preview-thumbnail">
                        <div class="preview-icon bg-info">
                          <i class="mdi mdi-link-variant"></i>
                        </div>
                      </div>
                      <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                        <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                        <p class="text-gray ellipsis mb-0"> New admin wow! </p>
                      </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <h6 class="p-3 mb-0 text-center">See all notifications</h6>
                  </div>
                </li>
                <li class="nav-item nav-logout d-none d-lg-flex">
                  <a class="nav-link" href="<?php echo base_url('Dashboard/User/logout'); ?>">
                    <i class="mdi mdi-power"></i>
                  </a>
                </li>
               
              </ul>
              <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
                <span class="mdi mdi-menu"></span>
              </button>
            </div>
          </div>
        </nav>
        <nav class="bottom-navbar">
          <div class="container">
            <ul class="nav page-navigation">
             <!--  <li class="nav-item">
                <a class="nav-link" href="index-2.html">
                  <i class="mdi mdi-home menu-icon"></i>
                  <span class="menu-title">Dashboard</span>
                </a>
              </li> -->
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('Dashboard/User/'); ?>">
                  <i class="mdi mdi-file-restore menu-icon"></i>
                  <span class="menu-title">Dashboard </span>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                  <span class="menu-title">My Profile</span>
                  <i class="menu-arrow"></i>
                </a>
                 <div class="submenu">
                  <ul class="submenu-item">
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('Dashboard/Profile'); ?>">Edit Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('Dashboard/Profile/zilUpdate'); ?>">Edit <?php echo currency; ?> Address</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('Dashboard/Profile/changePassword'); ?>">Change Password</a></li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('Dashboard/User/Register/?sponser_id=' . $user_info->user_id); ?>" class="nav-link" target="_blank">
                  <i class="mdi mdi-account-check menu-icon"></i>
                  <span class="menu-title">Register </span></a>
              </li>
              <li class="nav-item d-none">
                <a href="#" class="nav-link">
                  <i class="mdi mdi-clipboard-text menu-icon"></i>
                  <span class="menu-title">Wallet</span>
                  <i class="menu-arrow"></i></a>
                <div class="submenu">
                  <ul class="submenu-item">
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('Dashboard/Payment'); ?>">Deposit Wallet</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('Dashboard/Fund/transfer_fund'); ?>">Transfer Wallet</a></li>
                  </ul>
                </div>
              </li>
              <li class="nav-item d-none">
                <a href="#" class="nav-link">
                  <i class="mdi mdi-chart-bar menu-icon"></i>
                  <span class="menu-title"> Account Active</span>
                  <i class="menu-arrow"></i></a>
                  <div class="submenu">
                    <ul class="submenu-item">
                      <li class="nav-item"><a class="nav-link" href="<?php echo base_url('Dashboard/Activation'); ?>">Active New Account</a></li>
                      <?php if($none == 0): if($user_info->paid_status == 1): ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('Dashboard/Activation/UpgradeAccount'); ?>">Upgrade Account</a></li>
                      <?php endif; endif;?>
                      <li class="nav-item"><a class="nav-link" href="<?php echo base_url('Dashboard/Fund/activation_history'); ?>">Active Account History</a></li>
                    </ul>
                  </div>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="mdi mdi-content-copy menu-icon"></i>
                  <span class="menu-title">My Team </span>
                  <i class="menu-arrow"></i></a>
                 <div class="submenu">
                    <ul class="submenu-item">
                      <li class="nav-item"><a class="nav-link" href="<?php echo base_url('Dashboard/User/Directs'); ?>">My Directs</a></li>
                      <li class="nav-item"><a class="nav-link" href="<?php echo base_url('Dashboard/User/Genelogy'); ?>">Team View</a></li>
                      <li class="nav-item"><a class="nav-link" href="<?php echo base_url('Dashboard/User/Tree/' . $user_info->user_id); ?>">My Directs Tree</a></li>
                   <!--    <li><a href="<?php echo base_url('Dashboard/User/Downline/L'); ?>">Left Downline</a></li>
                      <li><a href="<?php echo base_url('Dashboard/User/Downline/R'); ?>">Right Downline</a></li> -->
                     <!--  <li><a href="<?php echo base_url('Dashboard/User/GenelogyTree/' . $user_info->user_id); ?>">Team Tree</a></li> -->
                    </ul>
                  </div>
              </li>
              
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="mdi mdi-webpack menu-icon"></i>
                  <span class="menu-title">Withdraw <?php echo currency; ?></span>
                  <i class="menu-arrow"></i></a>
                <div class="submenu">
                  <ul class="submenu-item">
                     <li><a href="<?php echo base_url('Dashboard/DirectIncomeWithdraw') ?>">Withdrawal</a></li>
                     <li><a href="<?php echo base_url('Dashboard/Fund/maintransfer_fund') ?>">Transfer to <?php echo currency; ?>-Wallet</a></li>
                      <li><a href="<?php echo base_url('Dashboard/withdraw_history') ?>">Withdrawal History</a></li> 
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" target="_blank">
                  <i class="mdi mdi-file-document-box menu-icon"></i>
                  <span class="menu-title">Account Statement</span></a>
                   <div class="submenu">
                  <ul class="submenu-item">
                     <?php
                                  $incomes = incomes();
                                  foreach ($incomes as $key => $income) {
                                      echo'  <li class="nav-item">
                                            <a class="nav-item" href="' . base_url('Dashboard/User/Income/' . $key) . '">' . $income . '</a>
                                         </li>';
                                  }
                                  ?>
                   
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('Dashboard/User/income_ledgar'); ?>"> Income Ledger</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('Dashboard/Settings/payout_summary'); ?>"> Datewise Payout Summary</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('Dashboard/Settings/week_payout_summary'); ?>"> Weekwise Payout Summary</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('Dashboard/rewards'); ?>"> Reward Ledger</a></li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" target="_blank">
                  <i class="mdi mdi-file-document-box menu-icon"></i>
                  <span class="menu-title">Support </span></a>
                    <div class="submenu">
                  <ul class="submenu-item">
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('Dashboard/Support/ComposeMail'); ?>"> Create Ticket</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('Dashboard/Support/Inbox'); ?>"> Inbox</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('Dashboard/Support/Outbox'); ?>"> Outbox</a></li>

                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('Dashboard/User/logout'); ?>" class="nav-link">
                  <i class="mdi mdi-power menu-icon"></i>
                  <span class="menu-title">Logout </span></a>
              </li>
            </ul>
          </div>
        </nav>
      </div>

 
