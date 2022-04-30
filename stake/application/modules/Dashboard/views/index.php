<?php require_once'header.php';?>
<style>
	
ul.link {
    margin: 0px auto;
    padding: 0px;
	display: inline-flex;
    width: auto;
}

.social .fb {
    background: url(https://mycrowdpay.com/planB/uploads//fb-share.png) no-repeat;
    padding-left: 40px;
    background-size: 35px;
    list-style: none;
    margin: 0px;
    padding: 6px 40px;
    font-size: 15px;
}

.social .tw {
    background: url(https://mycrowdpay.com/planB/uploads//twiiter-share.png) no-repeat;
    padding-left: 40px;
    background-size: 35px;
    list-style: none;
    margin: 0px;
    padding: 6px 40px;
    font-size: 15px;
}

.social .wa {
    background: url(https://mycrowdpay.com/planB/uploads//whtasppa-share.png) no-repeat;
    padding-left: 40px;
    background-size: 35px;
    list-style: none;
    margin: 0px;
    padding: 6px 40px;
    font-size: 15px;
}

.social .pintrest {
    background: url(https://mycrowdpay.com/planB/uploads//linkdin-share.png) no-repeat;
    padding-left: 40px;
    background-size: 35px;
    list-style: none;
    margin: 0px;
    padding: 6px 40px;
    font-size: 15px;
}
.card {
    border: 1px #055aaa52 solid;
}
.social {
    margin: 0px auto;
    display: inline-block;
    width: 100%;
    margin-bottom: 10px;
	text-align: center;
   
}

ul.link li {
    float: left;
    margin: 0px;
    list-style: none;
}

ul.link li img {
    width: 58px;
    margin-right: 10px;
}
.profile-top p {
    font-size: 18px;
    margin: 0px;
    line-height: 39px;
    text-transform: capitalize;
    color: #fff;
    font-weight: bold;
}
.text-blue{
	color: #055aaa
}
</style>
<?php $userinfo = userinfo(); ?>


<script>
function countdown(element, seconds) {
    // Fetch the display element
    var el = document.getElementById(element).innerHTML;

    // Set the timer
    var interval = setInterval(function() {
        if (seconds <= 0) {
            //(el.innerHTML = "level lapsed");
            $('#'+element).text('')

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

    var dDisplay = day > 0 ? day + (day == 1 ? " day, " : "D ") : "";
    var hDisplay = h > 0 ? h + (h == 1 ? " hour, " : "H ") : "";
    var mDisplay = m > 0 ? m + (m == 1 ? " minute, " : "M ") : "";
    var sDisplay = s > 0 ? s + (s == 1 ? " second" : "S ") : "";
    var t = dDisplay + hDisplay + mDisplay + sDisplay;
    return t;
    // console.log(t)
}
</script>

						<!--Page header-->
						<!-- <div class="page-header">
							<div class="col-md-12 page-leftheader">
								<div class="row">
									<div class="col-md-6">
										<h4 class="page-title">Hi, <?php echo $user['name'];?></h4>
									</div>
								
								</div>
							</div>
						</div> -->
						<!--End Page header-->

						<!--Row-->
						<div class="row">

							<div class="col-md-12 col-lg-12">
								<div class="card" style="background: linear-gradient(45deg, #32aa49, #055aaa);">
									<div class="d-block mt-4 card-header border-0 text-left">
										<h2 class="text-left fs-22 text-white">Welcome To <b><?php echo $user['name'];?></b></h2>
									</div>
									<div class="card-body">
										<div class="row text-left">
											<div class="col-md-12">
												<p class="text-white"><b>Joining Data</b> <?php echo $user['created_at'];?></p>
												<p class="text-white"><b>Activation Date</b> <?php echo $user['topup_date'];?></p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
										
										<a href="https://login.zaaracoin.io/Dashboard/Activation" class="btn btn-primary bg-gradient-info mb-3 border-0">Buy Package</a>

										<a href="https://login.zaaracoin.io/Dashboard/DirectIncomeWithdraw" class="btn btn-primary bg-gradient-teal mb-3 border-0">Withdrawal</a>
									</div>
							<div class="col-md-12 col-lg-12">
								<div class="row">
										<div class="col-xl-4 col-lg-4 col-md-12 col-sm-6">
								<div class="card">
									<div class="card-body">
										
										<p class=" mb-1 ">ZCOIN Live Price</p>
										<h2 class="mb-1 font-weight-bold text-blue">$<?php echo $token_value['amount']; ?></h2>
										
										
									</div>
								</div>
							</div>
								<div class="col-xl-4 col-lg-4 col-md-12 col-sm-6">
								<div class="card">
									<div class="card-body">
									
										<p class=" mb-1 ">Staked Coin Wallet</p>
											<h2 class="mb-1 font-weight-bold text-blue" id="BNB-Balance"><?php echo 'ZCOIN '.number_format($coinBalance['amount'],2); ?></h2>

										
									</div>
								</div>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-12 col-sm-6">
								<div class="card">
									<div class="card-body">
										
										<p class=" mb-1 ">Staked Date </p>
										<h2 class="mb-1 font-weight-bold text-blue"  id="BNB-Balance"><?php echo ' '.$coinBalance['created_at']; ?></h2>
										<h6 class="mb-3 tx-18 text-dark">UnStack Date:
											<?php
												// if($stakeAmount['months'] > 0):
													//echo $stakeAmount['maturity_date'];
													$diff = strtotime('+365 days', strtotime($coinBalance['created_at'])) - strtotime(date('Y-m-d H:i:s'));
													echo '<div class="text-danger" id="timer"></div>';
													echo'<script> countdown("timer",'.$diff.') </script>';
												// endif;
											?>
										</h6>

										
										
									</div>
								</div>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-12 col-sm-6">
								<div class="card">
									<div class="card-body">
										
										<p class=" mb-1 ">Total Income</p>
										<h2 class="mb-1 font-weight-bold text-blue"><?php echo '$'.round($total_income['total_income'],2); ?></h2>
									
										
									</div>
								</div>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-12 col-sm-6">
								<div class="card">
									<div class="card-body">
										
										<p class=" mb-1 ">Active Package</p>
										<h2 class="mb-1 font-weight-bold text-blue">$ <?php echo $user['total_package']; ?></h2>
										
										
									</div>
								</div>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-12 col-sm-6">
								<div class="card">
									<div class="card-body">
										
										<p class=" mb-1 ">Total Business</p>
										<h2 class="mb-1 font-weight-bold text-blue">$<?php echo $teamBusiness['teamBusiness']; ?></h2>
										
										
									</div>
								</div>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-12 col-sm-6">
								<div class="card">
									<div class="card-body">
										
										<p class=" mb-1 ">Total Direct Team</p>
										<h2 class="mb-1 font-weight-bold text-blue"><?php echo round($directTeam['directTeam'],3); ?></h2>
										(<span id="paidDirects"></span> | <span id="freeDirects"></span>)
									
										
									</div>
								</div>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-12 col-sm-6">
								<div class="card">
									<div class="card-body">
										
										<p class=" mb-1 ">Total Total Team</p>
										<h2 class="mb-1 font-weight-bold text-blue" id="totalTeam"></h2>
										(<span id="paidTeam"></span> | <span id="freeTeam"></span>)
									
										
									</div>
								</div>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-12 col-sm-6">
								<div class="card">
									<div class="card-body">
										
										<p class=" mb-1 ">Withdrawal</p>
										<h2 class="mb-1 font-weight-bold text-blue">$<?php echo $total_withdrawal['balance']; ?></h2>
										
										
									</div>
								</div>
							</div>


							<div class="col-xl-4 col-lg-4 col-md-12 col-sm-6">
								<div class="card">
									<div class="card-body">
									
										<p class=" mb-1 ">Wallet Balance</p>
										<h2 class="mb-1 font-weight-bold text-blue" id="BNB-Balance">$<?php echo $wallet_balance['wallet_balance']; ?></h2>
									
										
									</div>
								</div>
							</div>
							

						<?php
							$incomes = incomes();
							foreach($incomes as $incKey => $inc):
								$getBalance = $this->User_model->get_single_record('tbl_income_wallet',['user_id' => $this->session->userdata['user_id'],'type' => $incKey],'ifnull(sum(amount),0) as balance');
						?>
						<div class="col-xl-4 col-lg-4 col-md-12 col-sm-6">
								<div class="card">
									<div class="card-body">
										
										<p class=" mb-1 "><?php echo $inc;?></p>
										<h2 class="mb-1 font-weight-bold text-blue" id="BNB-Balance"><?php echo currency.' '.round($getBalance['balance'],2); ?></h2>
									
										
									</div>
								</div>
							</div>
						<?php
							endforeach;
						?>
							





								</div>
								<hr class="dash1-hr">
							
							</div>
							
						</div>
			<div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card card-body box-bg">
                  <div class=""><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <div class="clearfix">
                      <h4 class="card-title w-100 text-dark">My Referral Link</h4>
                     <div class="copyrefferal box box-body pull-up bg-hexagons-white p-0 border-0">
                      <input style="width:100%; margin-bottom: 10px; float:left" type="text" id="linkTxt"
                      value="<?php echo base_url('Dashboard/Register/?sponser_id='.$userinfo->user_id.'&position=L'); ?>"
                      class="form-control">
                      <button id="btnCopy" iconcls="icon-save" onclick="myFunction()" class="btncopy btn-rounded m-b-5 copy-section" style="background:#055aaa;
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
                <div class="card card-body box-bg">
                  <div class=""><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
						<div class="clearfix">
						<h4 class="card-title w-100 text-dark">My Referral Link</h4>
									<div class="copyrefferal box box-body pull-up bg-hexagons-white p-0 border-0">
									<input style="width:100%; margin-bottom: 10px; float:left" type="text" id="linkTxt2"
									value="<?php echo base_url('Dashboard/Register/?sponser_id='.$userinfo->user_id.'&position=R'); ?>"
									class="form-control">
									<button id="btnCopy2" iconcls="icon-save" onclick="myFunction()" class="btncopy btn-rounded m-b-5 copy-section" style="background:#055aaa;
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

						<div class="social">
                                  <ul class="link">

                                      <li>
                                          <a onclick="window.open('https://www.facebook.com/sharer.php?u=<?php echo base_url('/Dashboard/User/Register/?sponser_id=' . $userinfo->user_id) ?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');"
                                              target="_parent" href="javascript: void(0)">
                                              <img src="https://mycrowdpay.com/planB/uploads//fb-share.png">
                                          </a>
                                      </li>
                                      <li>
                                          <a onclick="window.open('https://twitter.com/intent/tweet?url=<?php echo base_url('/Dashboard/User/Register/?sponser_id=' . $userinfo->user_id) ?>;original_referer=<?php echo base_url('/Dashboard/User/Register/?sponser_id=' . $userinfo->user_id) ?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');"
                                              target="_parent" href="javascript: void(0)">
                                              <img src="https://mycrowdpay.com/planB/uploads//twiiter-share.png">
                                          </a>
                                      </li>
                                      <li>
                                          <a
                                              href="https://wa.me/?text=<?php echo base_url('/Dashboard/User/Register/?sponser_id=' . $userinfo->user_id) ?>">
                                              <img src="https://mycrowdpay.com/planB/uploads//whtasppa-share.png">
                                          </a>
                                      </li>
                                      <li>
                                          <a onclick="window.open('https://www.linkedin.com/shareArticle?url=<?php echo base_url('/Dashboard/User/Register/?sponser_id=' . $userinfo->user_id) ?>&amp;source=<?php echo base_url() ?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');"
                                              target="_parent" href="javascript: void(0)">
                                              <img src="https://mycrowdpay.com/planB/uploads//linkdin-share.png">
                                          </a>
                                      </li>
                                  </ul>


                              </div>
						</div>
						</div>
				  			
                </div>
              <div class="col-md-6 grid-margin stretch-card mt-4">
                <div class="card card-body box-bg">
                  <div class="">
                    <div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <h4 class="card-title  text-dark">Latest News</h4>
                       <marquee direction="up" scrollamount="2">
							<?php foreach($news as $n):?>
							<p style="color:#000"><?php echo $n['news'];?></p>
							<?php endforeach;?>
						</marquee>
                  </div>
                </div>
              </div>
              </div>
			</div>

			<div class="col-md-6 grid-margin stretch-card mt-4 d-none">
                <div class="card  box-bg" >
                  	<div class="card-body">
                    	<div class="chartjs-size-monitor">
							<div class="chartjs-size-monitor-expand">
								<div class=""></div>
							</div>
							<div class="chartjs-size-monitor-shrink">
								<div class=""></div>
						</div>
					</div>
					<h4 class="card-title  text-dark">Income Progress(<span class="text-success">Total Limit :<?php echo $user['incomeLimit2'];?></span>)</h4>
					<?php if($user['paid_status'] == 1):?>
						<progress id="file" value="<?php echo $user['incomeLimit'];?>" max="<?php echo $user['incomeLimit2'];?>"></progress><span class="text-success"><?php echo ($user['incomeLimit']/$user['incomeLimit2'])*100;?>%</span>
					<?php else:?>
						<progress id="file" value="0" max="100"> 100% </progress>
					<?php endif;?>
				</div>
				<?php
					for($i=1;$i<=21;$i++){
						if($i == 1){
							$incomeArr[$i] = ['amount' => 0.3,'direct' => 1];
						} elseif($i == 2){
							$incomeArr[$i] = ['amount' => 0.2,'direct' => 2];
						} elseif($i == 3){
							$incomeArr[$i] = ['amount' => 0.1,'direct' => 3];
						} elseif($i == 4){
							$incomeArr[$i] = ['amount' => 0.05,'direct' => 4];
						} elseif($i == 5){
							$incomeArr[$i] = ['amount' => 0.04,'direct' => 5];
						} elseif($i >= 6 && $i <= 10){
							$incomeArr[$i] = ['amount' => 0.01,'direct' => 9];
						} elseif($i >= 11 && $i <= 20){
							$incomeArr[$i] = ['amount' => 0.005,'direct' => 12];
						} elseif($i == 21){
							$incomeArr[$i] = ['amount' => 0.05,'direct' => 15];
						}
					}
				?>
				
			</div>
			
        </div>

						<!--Row-->
						<div class="row row-deck d-none">
							<div class="col-md-12">
								<div class="card overflow-hidden">
									<div class="card-header">
										<h3 class="card-title">Latest Orders</h3>
										
									</div>
									<div class="card-body pt-0">
										<div class="order-table">
											<div class="table-responsive">
												<table id="example1" class="table table-striped table-bordered text-nowrap  mb-0">
													<thead>
														<tr class="bold border-bottom">
															<th class="border-bottom-0">Level</th>
															<th class="border-bottom-0">Directs</th>
															<th class="border-bottom-0">Status</th>
															
														</tr>
													</thead>
													<tbody>
								<?php foreach($incomeArr as $key => $ra):?>
								<tr>
									<td><?php echo $key;?></td>
									<td><?php echo $ra['direct'];?></td>
									<td><?php echo ($user['directs'] >= $ra['direct'])?'<span class="text-success">Achieved</span>':'<span style="color:#ff9900!important;">Pending</span>';?></td>
								</tr>
								<?php endforeach;?>
							</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--End row-->

					</div>
				</div><!-- end app-content-->
			</div>




<!-- <h1>heloo</h1> -->
<?php if($popup['status'] == 0):?>
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $popup['caption'];?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="<?php echo base_url('uploads/'.$popup['media']);?>" class="img-fluid">
      </div>
    </div>
  </div>
</div>
<?php endif;?>
<?php require_once'footer.php';?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<script >
$(document).ready(function(){
    $('#myModal').modal('show');
});

$(document).on('click', '#btnCopy', function () {
var copyText = document.getElementById("linkTxt");
copyText.select();
copyText.setSelectionRange(0, 99999)
document.execCommand("copy");
alert("Copied the text: " + copyText.value);
})


$(document).on('click', '#btnCopy2', function () {
var copyText = document.getElementById("linkTxt2");
copyText.select();
copyText.setSelectionRange(0, 99999)
document.execCommand("copy");
alert("Copied the text: " + copyText.value);
})

function myFunction() {
var copyText = document.getElementById("myInput");
copyText.select();
copyText.setSelectionRange(0, 99999)
document.execCommand("copy");
alert("Copied the text: " + copyText.value);
}
// function refreshBalance () {
// $.get('<?php //echo base_url('Dashboard/Binance/binance_balance_fetch')?>',function(res){
// $('#bbalance').text(res);
// },'json')
// }
</script>
<script>
//   var url1 = "<?php //echo base_url('Dashboard/Activation/stackCoin');?>";
//   stackFrom.onsubmit = async (e) => {
//     e.preventDefault();
//     let response = await fetch(url1, {
//       method: 'POST',
//       body: new FormData(stackFrom)
//     });
//     let result = await response.json();
//     updateToken(result.token);
//     if(result.status == 1){
//       alert(result.message);
//       location.reload();
//     }else{
//       alert(result.message);
//     }
//   };
//   var url2 = "<?php //echo base_url('Dashboard/Activation/purchaseMurphy');?>";
//   purchaseFrom.onsubmit = async (e) => {
//     e.preventDefault();
//     let response = await fetch(url2, {
//       method: 'POST',
//       body: new FormData(purchaseFrom)
//     });
//     let result = await response.json();
// 	updateToken(result.token);
//     if(result.status == 1){
//       alert(result.message);
//       location.reload();
//     }else{
//       alert(result.message);
//     }
//   };

//   var url3 = "<?php //echo base_url('Dashboard/Activation/stackKSN');?>";
//   ksnForm.onsubmit = async (e) => {
//     e.preventDefault();
//     let response = await fetch(url3, {
//       method: 'POST',
//       body: new FormData(ksnForm)
//     });
//     let result = await response.json();
// 	updateToken(result.token);
//     if(result.status == 1){
//       alert(result.message);
//       location.reload();
//     }else{
//       alert(result.message);
//     }
//   };

//   var url3 = "<?php //echo base_url('Dashboard/Activation/buyCoin');?>";
//   buyCoinForm.onsubmit = async (e) => {
//     e.preventDefault();
//     let response = await fetch(url3, {
//       method: 'POST',
//       body: new FormData(buyCoinForm)
//     });
//     let result = await response.json();
// 	updateToken(result.token);
//     if(result.status == 1){
//       alert(result.message);
//       location.reload();
//     }else{
//       alert(result.message);
//     }
//   };

//   var url4 = "<?php //echo base_url('Dashboard/Activation/sellCoin');?>";
//   sellCoinForm.onsubmit = async (e) => {
//     e.preventDefault();
//     let response = await fetch(url4, {
//       method: 'POST',
//       body: new FormData(sellCoinForm)
//     });
//     let result = await response.json();
// 	updateToken(result.token);
//     if(result.status == 1){
//       alert(result.message);
//       location.reload();
//     }else{
//       alert(result.message);
//     }
//   };

  function updateToken(token){
	var els=document.getElementsByClassName("tokenall");
	for (var i=0;i<els.length;i++) {
		els[i].value = token;
	}
  }

  function getBalance(){
	getMHY2();
	var url21 = "<?php echo base_url('Dashboard/Activation/getBalance');?>";
	fetch(url21,{
		method:"GET"
	})
	.then(response => response.json())
	.then(response => {
		document.getElementById('coinBalance').innerHTML = '<span class="text-success">Wallet Balance: '+response.coinBalance+'</span>';
		document.getElementById('walletBalance').innerHTML = '<span class="text-success">Wallet Balance: '+response.walletBalance+'</span>';
		//document.getElementById('walletBalance2').innerHTML = '<span class="text-success">Wallet Balance: '+response.walletBalance+'</span>';
		//document.getElementById('walletBalance3').innerHTML = '<span class="text-success">KSN Balance: '+response.coinBalance+'</span>';
	})
  }

//   function getMHY(){
// 	var url = "<?php //echo base_url('Dashboard/Activation/getMHY');?>";
// 	fetch(url,{
// 		method:"GET"
// 	})
// 	.then(response => response.json())
// 	.then(response => {
// 		var amount = document.getElementById('amount').value;
// 		document.getElementById('murphyCoin').innerHTML = 'Approx: KSN: '+amount/(response.tokenValue);
// 		document.getElementById('buyCoinAmount').value = 'Approx: KSN: '+amount/(response.tokenValue);
// 	})
//   }

  function getMHY2(){
	var url = "<?php echo base_url('Dashboard/Activation/getMHY');?>";
	fetch(url,{
		method:"GET"
	})
	.then(response => response.json())
	.then(response => {
		//var amount = document.getElementById('buyCoinAmount1').value;
		//var amount2 = document.getElementById('sellCoinAmount1').value;
		//document.getElementById('buyCoinAmount2').value = amount/(response.tokenValue);
		document.getElementById('tokenValue').innerHTML = 'Current Token Value: '+response.tokenValue+'<br> You will get 50% extra coin';
	})
  }

  function calculateCoin(){
	var month = document.getElementById('months').value;
	var amount = document.getElementById('stackAmount').value;
	var finalAmount = 0;
	var extraCoin = 0;
	if(month == 18){
		extraCoin = parseInt(amount*0.2);
		finalAmount = parseInt(amount) + parseInt(amount*0.2);
	} else if(month == 24) {
		extraCoin = parseInt(amount*0.36);
		finalAmount = parseInt(amount) + parseInt(amount*0.36);
	} else if(month == 36) {
		extraCoin = parseInt(amount*0.48);
		finalAmount = parseInt(amount) + parseInt(amount*0.48);
	} else if(month == 48) {
		extraCoin = parseInt(amount*0.6);
		finalAmount = parseInt(amount)+ parseInt(amount*0.6);
	}
	document.getElementById('extraStack').innerHTML = 'Extra Coin: '+extraCoin;
	document.getElementById('totalStack').innerHTML = 'Total Coin: '+parseInt(finalAmount);
  }


  window.onload =function getTeam(){
	var url = "<?php echo base_url('Dashboard/AjaxController/jsonData');?>";
	fetch(url,{
		method:"GET"
	})
	.then(response => response.json())
	.then(response => {
		document.getElementById('paidTeam').innerHTML = 'Active : '+response.paidTeam.team;
		document.getElementById('freeTeam').innerHTML = 'InActive : '+response.freeTeam.team;
		document.getElementById('totalTeam').innerHTML = parseInt(response.freeTeam.team)+parseInt(response.paidTeam.team);
		document.getElementById('paidDirects').innerHTML = 'Active : '+response.paidDirects.paidDirects;
		document.getElementById('freeDirects').innerHTML = 'InActive : '+response.freeDirects.freeDirects;
		//kycData();
	})
  }

  function kycData(){
	var url = "<?php echo base_url('Dashboard/AjaxController/dashboardData');?>";
	fetch(url,{
		method:"GET"
	})
	.then(response => response.json())
	.then(response => {
		console.log(response.inactive);
		//console.log(response.freeTeam.team);
		//console.log(response.paidDirects.paidDirects);
		document.getElementById('activeKyc').innerHTML = response.active;
		document.getElementById('inactiveKyc').innerHTML = response.inactive;
	})
  }



  function copyToClipboard() {
    var inputc = document.body.appendChild(document.createElement("input"));
    inputc.value = "<?php echo base_url('Dashboard/User/Register/?sponser_id='.$userinfo->user_id); ?>";//window.location.href;
    inputc.focus();
    inputc.select();
    document.execCommand('copy');
    inputc.parentNode.removeChild(inputc);
    toastr.success("Reffer Link Copied.", {timeOut: 5000})

}


</script>




    <!----------------------->
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php //echo base_url('NewDashboard/') ?>assets/binance/web3.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/web3modal@1.9.0/dist/index.js"></script>
    <script type="text/javascript" src="https://unpkg.com/evm-chains@0.2.0/dist/umd/index.min.js"></script>
    <script src="<?php //echo base_url('NewDashboard/') ?>assets/binance/bn.js"></script>
	<script src="//cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>

    <script src="<?php //echo base_url('NewDashboard/') ?>assets/binance/stacking.js"></script> -->
    <!----------------------->

