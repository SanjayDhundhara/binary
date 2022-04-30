
<?php require_once'header.php';?>

<?php $userinfo = userinfo(); ?>


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

      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2" style="background: linear-gradient(45deg, #f93a5a, #f7778c)!important">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
              </h3>
           <!--    <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav> -->
            </div>
            <!-- start page title -->
                        <div class="row align-items-center">
                            <div class="col-sm-12">
                                <div class="page-title-box card card-body mb-4 box-bg" style="background: linear-gradient(270deg, #0db2de 0, #005bea)!important">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item active" style="color:#fff">Welcome <?php echo ($userinfo->name) ?> (<?php echo ($userinfo->user_id) ?>)</li>
                                        <li class="breadcrumb-item" style="color:#fff">Joining Date <?php echo ($userinfo->created_at) ?> (Activated on: <?php echo ($userinfo->topup_date) ?>)</li>

                                    </ol>
                                    <p class="breadcrumb-item d-none"><?php
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
            <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white box-bg" style="background: linear-gradient(270deg, #0db2de 0, #005bea)!important">
                  <div class="card-body">
                    <img src="<?php echo base_url('');?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Byeol Hub <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2><?php echo $userinfo->hub_price;?> <?php echo currency; ?></h2>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white box-bg" style="background: linear-gradient(45deg, #f93a5a, #f7778c)!important">
                  <div class="card-body">
                    <img src="<?php echo base_url('');?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Current Package <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2> <span ><?php echo $userinfo->package_amount; ?> <?php echo currency; ?></h2>
                  </div>
                </div>
              </div>

              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white box-bg" style="background: linear-gradient(270deg, #48d6a8 0, #029666)!important">
                  <div class="card-body">
                    <img src="<?php echo base_url('');?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Direct Referral <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2>Active : <?php echo $paid_directs['paid_directs']; ?> , InActive : <?php echo $free_directs['free_directs']; ?></h2>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin d-none">
                <div class="card bg-gradient-success card-img-holder text-white box-bg">
                  <div class="card-body">
                    <img src="<?php echo base_url('');?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">L | R Business <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2><?php echo 'L: '.$user['leftBusiness']; ?> | <?php echo 'R: '.$user['rightBusiness']; ?></h2>
                  </div>
                </div>
              </div>

              <div class="col-md-4 stretch-card grid-margin">
                <div class="card card-img-holder text-white box-bg" style="background:linear-gradient(270deg, #efa65f, #f76a2d)!important">
                  <div class="card-body">
                    <img src="<?php echo base_url('');?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Direct Profit<i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2> <span ><?php echo number_format($direct_income['direct_income'], 2); ?> <?php echo currency; ?></span></h2>
                  </div>
                </div>
              </div>

              <div class="col-md-4 stretch-card grid-margin">
                <div class="card card-img-holder text-white box-bg" style="background:linear-gradient(87deg,#f5365c,#f56036) !important">
                  <div class="card-body">
                    <img src="<?php echo base_url('');?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Daily Trade Profit<i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2> <span ><?php echo number_format($self_income['self_income'], 2); ?></span> <?php echo currency; ?></h2>
                  </div>
                </div>
              </div>

              <div class="col-md-4 stretch-card grid-margin d-none">
                <div class="card card-img-holder text-white box-bg" style="background:linear-gradient(87deg,#172b4d,#1a174d)">
                  <div class="card-body">
                    <img src="<?php echo base_url('');?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Matching Profit <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2> <span ><?php echo number_format($matching_bonus['matching_bonus'], 2); ?></span> <?php echo currency; ?></h2>
                  </div>
                </div>
              </div>

              <div class="col-md-4 stretch-card grid-margin d-none">
                <div class="card card-img-holder text-white box-bg" style="background:linear-gradient(316deg, #fc5286, #fbaaa2)">
                  <div class="card-body">
                    <img src="<?php echo base_url('');?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Performance Profit <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2> <span ><?php echo number_format($royalty_income['royalty_income'], 2); ?></span> <?php echo currency; ?></h2>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin d-none">
                <div class="card card-img-holder text-white box-bg" style="background:linear-gradient(316deg, #fc5286, #fbaaa2)">
                  <div class="card-body">
                    <img src="<?php echo base_url('');?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Reward Income <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2> <span ><?php echo number_format($reward_income['reward_income'], 2); ?></span> <?php echo currency; ?></h2>
                  </div>
                </div>
              </div>

              <div class="col-md-4 stretch-card grid-margin">
                <div class="card card-img-holder text-white box-bg" style="background:linear-gradient(135deg, #ffc480, #ff763b) !important">
                  <div class="card-body">
                    <img src="<?php echo base_url('');?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Available Profit <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2> <span ><?php echo number_format($income_balance['income_balance'], 2); ?> <?php echo currency; ?></span></h2>
                  </div>
                </div>
              </div>

              <div class="col-md-4 stretch-card grid-margin">
                <div class="card card-img-holder text-white box-bg" style="background:linear-gradient(to bottom, #0e4cfd, #6a8eff) !important">
                  <div class="card-body">
                    <img src="<?php echo base_url('');?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total Profit <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2> <span ><?php echo round($total_income['total_income'],2); ?></span> <?php echo currency; ?></h2>
                  </div>
                </div>
              </div>

              <div class="col-md-4 stretch-card grid-margin">
                <div class="card card-img-holder text-white box-bg" style="background:linear-gradient(0deg,#0098f0,#00f2c3) !important">
                  <div class="card-body">
                    <img src="<?php echo base_url('');?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Today Profit <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2> <span ><?php echo round($today_income['today_income'],2); ?></span> <?php echo currency; ?></h2>
                  </div>
                </div>
              </div>

              <div class="col-md-4 stretch-card grid-margin">
                <div class="card card-img-holder text-white box-bg" style="background:#33db9e !important">
                  <div class="card-body">
                    <img src="<?php echo base_url('');?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total Withdraw <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2> <span ><?php echo abs($total_withdrawal['total_withdrawal']); ?></span> <?php echo currency; ?></h2>
                  </div>
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card  box-bg" style="background: linear-gradient(270deg, #0db2de 0, #005bea)!important">
                  <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <div class="clearfix">
                      <h4 class="card-title w-100">Share Links</h4>
                     <div class="copyrefferal box box-body pull-up bg-hexagons-white">
                      <input style="width:100%; margin-bottom: 10px; float:left" type="text" id="linkTxt"
                      value="<?php echo base_url('Dashboard/User/Register/?sponser_id='.$userinfo->user_id); ?>"
                      class="form-control">
                      <button id="btnCopy" iconcls="icon-save" class="btncopy btn-rounded m-b-5 copy-section" style="background:#23beb9;
                      margin-top: -3px;
                      padding: 10px 0px;
                      font-size: 15px;
                      color: #fff;
                      font-weight: bold;
                      border-radius: 4px;
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
              </div>
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card  box-bg" style="background: linear-gradient(270deg, #0db2de 0, #005bea)!important">
                  <div class="card-body">
                    <div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <h4 class="card-title">Latest News</h4>
                       <marquee direction="up" scrollamount="2">
        <?php foreach($news as $n):?>
          <p style="color:#fff"><?php echo $n['news'];?></p>
        <?php endforeach;?>
      </marquee>

                  </div>
                </div>
              </div>
            </div>

            <div class="row" style="display: none;">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Recent Tickets</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> Assignee </th>
                            <th> Subject </th>
                            <th> Status </th>
                            <th> Last Update </th>
                            <th> Tracking ID </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                             David Grey
                            </td>
                            <td> Fund is not recieved </td>
                            <td>
                              <label class="badge badge-gradient-success">DONE</label>
                            </td>
                            <td> Dec 5, 2021 </td>
                            <td> WD-12345 </td>
                          </tr>
                          <tr>
                            <td>
                               Stella Johnson
                            </td>
                            <td> High loading time </td>
                            <td>
                              <label class="badge badge-gradient-warning">PROGRESS</label>
                            </td>
                            <td> Dec 12, 2021 </td>
                            <td> WD-12346 </td>
                          </tr>
                          <tr>
                            <td>
                               Marina Michel
                            </td>
                            <td> Website down for one week </td>
                            <td>
                              <label class="badge badge-gradient-info">ON HOLD</label>
                            </td>
                            <td> Dec 16, 2021 </td>
                            <td> WD-12347 </td>
                          </tr>
                          <tr>
                            <td>
                               John Doe
                            </td>
                            <td> Loosing control on server </td>
                            <td>
                              <label class="badge badge-gradient-danger">REJECTED</label>
                            </td>
                            <td> Dec 3, 2021 </td>
                            <td> WD-12348 </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>


          </div>
          <!-- content-wrapper ends -->
          <?php require_once'footer.php';?>

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
