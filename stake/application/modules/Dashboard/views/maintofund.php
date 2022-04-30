<?php
include_once'header.php';
$userinfo = userinfo();
// pr($userinfo,true);
date_default_timezone_set('asia/kolkata')
?>
<style>
.card.mini-stat.bg-primary.text-white {
    min-height: 120px;
    text-align: center;
}
.news {
    height: 223px;
}
.text-white-50 {
    color: #fff !important;
}
.card .card-body {
    padding: 1.0rem 1rem;
}
marquee {
    height: 100%;
}
tr:nth-child(even) {background-color: #f2f2f2;}

@media screen and (max-width:575px){
    .news {
        height: 100px;
    }
}
.horizontal-menu{
    visibility: hidden;
}
footer.footer {
    display: none;
}
</style>
<script>
function countdown(element, seconds) {
    // Fetch the display element
    var el = document.getElementById(element).innerHTML;

    // Set the timer
    var interval = setInterval(function() {
        if (seconds <= 0) {
            //(el.innerHTML = "level lapsed");
            $('#'+element).text('level lapsed')

            clearInterval(interval);
            return;
        }
        var time = secondsToHms(seconds)
        $('#'+element).text(time)

        seconds--;
    }, 1000);
}

function secondsToHms(d) {
    d = Number(d);
    var day = Math.floor(d / (3600 * 24));
    var h = Math.floor(d % (3600 * 24) / 3600);
    var m = Math.floor(d % 3600 / 60);
    var s = Math.floor(d % 3600 % 60);

    var dDisplay = day > 0 ? day + (day == 1 ? " day, " : " days, ") : "";
    var hDisplay = h > 0 ? h + (h == 1 ? " hour, " : " hours, ") : "";
    var mDisplay = m > 0 ? m + (m == 1 ? " minute, " : " minutes, ") : "";
    var sDisplay = s > 0 ? s + (s == 1 ? " second" : " seconds") : "";
    var t = dDisplay + hDisplay + mDisplay + sDisplay;
    return t;
    // console.log(t)
}
</script>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content py-0">
                <div class="footer-tab">
                    <div class="tile" id="tile-1">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs nav-justified" role="tablist">
    <div class="slider"></div>
     <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-home"></i> Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-id-card"></i> Portfolio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-map-signs"></i> Refer </a>
      </li>
    <li class="nav-item">
        <a class="nav-link" id="setting-tab" data-toggle="tab" href="#setting" role="tab" aria-controls="setting" aria-selected="false"><i class="fas fa-cogs"></i> Settings</a>
      </li>
  </ul>

  <!-- Tab panes -->
      <div class="tab-content">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
             <div class="app-top-head">
                            <div class="app-logo">
                                <img src="<?php echo base_url('uploads/logo.png');?>" class="img-fluid">
                            </div>
                            
                            <div class="app-logout">
                                <a href="<?php echo base_url('Dashboard/User/logout') ?>">
                                    <img src="<?php echo base_url('assets/images/app-logout-img.png');?>">
                                </a>
                            </div>
                            <div class="app-logout">
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/notification.png');?>">
                                </a>
                            </div>
                        </div>
                        <div class="user-deatils-bg">
                            <div class="user-deatils">
                                <p>User Name : <?php echo $userinfo->name ?> </p>
                                <p>User Id :  <?php echo $userinfo->user_id ?></p>
                              
                                <p>Joining Date :  <?php echo $userinfo->created_at ?> </p>
                                <div class="package-box">
                                      <p>Package <span> <?php echo $userinfo->package_amount; ?></span></p>
                                </div>
                                <div class="wallets">
                                    <div class="wallet-box">
                                    <a href="<?php echo base_url('Dashboard/User/mainWallet') ?>" class="wallet-btn">Main Wallets</a>
                                    </div>
                                    <div class="wallet-box">
                                        <a href="#" class="wallet-btn">Fund Wallets</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row m-2">

                        <div class="package-head">
                        <div class="row">
                           
              <div class="col-6 col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white box-bg app-box-top">
                  <div class="card-body">
                                      <!--   <img src="<?php echo base_url('');?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image" /> -->
                    <h4 class="font-weight-normal mb-3">Direct Referral 
                    </h4>
                    <h2>Active : <?php echo $paid_directs['paid_directs']; ?> , InActive : <?php echo $free_directs['free_directs']; ?></h2>
                  </div>
                </div>
              </div>
              <div class="col-6 col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white box-bg app-box-top">
                  <div class="card-body">
                  <!--  <img src="<?php echo base_url('');?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image" />  -->
                    <h4 class="font-weight-normal mb-3">L | R Business 
                    </h4>
                    <h2><?php echo 'L: '.$user['leftBusiness']; ?> | <?php echo 'R: '.$user['rightBusiness']; ?></h2>
                  </div>
                </div>
              </div>
              <div class="col-6 col-md-4 stretch-card grid-margin">
                <div class="card card-img-holder text-white box-bg app-box-top" style="background: linear-gradient(87deg,#5e72e4,#825ee4);">
                  <div class="card-body">
                                      <!--   <img src="<?php echo base_url('');?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image" /> -->
                    <h4 class="font-weight-normal mb-3">Direct Profit
                    </h4>
                    <h2> <span ><?php echo number_format($direct_income['direct_income'], 2); ?> ZiL</span></h2>
                  </div>
                </div>
              </div>
              <div class="col-6 col-md-4 stretch-card grid-margin">
                <div class="card card-img-holder text-white box-bg app-box-top" style="background:#33db9e">
                  <div class="card-body">
                                      <!--   <img src="<?php echo base_url('');?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image" /> -->
                    <h4 class="font-weight-normal mb-3">Total Withdraw 
                    </h4>
                    <h2> <span ><?php echo abs($total_withdrawal['total_withdrawal']); ?></span> ZiL</h2>
                  </div>
                </div>
              </div>
              <div class="col-6 col-md-4 stretch-card grid-margin">
                <div class="card card-img-holder text-white box-bg app-box-top" style="background:linear-gradient(135deg, #ffc480, #ff763b)">
                  <div class="card-body">
                                      <!--   <img src="<?php echo base_url('');?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image" /> -->
                    <h4 class="font-weight-normal mb-3">Available Profit 
                    </h4>
                    <h2> <span ><?php echo number_format($income_balance['income_balance'], 2); ?> ZiL</span></h2>
                  </div>
                </div>
              </div>
              <div class="col-6 col-md-4 stretch-card grid-margin">
                <div class="card card-img-holder text-white box-bg app-box-top" style="background:#33db9e">
                  <div class="card-body">
                                      <!--   <img src="<?php echo base_url('');?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image" /> -->
                    <h4 class="font-weight-normal mb-3">Total Withdraw 
                    </h4>
                    <h2> <span ><?php echo abs($total_withdrawal['total_withdrawal']); ?></span> ZiL</h2>
                  </div>
                </div>
              </div>
              <div class="col-6 col-md-4 stretch-card grid-margin">
                <div class="card card-img-holder text-white box-bg app-box-top" style="background:linear-gradient(316deg, #fc5286, #fbaaa2)">
                  <div class="card-body">
                                      <!--   <img src="<?php echo base_url('');?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image" /> -->
                    <h4 class="font-weight-normal mb-3">Reward Income 
                    </h4>
                    <h2> <span ><?php echo number_format($reward_income['reward_income'], 2); ?></span> ZiL</h2>
                  </div>
                </div>
              </div>
              <div class="col-6 col-md-4 stretch-card grid-margin">
                <div class="card card-img-holder text-white box-bg app-box-top" style="background:linear-gradient(to bottom, #0e4cfd, #6a8eff)">
                  <div class="card-body">
                                      <!--   <img src="<?php echo base_url('');?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image" /> -->
                    <h4 class="font-weight-normal mb-3">Total Profit 
                    </h4>
                    <h2> <span ><?php echo round($total_income['total_income'],2); ?></span> ZiL</h2>
                  </div>
                </div>
              </div>
              <div class="col-6 col-md-4 stretch-card grid-margin">
                <div class="card card-img-holder text-white box-bg app-box-top" style="background:linear-gradient(0deg,#0098f0,#00f2c3)">
                  <div class="card-body">
                                      <!--   <img src="<?php echo base_url('');?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image" /> -->
                    <h4 class="font-weight-normal mb-3">Today Profit 
                    </h4>
                    <h2> <span ><?php echo round($today_income['today_income'],2); ?></span> ZiL</h2>
                  </div>
                </div>
              </div>
            </div>
            </div>
            
             
            </div>
                        <div class="news-bg">
                            <marquee direction="left">Latest News : <?php foreach($news as $key => $new) { echo $new['news']; } ?></marquee>
                        </div>
                        <div class="app-body">
                            <a href="<?php echo base_url('Dashboard/User/income_ledgar'); ?>">
                                <div class="app-box">
                                    <img src="<?php echo base_url('assets/images/user-img.png');?>" class="img-fluid">
                                    <p>Total Income</p>
                                </div>
                            </a>
                            <a href="<?php echo base_url('Dashboard/User/Directs') ?>">
                                <div class="app-box">
                                    <img src="<?php echo base_url('uploads/team.png');?>" class="img-fluid">
                                    <p>Total Team</p>
                                </div>
                            </a>
                            <a href="<?php echo base_url('Dashboard/Payment'); ?>">
                                <div class="app-box">
                                    <img src="<?php echo base_url('uploads/wallet.png');?>" class="img-fluid">
                                    <p>Wallet</p>
                                </div>
                            </a>
                            <a href="<?php echo base_url('Dashboard/Activation/UpgradeAccount'); ?>">
                                <div class="app-box">
                                    <img src="<?php echo base_url('uploads/salary.png');?>" class="img-fluid">
                                    <p>Upgrade Package</p>
                                </div>
                            </a>
                            <a href="<?php echo base_url('Dashboard/Fund/activation_history'); ?>">
                                <div class="app-box">
                                    <img src="<?php echo base_url('uploads/data-collection.png');?>" class="img-fluid">
                                    <p>Activaction History</p>
                                </div>
                            </a>
                            <a href="#">
                                <div class="app-box">
                                    <img src="<?php echo base_url('uploads/data-collection.png');?>" class="img-fluid">
                                    <p>Upgrade History</p>
                                </div>
                            </a>
                            <a href="<?php echo base_url('Dashboard/User/Income/direct_income') ?>">
                                <div class="app-box">
                                    <img src="<?php echo base_url('uploads/team-1.png');?>" class="img-fluid">
                                    <p>direct</p>
                                </div>
                            </a>
                             <a href="#">
                                <div class="app-box">
                                    <img src="<?php echo base_url('uploads/salary.png');?>" class="img-fluid">
                                    <p>Income</p>
                                </div>
                            </a>
                             <a href="<?php echo base_url('Dashboard/Fund/maintransfer_fund'); ?>">
                                <div class="app-box">
                                    <img src="<?php echo base_url('uploads/salary.png');?>" class="img-fluid">
                                    <p>Main TO Fund</p>
                                </div>
                            </a>
                             <a href="<?php echo base_url('Dashboard/Fund/transfer_fund') ?>">
                                <div class="app-box">
                                    <img src="<?php echo base_url('uploads/salary.png');?>" class="img-fluid">
                                    <p>Fund To Fund</p>
                                </div>
                            </a>
                             
                          

                        </div>    

            </div>
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
               <div class="app-top-head">
                            <div class="app-logo">
                                <img src="<?php echo base_url('uploads/logo.png');?>" class="img-fluid">
                            </div>
                            
                            <div class="app-logout">
                                <a href="#">
                                    <img src="<?php echo base_url('assets/images/app-logout-img.png');?>">
                                </a>
                            </div>
                            <div class="app-logout">
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/notification.png');?>">
                                </a>
                            </div>
                        </div>
                <div class="table-portfolio">
                    <div class="portfolio-head text-center">
                        <h6>Welcome Back!</h6>
                        <p>User Name:</p>
                        <p>User Id:</p>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/tree.png');?>">
                                    Tree
                                </a>
                            </td>
                            <td>
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/tree.png');?>">
                                    Matching Income
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/tree.png');?>">
                                    D.T.P
                                </a>
                            </td>
                            <td>
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/tree.png');?>">
                                    Direct Income
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/tree.png');?>">
                                   Profarmes
                                </a>
                            </td>
                            <td>
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/tree.png');?>">
                                    Income Reward
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/tree.png');?>">
                                   Left Team
                                </a>
                            </td>
                            <td>
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/tree.png');?>">
                                    Right Team
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/tree.png');?>">
                                   Left Direct
                                </a>
                            </td>
                            <td>
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/tree.png');?>">
                                    Right Direct
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/tree.png');?>">
                                   Left ZS
                                </a>
                            </td>
                            <td>
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/tree.png');?>">
                                    Right ZS
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/tree.png');?>">
                                   Left Business
                                </a>
                            </td>
                            <td>
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/tree.png');?>">
                                    Right Business
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/tree.png');?>">
                                   Total Business
                                </a>
                            </td>
                            <td>
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/tree.png');?>">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                           Refer Income
                                        </button>
                                </a>
                            </td>
                        </tr>
                    </table>
                    <div class="refer-box">
                        <!-- Button trigger modal -->
                          

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content bg-light border-0">
                                  <div class="modal-header">
                                    <h5 class="modal-title text-dark" id="exampleModalLongTitle">Refer Income</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                        <div class="Refer-links">
                                            <a href="#">History</a>
                                        </div>
                                        <div class="Refer-links">
                                            <a href="#">Withdraw</a>
                                        </div>
                                  </div>
                                  
                                </div>
                              </div>
                            </div>
                    </div>
                </div>
          </div>
          <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
               <div class="app-top-head">
                            <div class="app-logo">
                                <img src="<?php echo base_url('uploads/logo.png');?>" class="img-fluid">
                            </div>
                            
                            <div class="app-logout">
                                <a href="#">
                                    <img src="<?php echo base_url('assets/images/app-logout-img.png');?>">
                                </a>
                            </div>
                            <div class="app-logout">
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/notification.png');?>">
                                </a>
                            </div>
                        </div>
            B
          </div>
          <div class="tab-pane fade" id="setting" role="tabpanel" aria-labelledby="setting-tab">
               <div class="app-top-head">
                            <div class="app-logo">
                                <img src="<?php echo base_url('uploads/logo.png');?>" class="img-fluid">
                            </div>
                            
                            <div class="app-logout">
                                <a href="#">
                                    <img src="<?php echo base_url('assets/images/app-logout-img.png');?>">
                                </a>
                            </div>
                            <div class="app-logout">
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/notification.png');?>">
                                </a>
                            </div>
                        </div>
                <div class="edit-profile">
                    <div class="edit-profile-img">
                        <img src="<?php echo base_url('uploads/profile.png');?>">
                    </div>
                    <div class="edit-detail">
                        <p>User name </p>
                        <p>User Id </p>
                        <p>Email </p>
                    </div>
                </div>
                <div class="finger-print-bg">
                    <div class="finger-print">
                        <p>Finger Print</p>
                    </div>
                    <div class="finger-print-swich">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
                          <label class="custom-control-label" for="customSwitch1">Toggle this switch element</label>
                        </div>
                    </div>
                </div>
                <div class="profile-setting">
                    <ul>
                        <li>
                            <a href="#">Help & Support</a>
                        </li>
                        <li>
                            <a href="#">Update Epin </a>
                        </li>
                        <li>
                            <a href="#">Update Password </a>
                        </li>
                        <li>
                            <a href="#">Edit Profile </a>
                        </li>
                        <li>
                            <a href="#">Refer & Earn</a>
                        </li>
                    </ul>
                    <div class="logout text-center">
                        <button class="log-out-btn">
                            Logout
                        </button>
                    </div>
                </div>
          </div>
      </div>

</div>
                </div>
                <div class="page-content">
                    <div class="container-fluid">
                       
                       

                        <!-- start page title -->
                        <div class="row align-items-center" style="display: none;">
                            <div class="col-sm-6">
                                <div class="page-title-box">
                                    <h4 class="font-size-18">Dashboard</h4>
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item active">Welcome <?php echo ($userinfo->name) ?> (<?php echo ($userinfo->user_id) ?>)</li>

                                    </ol>
                                    <p class="breadcrumb-item"><?php
                                    //print_r($silver);
                                    // if(empty($silver)){
                                    //     $diff = strtotime('+3 days', strtotime($user['topup_date'])) - strtotime(date('Y-m-d H:i:s'));
                                    //     echo '<p class="timer-bg">Time Left for one left and one right :- <span id="demo" style="color:#fff;font-weight:bold;"></span></p>';
                                    //     echo'<script> countdown("demo",'.$diff.') </script>';
                                    // }

                                    // if(empty($gold)){
                                    //     $diff = strtotime('+30 days', strtotime($user['topup_date'])) - strtotime(date('Y-m-d H:i:s'));
                                    //     echo '<p class="timer-bg">GOLD CLUB Time Left :- <span id="demo1" style="color:#fff;font-weight:bold;"></span></p>';
                                    //     echo'<script> countdown("demo1",'.$diff.') </script>';
                                    // }

                                    ?>

                                    <script>
                                        var countDownDate = new Date("<?php echo date('Y-m-d H:i', strtotime('+168 hour', strtotime($userinfo->topup_date))); ?>").getTime();

                                        // Update the count down every 1 second
                                        var x = setInterval(function () {

                                            // Get today's date and time
                                            var now = new Date().getTime();

                                            // Find the distance between now and the count down date
                                            var distance = countDownDate - now;

                                            // Time calculations for days, hours, minutes and seconds
                                            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                            // Output the result in an element with id="demo"
                                            document.getElementById("timer").innerHTML = days + "d " + hours + "h "
                                                    + minutes + "m " + seconds + "s ";

                                            // If the count down is over, write some text
                                            if (distance < 0) {
                                                clearInterval(x);
                                                document.getElementById("timer").innerHTML = "EXPIRED";
                                            }
                                        }, 1000);
                                    </script></p>
                                </div>
                            </div>

                            <div class="col-sm-6" style="display:none">
                                <div class="float-right d-none d-md-block">
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle waves-effect waves-light"
                                            type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-settings mr-2"></i> Settings
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Separated link</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <!-- <div class="row">
                            <div class="col-xl-12 col-md-12">
                                <h4 class="text-center">Clicke <a href="<?php echo base_url('Dashboard/UpgradeMatrixPackage');?>">Here</a> to Upgrade to Matrix Pool</h4>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(87deg,#5e72e4,#825ee4)!important;">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/01.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">E-Wallet</h5>
                                            <h4 class="font-weight-medium font-size-24">Rs.<?php echo $wallet_balance['wallet_balance'];?> </h4>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(87deg,#11cdef,#1171ef)!important;">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/02.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Current Package</h5>
                                            <h4 class="font-weight-medium font-size-24">Rs.<span class="text-gray"><?php echo $userinfo->package_amount; ?> </h4>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(87deg,#f5365c,#f56036)!important">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/03.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Direct Referral</h5>
                                            <h4 class="font-weight-medium font-size-20">Active : <?php echo $paid_directs['paid_directs']; ?> , InActive : <?php echo $free_directs['free_directs']; ?>
                                                </h4>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6" style="display:none">
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(87deg,#172b4d,#1a174d)!important">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/03.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Business in PV</h5>
                                            <h4 class="font-weight-medium font-size-20">Left PV: <?php echo $userinfo->leftPower; ?>  Right PV: <?php echo $userinfo->rightPower; ?>
                                                </h4>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6" style="display:none">
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(87deg,#172b4d,#1a174d)!important">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/03.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Total Business</h5>
                                            <h4 class="font-weight-medium font-size-20">Left: <?php echo $userinfo->leftPower * 5000; ?>  Right: <?php echo $userinfo->rightPower * 5000; ?>
                                                </h4>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white" style="background:#f0466b !important">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Available Income</h5>
                                            <h4 class="font-weight-medium font-size-24">Rs.<span class="text-gray"><?php echo number_format($income_balance['income_balance'], 2); ?></span></h4>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(316deg, #fc5286, #fbaaa2)">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Total Income</h5>
                                            <h4 class="font-weight-medium font-size-24">Rs.<span class="text-gray"><?php echo round($total_income['total_income'],2); ?></span></h4>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(135deg, #ffc480, #ff763b)">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">100% Bonus</h5>
                                            <h4 class="font-weight-medium font-size-24"> Rs.<span class="text-gray"><?php echo round($direct_income['direct_income'],2); ?></span></h4>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(to bottom, #0e4cfd, #6a8eff)">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Global Matrix Income</h5>
                                            <h4 class="font-weight-medium font-size-24">Rs.<span class="text-gray"><?php //echo round($global_matrix_income['global_matrix_income'],2); ?></span></h4>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(to bottom, #0e4cfd, #6a8eff)">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Smart Matrix Income</h5>
                                            <h4 class="font-weight-medium font-size-24">Rs.<span class="text-gray"><?php //echo round($smart_matrix_income['smart_matrix_income'],2); ?></span></h4>

                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(135deg, #ffc480, #ff763b)">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Silver Matrix Income</h5>
                                            <h4 class="font-weight-medium font-size-24"> Rs.<span class="text-gray"><?php //echo round($silver_matrix_income['silver_matrix_income'],2); ?></span></h4>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(to bottom, #0e4cfd, #6a8eff)">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Gold Matrix Income</h5>
                                            <h4 class="font-weight-medium font-size-24">Rs.<span class="text-gray"><?php echo round($gold_matrix_income['gold_matrix_income'],2); ?></span></h4>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(to bottom, #0e4cfd, #6a8eff)">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Royal Matrix Income</h5>
                                            <h4 class="font-weight-medium font-size-24">Rs.<span class="text-gray"><?php echo round($royal_matrix_income['royal_matrix_income'],2); ?></span></h4>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(to bottom, #0e4cfd, #6a8eff)">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Crown Matrix Income</h5>
                                            <h4 class="font-weight-medium font-size-24">Rs.<span class="text-gray"><?php echo round($crown_matrix_income['crown_matrix_income'],2); ?></span></h4>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Today Income</h5>
                                            <h4 class="font-weight-medium font-size-24">Rs.<span class="text-gray"><?php echo $today_income['today_income']; ?></span> </h4>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Total Withdraw</h5>
                                            <h4 class="font-weight-medium font-size-24">Rs.<span class="text-gray"><?php echo $total_withdrawal['total_withdrawal']; ?></span> </h4>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div> -->

    <!-- <div class="row">
      <div class="col-xl-6">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title mb-4">Share Link</h4>
            <div class="row copyReferal box box-body pull-up bg-hexagons-white">
              <input style="width:100%; margin-bottom: 10px; float:left" type="text" id="linkTxt"
              value="<?php echo base_url('Dashboard/User/Register/?sponser_id='.$userinfo->user_id); ?>"
              class="form-control">
              <button id="btnCopy" iconcls="icon-save" class="btncopy btn-rounded m-b-5 copy-section" style="background:#33db9e;
              margin-top: -3px;
              padding: 10px 0px;
              font-size: 15px;
              color: #fff;
              font-weight: bold;
              border-radius: 10px;
              border: navajowhite;
              float: left;
              width: 37%;
              cursor: pointer;
              margin-left: 5px;
              letter-spacing:2px;
              ">
              Copy link
              </button>
            </div>
          </div>
        </div>
      </div>

    </div> -->
   <!--  <div class="col-md-12">
      <marquee direction="up" scrollamount="2">
       // <?php foreach($news as $n):?>
        //  <p><?php echo $n['news'];?></p>
       // <?php endforeach;?>
      //</marquee>
    <div> -->
   
  </div>
</div>
<?php include_once 'footer.php';  ?>
<script>


$(document).on('click', '#btnCopy', function () {
    //linkTxt
    var copyText = document.getElementById("linkTxt");
    copyText.select();
    copyText.setSelectionRange(0, 99999)
    document.execCommand("copy");
    alert("Copied the text: " + copyText.value);
})
$(document).on('click', '#btnCopy1', function () {
    //linkTxt
    var copyText = document.getElementById("linkTxt1");
    copyText.select();
    copyText.setSelectionRange(0, 99999)
    document.execCommand("copy");
    alert("Copied the text: " + copyText.value);
})
</script>
<?php if($popup['status'] == 0):?>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $popup['caption'];?></h4>
            </div>
            <div class="modal-body">

                <?php
                if(!empty($popup['media'])){
                    if($popup['type'] == 'video')
                        echo '<iframe width="100%" height="400px" src="https://www.youtube.com/embed/'.$popup['media'].'"></iframe>';
                    else
                        echo '<img style="max-width:100%" src="'.base_url('uploads/'.$popup['media']).'">';
                }else{
                    echo '<p>Welcome TO '.base_url().'</p>';
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php endif;?>
<script>
  // $(document).on('click', '#btnCopy', function() {
     // linkTxt
      // var copyText = document.getElementById("linkTxt");
      // copyText.select();
      // copyText.setSelectionRange(0, 99999)
      // document.execCommand("copy");
      // alert("Copied the text: " + copyText.value);
  // })
</script>
<script>
$('#myModal').modal('show');
// $.get('<?php echo base_url('Dashboard/User/get_coin_prices')?>',function(res){
//   console.log(res)
//   // var html = '';
//   // $.each(res.success,function(key,value){
//   //   html += '<li><i class="cc BTC"></i> '+value.currency+' <span class="text-yellow"> $'+value.price+'</span></li>';
//   // })
//     console.log(res);
//   // $('#webticker-1').html(res);
// })
</script>
<script>
    $("#tile-1 .nav-tabs a").click(function() {
  var position = $(this).parent().position();
  var width = $(this).parent().width();
    $("#tile-1 .slider").css({"left":+ position.left,"width":width});
});
var actWidth = $("#tile-1 .nav-tabs").find(".active").parent("li").width();
var actPosition = $("#tile-1 .nav-tabs .active").position();
$("#tile-1 .slider").css({"left":+ actPosition.left,"width": actWidth});

</script>
