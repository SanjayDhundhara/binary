<?php
include_once'header.php';
$userinfo = userinfo();
// pr($userinfo,true);
date_default_timezone_set('asia/kolkata')
?>
<style>
.card.mini-stat.bg-primary.text-white {
    text-align: center;
}
.news {
    height: 223px;
}
.text-white-50 {
    color: #fff !important;
}
.card {
    text-align: center;
    background:linear-gradient(262deg, #41e396, #3bb4b6);
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
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid p-0">

                        <!-- start page title -->
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <div class="page-title-box">
                                    <h4 class="font-size-22" style="color:#000">Dashboard</h4>
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item active" style="color:#000">Welcome <?php echo ($userinfo->name) ?> (<?php echo ($userinfo->user_id) ?>)</li>
                                        <li class="breadcrumb-item" style="color:#000">Joining Date <?php echo ($userinfo->created_at) ?> (Activated on: <?php echo ($userinfo->topup_date) ?>)</li>

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

                        <div class="row">

                            <div class="col-xl-3 col-md-4">
                                <div class="card mini-stat text-white" >
                                    <div class="">
                                        <div class="">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/01.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">E-Wallet</h5>
                                            <h4 class="font-weight-medium font-size-24">Rs. <?php echo $wallet_balance['wallet_balance'];?> </h4>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4">
                                <div class="card mini-stat text-white" >
                                    <div class="">
                                        <div class="">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/02.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Current Package</h5>
                                            <h4 class="font-weight-medium font-size-24">Rs. <span class="text-gray"><?php echo $userinfo->package_amount; ?> </h4>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4" style="display:none">
                                <div class="card mini-stat text-white" >
                                    <div class="">
                                        <div class="">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/02.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Current Level</h5>
                                            <h4 class="font-weight-medium font-size-24"><span class="text-gray"><?php

                                            echo $userinfo->matrix_package_id > 0 ? $matrix_packages[$userinfo->matrix_package_id - 1]['title'] : 'No Level';
                                            ?> </h4>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4">
                                <div class="card mini-stat text-white" >
                                    <div class="">
                                        <div class="">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/03.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Direct Referral</h5>
                                            <h4 class="font-weight-medium font-size-20">Active : <?php echo $paid_directs['paid_directs']; ?> , InActive : <?php echo $free_directs['free_directs']; ?>
                                                </h4>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-4" style="display:none">
                                <div class="card mini-stat text-white" >
                                    <div class="">
                                        <div class="">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/03.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Business in PV</h5>
                                            <h4 class="font-weight-medium font-size-20">Left PV: <?php echo $userinfo->leftPower; ?>  Right PV: <?php echo $userinfo->rightPower; ?>
                                                </h4>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-4" style="display:none">
                                <div class="card mini-stat text-white" >
                                    <div class="">
                                        <div class="">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/03.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Total Business</h5>
                                            <h4 class="font-weight-medium font-size-20">Left: <?php echo $userinfo->leftPower * 5000; ?>  Right: <?php echo $userinfo->rightPower * 5000; ?>
                                                </h4>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4" style="display:none">
                                <div class="card mini-stat text-white" >
                                    <div class="">
                                        <div class="">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Level Income</h5>
                                            <h4 class="font-weight-medium font-size-24">Rs. <span class="text-gray"><?php echo number_format($level_income['level_income'], 2); ?></span></h4>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-4">
                                <div class="card mini-stat text-white" >
                                    <div class="">
                                        <div class="">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Direct Income</h5>
                                            <h4 class="font-weight-medium font-size-24">Rs. <span class="text-gray"><?php echo number_format($direct_income['direct_income'], 2); ?></span></h4>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-4">
                                <div class="card mini-stat text-white" >
                                    <div class="">
                                        <div class="">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Self Income</h5>
                                            <h4 class="font-weight-medium font-size-24">Rs. <span class="text-gray"><?php echo number_format($self_income['self_income'], 2); ?></span></h4>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-4">
                                <div class="card mini-stat text-white" >
                                    <div class="">
                                        <div class="">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Direct Boost Income</h5>
                                            <h4 class="font-weight-medium font-size-24">Rs. <span class="text-gray"><?php echo number_format($direct_boost_income['direct_boost_income'], 2); ?></span></h4>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-4">
                                <div class="card mini-stat text-white" >
                                    <div class="">
                                        <div class="">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Booster Level Income</h5>
                                            <h4 class="font-weight-medium font-size-24">Rs. <span class="text-gray"><?php echo number_format($booster_level_income['booster_level_income'], 2); ?></span></h4>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-4">
                                <div class="card mini-stat text-white" >
                                    <div class="">
                                        <div class="">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Available Income</h5>
                                            <h4 class="font-weight-medium font-size-24">Rs. <span class="text-gray"><?php echo number_format($income_balance['income_balance'], 2); ?></span></h4>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-4">
                                <div class="card mini-stat text-white" >
                                    <div class="">
                                        <div class="">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Total Income</h5>
                                            <h4 class="font-weight-medium font-size-24">Rs. <span class="text-gray"><?php echo round($total_income['total_income'],2); ?></span></h4>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            

                            
                            

                            




















                            <div class="col-xl-3 col-md-4">
                                <div class="card mini-stat text-white">
                                    <div class="">
                                        <div class="">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Today Income</h5>
                                            <h4 class="font-weight-medium font-size-24">Rs. <span class="text-gray"><?php echo $today_income['today_income']; ?></span> </h4>

                                        </div>

                                    </div>
                                </div>
                            </div>



                            <div class="col-xl-3 col-md-4">
                                <div class="card mini-stat text-white">
                                    <div class="">
                                        <div class="">
                                            <div class="float-left d-none mini-stat-img mr-4">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Total Withdraw</h5>
                                            <h4 class="font-weight-medium font-size-24">Rs. <span class="text-gray"><?php echo abs($total_withdrawal['total_withdrawal']); ?></span> </h4>

                                        </div>

                                    </div>
                                </div>
                            </div>





                        </div>

    <div class="row">
      <div class="col-xl-6">
        <div class="">
          <div class="page-title-box">
            <h4 class="card-title mb-4" style="color:#000">Share Link</h4>
            <div class="row copyrefferal box box-body pull-up bg-hexagons-white">
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
	  <div class="col-xl-6">
        <div class="">
          <div class="page-title-box">
            <h4 class="card-title mb-4" style="color:#000">Company News</h4>
			 <marquee direction="up" scrollamount="2">
        <?php foreach($news as $n):?>
          <p style="color:#000"><?php echo $n['news'];?></p>
        <?php endforeach;?>
      </marquee>
          </div>
        </div>
      </div>

    </div>
    <div class="col-md-12 col-lg-6 table-box d-none" style="display:none">
                                <div class="panel panel-default">
                                    <div class="panel-heading font-bold" style="padding: 10px; font-size:20px; margin-top: 20px;background:linear-gradient(to top right, #3358cb, #1197e6); color: #fff; font-weight: bold;">
                                        Club 
                                    </div>
                                    <div class="panel-body" style="padding: 5px">


                                        <div class="refLink">
                                          
                                        </div>
                                        <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-advance table-hover">
                                            <tbody>
                                                <tr onmouseover="this.bgColor='lightblue'" onmouseout="this.bgColor=' #f9f9f9'" bgcolor=" #f9f9f9">
                                                    <td width="15%" style="height: 10px; padding: 2px 5px 2px 10px;">
                                                        <strong>Club 1</strong>
                                                    </td>
                                                    <td style="height: 10px; padding: 2px 5px 2px 10px;">
                                                        <strong>Level 1</strong>
                                                    </td>
                                                    <td width="35%" style="height: 10px; padding: 2px 5px 2px 10px;">
                                                        <span id="ctl00_ContentPlaceHolder1_lbl_userid"><?php 
                                                        if(!empty($club1['user_id'])){
                                                            echo '<a href= "#" class = "btn btn-success">Active </a>';
                                                        }else{
                                                             echo '<a href= "#" class = "btn btn-danger">Inactive </a>';
                                                         
                                                        } ?></span>
                                                    </td>
                                                    <td width="15%" style="height: 10px; padding: 2px 5px 2px 10px;">
                                                        <strong>Club 2</strong>
                                                    </td>
                                                    <td style="height: 10px; padding: 2px 5px 2px 10px;">
                                                        <strong>Level 2</strong>
                                                    </td>
                                                    <td width="35%" style="height: 10px; padding: 2px 5px 2px 10px;">
                                                        <span id="ctl00_ContentPlaceHolder1_lbl_usrename"><?php 
                                                        if(!empty($club2['user_id'])){
                                                            echo '<a href= "#" class = "btn btn-success">Active </a>';
                                                        }else{
                                                             echo '<a href= "#" class = "btn btn-danger">Inactive </a>';
                                                         
                                                        } ?> </span>
                                                    </td>
                                                </tr>
                                                <tr onmouseover="this.bgColor='lightblue'" onmouseout="this.bgColor=' #f9f9f9'" bgcolor=" #f9f9f9">
                                                    <td style="height: 10px; padding: 2px 5px 2px 10px;">
                                                        <strong>Club 3</strong>
                                                    </td>
                                                    <td style="height: 10px; padding: 2px 5px 2px 10px;">
                                                        <strong>Level 3</strong>
                                                    </td>
                                                    <td style="height: 10px; padding: 2px 5px 2px 10px;">
                                                        <span id="ctl00_ContentPlaceHolder1_lbl_doj"> <?php 
                                                        if(!empty($club3['user_id'])){
                                                            echo '<a href= "#" class = "btn btn-success">Active </a>';
                                                        }else{
                                                             echo '<a href= "#" class = "btn btn-danger">Inactive </a>';
                                                         
                                                        } ?></span>
                                                    </td>
                                                    <td style="height: 10px; padding: 2px 5px 2px 10px;">
                                                        <strong>Club 4 </strong>
                                                    </td>
                                                    <td style="height: 10px; padding: 2px 5px 2px 10px;">
                                                        <strong>Level 4</strong>
                                                    </td>
                                                    <td style="height: 10px; padding: 2px 5px 2px 10px;">
                                                        <span id="ctl00_ContentPlaceHolder1_lbl_designation"><?php 
                                                        if(!empty($club4['user_id'])){
                                                            echo '<a href= "#" class = "btn btn-success">Active </a>';
                                                        }else{
                                                             echo '<a href= "#" class = "btn btn-danger">Inactive </a>';
                                                         
                                                        } ?></span>
                                                    </td>
                                                </tr>
                                               
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                     </div>
                                </div>
                
                            </div>


    <div class="col-md-12" style="display:none">

    <div>
    <?php
    $get = $this->User_model->get_single_record('tbl_pool', array('user_id' => $this->session->userdata['user_id']), '*');
                //pr($get);

      $rewardarr = [
        '1' => ['club' => '1','table' => 'tbl_pool'],
        '2' => ['club' => '2','table' => 'tbl_pool2'],
        '3' => ['club' => '3','table' => 'tbl_pool3'],
         '4' => ['club' => '4','table' => 'tbl_pool4'],
        // '5' => ['package' => '12500','team' => '32','turnover' => '400000', 'upgrade' => '25000', 'income' => '375000', 'sponser_income' => '75000', 'level_achived' => '512'],
        // '6' => ['package' => '25000','team' => '64','turnover' => '1600000', 'upgrade' => '50000', 'income' => '1550000', 'sponser_income' => '310000', 'level_achived' => '2048'],
        // '7' => ['package' => '50000','team' => '128','turnover' => '6400000', 'upgrade' => '', 'income' => '6400000', 'sponser_income' => '1280000', 'level_achived' => '4096'],

      ];
    ?>
    <div class="row">
        <h5 class="text-center page-title-box w-100" style="display:Block">Club</h5>
      <div class="table-responsive" style="display:Block;">
        <table class="table table-bordered">
          <thead style="background:linear-gradient(180deg,#11cdef,#1171ef)!important; color: #fff;">
            <tr>
              <th>Pool</th>
              <th>Level</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach($rewardarr as $key => $r):
                $record = $this->User_model->get_single_record($r['table'],['user_id' => $this->session->userdata['user_id'],'org' =>1],'*');

            ?>
            <tr>
              <td><?php echo "CLUB".($key);?></td>
              <td><?php echo ($key);?></td>

              <td><?php if($record['org'] == 1){ ?>
                <sapn class ="badge badge-success">Active<span>
            <?php  }else{ ?>
                <sapn class ="badge badge-danger">Inactive<span>
           <?php  } ?></td> 
               
                <?php
                // if($userinfo->directs >= 2 && $key == 1){
                //      echo '<font color="green">Achieved</font>';
                // }elseif($key > 1){

                //     if(!empty($get['level3'] >= $r['level_achived'])){ echo '<font color="green">Achieved</font>';}else{echo '<font color="red">Pending</font>';
                //     }
                // }else{
                //     echo '<font color="red">Pending</font>';
                // }
                ?>
             
            </tr>
            <?php endforeach;?>
          </tbody>
        </table>

            <?php
                // foreach($matrix_packages as $key => $pack){
                ?>
                <!-- <h2 class="text-center text-danger"><?php echo $pack['title'];?> Pool (Activated)
                 </h2>
                    <table class="table table-bordered">
                        <thead style="background:linear-gradient(180deg,#11cdef,#1171ef)!important; color: #fff;">
                            <tr>
                            <th>#</th>
                            <th>Package</th>
                            <th>Current Team</th>
                            <th>Team</th>
                            <th>Income</th>
                            <th>Upline Income 10%</th>
                            <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><?php echo $pack['price']?></td>
                                <td><?php echo !empty($pack['pool1']) ? $pack['pool1']['level1'] : 0?></td>
                                <td>3</td>
                                <td><?php echo $pack['price']?></td>
                                <td>0</td>
                                <td>
                                <?php echo !empty($pack['pool1']) && $pack['pool1']['level1'] >= 3 ? '<span class="text-success">Achieved</span>' : '<span class="text-danger">Not Achieved</span>'?>
                                </td>
                            <tr>
                            <tr>
                                <td>2</td>
                                <td><?php echo $pack['price'] * 2?> (Upgrade) </td>
                                <td><?php echo !empty($pack['pool2']) ? $pack['pool2']['level1'] : 0?></td>
                                <td>4</td>
                                <td><?php echo ($pack['price'] * 8)*90/100?></td>
                                <td><?php echo ($pack['price'] * 8)*10/100?></td>
                                <td>
                                <?php echo !empty($pack['pool2']) && $pack['pool2']['level1'] >= 4 ? '<span class="text-success">Achieved</span>' : '<span class="text-danger">Not Achieved</span>'?>
                                </td>
                            <tr>
                        </tbody>
                    </table> -->
                    <?php
                // }
                    ?>

      </div>
    </div>
  </div>
</div>
<?php include_once 'footer1.php';  ?>
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
