
<?php require_once'header.php';?>
<style>
	.left-content.top-bg {
	    padding: 10px;
	    background: #000000;
	    display: block;
	    width: 100%;
	    border-radius: 5px;
	}
	.top-banner {
	    margin-top: 20px;
	    border-radius: 10px;
	    overflow: hidden;
	}
	img.img-fluid.box-icon {
	    position: absolute;
	    right: 13px;
    	top: 20px;
	}
	.card img {
    max-width: 63px;
    margin-top: 10px;
}
.box-active{
	 background:linear-gradient(to right bottom, #161616, #ff9800) !important;
}
.h-130 {
    height: 120px;
    display: flex;
    background:linear-gradient(to right bottom, #fd9b07, #000000) !important;
    justify-content: center;
   color: #fff;
}
.h-130:hover {
   background:linear-gradient(to right bottom, #161616, #ff9800) !important;
}
button.btn.btn-primary.token-btn {
    border-radius: 4px;
    background: #ad6a08;
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

@media (max-width: 767px){
	
.app.sidebar-gone.sidenav-toggled .app-sidebar {
    left: 0;
    top: 62px !important;
}
}

</style>


            <div class="container-fluid">
			<script type="text/javascript" src="https://files.coinmarketcap.com/static/widget/coinMarquee.js"></script>
			<div class="card card-body" style="background: #ff9900 !important;">
				<div id="coinmarketcap-widget-marquee" coins="1,1027,825,74,1839,52,2010,1321,6636" currency="USD" theme="light" transparent="false" show-symbol-logo="true"></div>
			</div>

					<!-- breadcrumb -->
					<!-- <div class="breadcrumb-header justify-content-between">
						<div class="left-content top-bg">
							<div>

							<h2 class="main-content-title tx-18 mg-b-1 mg-b-lg-1 text-white"> Activated on: <?php echo ($userinfo->topup_date) ?></h2>
							</div>
						</div>

					</div> -->
					<!-- breadcrumb -->
					<div class="card card-body" style="background: #ff9900 !important;">
						<div class="profile-top">
							<p>Welcome To <span class="text-dark"><?php echo $user['name'];?></span></p>
							<p>Joining data - <span class="text-dark"><?php echo $user['created_at'];?></span></p>
							<p>Activation date - <span class="text-dark"><?php echo $user['topup_date'];?></span> </p>
						</div>
					</div>

					<!-- row -->
					<div class="row row-sm">
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="card overflow-hidden sales-card  h-130 box-active" >
								<div class="">
									<div class="">
										<h4 class=" text-white"></spans>$<?php echo $token_value['amount']; ?></h4>
										<img src="<?php echo base_url('uploads/box-inner-icon.png');?>" class="img-fluid box-icon">
									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<h6 class="mb-3 tx-18 text-white">BNX Live Price</h6>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="card overflow-hidden sales-card  h-130" >
								<div class="">
									<div class="">
										<h4 class="" id="BNB-Balance"><?php echo 'BNX '.number_format($coinBalance['amount'],2); ?></h4>
										<h4 class="" style="font-size:14px !important" id="BNB-Balance"><?php echo 'Staked Date: '.$coinBalance['created_at']; ?></h4>
										<img src="<?php echo base_url('uploads/box-inner-icon.png');?>" class="img-fluid box-icon">
									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<h6 class="mb-3 tx-18" >Staked Coin Wallet</h6>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>


                        <div class="col-lg-4 col-md-6 col-sm-6">
							<div class="card overflow-hidden sales-card  h-130 box-active" >
								<div class="">
									<div class="">
										<h4 class=" text-white"><?php echo '$ '.$total_income['total_income']; ?></span> </h4>
										<img src="<?php echo base_url('uploads/box-inner-icon.png');?>" class="img-fluid box-icon">

									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<h6 class="mb-3 tx-18 text-white">Total Income</h6>
											</div>
										</div>
									</div>
								</div>

							</div>
						</div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
							<div class="card overflow-hidden sales-card  h-130" >
								<div class="">
									<div class="">
										<h4 class="">$ <?php echo $user['total_package']; ?></span> </h4>
										<img src="<?php echo base_url('uploads/box-inner-icon.png');?>" class="img-fluid box-icon">

									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<h6 class="mb-3 tx-18">Total Stake</h6>
											</div>
										</div>
									</div>
								</div>

							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="card overflow-hidden sales-card  h-130" >
								<div class="">
									<div class="">
										<h4 class="">$<?php echo $teamBusiness['teamBusiness']; ?></span> </h4>
										<img src="<?php echo base_url('uploads/box-inner-icon.png');?>" class="img-fluid box-icon">

									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<h6 class="mb-3 tx-18">Total BNX Business</h6>
											</div>
										</div>
									</div>
								</div>

							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="card overflow-hidden sales-card  h-130" >
								<div class="">
									<div class="">
										<h4 class=""><?php echo round($directTeam['directTeam'],3); ?></span> </h4>
										<img src="<?php echo base_url('uploads/box-inner-icon.png');?>" class="img-fluid box-icon">

									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<h6 class="mb-3 tx-18">Total Direct Team</h6>
											</div>
										</div>
									</div>
								</div>

							</div>
						</div>

						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="card overflow-hidden sales-card  h-130" >
								<div class="">
									<div class="">
										<h4 class="">BNX <?php echo $total_withdrawal['balance']; ?></h4>
										<img src="<?php echo base_url('uploads/box-inner-icon.png');?>" class="img-fluid box-icon">
									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<h6 class="mb-3 tx-18">Withdrawal BNX</h6>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="card overflow-hidden sales-card  h-130" >
								<div class="">
									<div class="">
										<h4 class="" id="BNB-Balance">BNX <?php echo $wallet_balance['wallet_balance']; ?></h4>
										<img src="<?php echo base_url('uploads/box-inner-icon.png');?>" class="img-fluid box-icon">
									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<h6 class="mb-3 tx-18" >Wallet Balance</h6>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<?php
							$incomes = incomes();
							foreach($incomes as $incKey => $inc):
								$getBalance = $this->User_model->get_single_record('tbl_income_wallet',['user_id' => $this->session->userdata['user_id'],'type' => $incKey],'ifnull(sum(amount),0) as balance');
						?>
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="card overflow-hidden sales-card  h-130"  >
								<div class="">
									<div class="">
										<h4 class=""><?php echo currency.' '.round($getBalance['balance'],2); ?></span></h4>
										<img src="<?php echo base_url('uploads/box-inner-icon.png');?>" class="img-fluid box-icon">
									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<h6 class="mb-3 tx-18"><?php echo $inc;?></h6>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
							endforeach;
						?>

						<!---<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="card overflow-hidden sales-card  h-130" >
								<div class="">
									<div class="">
										<h4 class=""> </h4>
										<img src="<?php echo base_url('uploads/box-inner-icon.png');?>" class="img-fluid box-icon">
									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<h6 class="mb-3 tx-16">Staked BNX: <?php echo number_format($totalStakeAmount['balance'],2); ?></h6>
												<h6 class="mb-3 tx-18">Purchase Price: $<?php echo $stakeAmount['token_price']; ?></h6>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="card overflow-hidden sales-card  h-130" >
								<div class="">
									<div class="">
										<h4 class=""> </h4>
										<a href="<?php echo base_url('Dashboard/Reports/stackHistory');?>"><img src="<?php echo base_url('uploads/box-inner-icon.png');?>" class="img-fluid box-icon"></a>
									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<h6 class="mb-3 tx-18">UnStack Amount: BNX <?php echo number_format($totalStakeAmount['balance2'],2); ?></h6>
												<h6 class="mb-3 tx-18">UnStack Date:
													<?php
														if($stakeAmount['months'] > 0):
															//echo $stakeAmount['maturity_date'];
															$diff = strtotime('+'.$stakeAmount['months'].' months', strtotime($stakeAmount['created_at'])) - strtotime(date('Y-m-d H:i:s'));
															echo '<div class="text-danger" id="timer"></div>';
															echo'<script> countdown("timer",'.$diff.') </script>';
														endif;
													?>
												</h6>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>


						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="card overflow-hidden sales-card  h-130" >
								<div class="">
									<div class="">
										<h4 class=""> </h4>
										<img src="<?php echo base_url('uploads/box-inner-icon.png');?>" class="img-fluid box-icon">
									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<h6 class="mb-3 tx-18">Magnetic Stake Amount: BNX <?php echo number_format($totalMurphyAmount['balance2'],2); echo '($'.number_format($totalMurphyAmount['balance3'],2).')' ?></h6>
												<h6 class="mb-3 tx-18">Purchase Price: $<?php echo $murphyAmount['token_price']; ?></h6>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="card overflow-hidden sales-card  h-130" >
								<div class="">
									<div class="">
										<h4 class="">
											<?php
												if($murphyAmount['total_days'] > 0):
													// echo date('Y-m-d',strtotime(date('Y-m-d').' + '.$murphyAmount['total_days'].' months'));
													$diff = strtotime('+'.$murphyAmount['total_days'].' months', strtotime($murphyAmount['created_at'])) - strtotime(date('Y-m-d H:i:s'));
													echo '<div class="text-danger" id="timer2"></div>';
													echo '<script> countdown("timer2",'.$diff.') </script>';
												endif;
											?>
										</h4>
										<a href="<?php echo base_url('Dashboard/Reports/magneticHistory');?>"><img src="<?php echo base_url('uploads/box-inner-icon.png');?>" class="img-fluid box-icon"></a>
									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<h6 class="mb-3 tx-18">Magnetic Unstake Time</h6>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>


						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="card overflow-hidden sales-card  h-130" >
								<div class="">
									<div class="">
										<h4 class=""><?php echo number_format($income_balance['income_balance'],2); ?></h4>
										<img src="<?php echo base_url('uploads/box-inner-icon.png');?>" class="img-fluid box-icon">
									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<h6 class="mb-3 tx-18">BNX Balance</h6>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>--->



						<!-- <div class="col-lg-4 col-md-6 col-sm-6">
							<div class="card overflow-hidden sales-card bg-success-gradient" style="background:#000000  !important;">
								<div class="">
									<div class="">
										<h6 class="mb-3 tx-18">Direct Referral </h6>
									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<h4 class="">Active : <?php echo $paid_directs['paid_directs']; ?> , InActive : <?php echo $free_directs['free_directs']; ?></h4>
											</div>

										</div>
									</div>
								</div>
							</div>
						</div> -->
						<!-- <div class="col-lg-4 col-md-6 col-sm-6" style="display:none">
							<div class="card overflow-hidden sales-card " style="background:#000000  !important;">
								<div class="">
									<div class="">
										<h6 class="mb-3 tx-18">Direct Income</h6>
										<img src="<?php echo base_url('uploads/box-inner-icon.png');?>" class="img-fluid box-icon">
									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<h4 class="">$<?php echo number_format($direct_income['direct_income'], 2); ?> </h4>
											</div>

										</div>
									</div>
								</div>

							</div>
						</div> -->

						<div class="col-lg-4 col-md-6 col-sm-6" style="display:none">
							<div class="card overflow-hidden sales-card "   style="background:#000000  !important;">
								<div class="">
									<div class="">
										<h4 class=""><?php echo number_format($income_balance['income_balance'], 2); ?></h4>
										<img src="<?php echo base_url('uploads/box-inner-icon.png');?>" class="img-fluid box-icon">
									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<h6 class="mb-3 tx-18">BNX Balance</h6>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- <div class="col-lg-4 col-md-6 col-sm-6" style="display:none">
							<div class="card overflow-hidden sales-card "  style="background:#000000  !important;">
								<div class="">
									<div class="">
										<h6 class="mb-3 tx-18">Today Income </h6>
										<img src="<?php echo base_url('uploads/box-inner-icon.png');?>" class="img-fluid box-icon">
									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<h4 class="">$<?php echo round($today_income['today_income'],2); ?></span></h4>
											</div>

										</div>
									</div>
								</div>

							</div>
						</div> -->

						<div class="col-lg-4 col-md-6 col-sm-6" style="display:none">
							<div class="card overflow-hidden sales-card "  style="background:#000000  !important;">
								<div class="">
									<div class="">
										<h4 class="">$<?php echo abs($total_withdrawal['total_withdrawal']); ?></span></h4>
										<img src="<?php echo base_url('uploads/box-inner-icon.png');?>" class="img-fluid box-icon">
									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<h6 class="mb-3 tx-18">BNX Withdraw</h6>
											</div>

										</div>
									</div>
								</div>

							</div>
						</div>


						<div class="col-xl-6 col-lg-6 col-md-6 col-xm-12" style="display:none">
							<div class="card overflow-hidden sales-card " >
								<div class="">
									<div class="">
										<h6 class="mb-3 tx-18">Buy with BNB <br>BNX Tokens</h6>
										<img src="<?php echo base_url('uploads/box-inner-icon.png');?>" class="img-fluid box-icon">
									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<button type="button" class="btn btn-primary token-btn" data-bs-toggle="modal" data-bs-target="#buyModal" onclick="getBalance()">Buy Token</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>



						<!---<div class="col-xl-6 col-lg-6 col-md-6 col-xm-12">
							<div class="card overflow-hidden sales-card box-active">
								<div class="">
									<div class="">
										<h6 class="mb-3 tx-18 text-white">Stake Your Token  Free Hold <br> Magnetic Stake
</h6>
										<img src="<?php echo base_url('uploads/box-inner-icon.png');?>" class="img-fluid box-icon">
									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<button type="button" class="btn btn-primary token-btn" data-bs-toggle="modal" data-bs-target="#sellModal" onclick="getBalance()">Sell Token</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>


						<div class="col-xl-6 col-lg-6 col-md-6 col-xm-12">
							<div class="card overflow-hidden sales-card box-active">
								<div class="">
									<div class="">
										<h6 class="mb-3 tx-18 text-white">Stake Your BNX Tokens</h6>
										<img src="<?php echo base_url('uploads/box-inner-icon.png');?>" class="img-fluid box-icon">
									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<button type="button" class="btn btn-primary token-btn" data-bs-toggle="modal" data-bs-target="#stackingModal" onclick="getBalance()">Stack</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-6 col-lg-6 col-md-6 col-xm-12">
							<div class="card overflow-hidden sales-card box-active">
								<div class="">
									<div class="">
										<h6 class="mb-3 tx-18 text-white">Magnetic Strategy</h6>
										<img src="<?php echo base_url('uploads/box-inner-icon.png');?>" class="img-fluid box-icon">
									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<button type="button" class="btn btn-primary token-btn" data-bs-toggle="modal" data-bs-target="#purchaseModal" onclick="getBalance()">Stack</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>-->
			<div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card  box-bg" style="background: linear-gradient(270deg, #272727 0, #000000)!important">
                  <div class=""><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <div class="clearfix">
                      <h4 class="card-title w-100 text-white">My Referral Link</h4>
                     <div class="copyrefferal box box-body pull-up bg-hexagons-white p-0 border-0">
                      <input style="width:100%; margin-bottom: 10px; float:left" type="text" id="linkTxt"
                      value="<?php echo base_url('Dashboard/Register/?sponser_id='.$userinfo->user_id); ?>"
                      class="form-control">
                      <button id="btnCopy" iconcls="icon-save" onclick="myFunction()" class="btncopy btn-rounded m-b-5 copy-section" style="background:#e98e06;
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
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card  box-bg" style="background: linear-gradient(270deg, #272727 0, #000000)!important">
                  <div class="">
                    <div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <h4 class="card-title  text-white">Latest News</h4>
                       <marquee direction="up" scrollamount="2">
							<?php foreach($news as $n):?>
							<p style="color:#fff"><?php echo $n['news'];?></p>
							<?php endforeach;?>
						</marquee>
                  </div>
                </div>
              </div>
			</div>
			<div class="col-md-6 grid-margin stretch-card">
                <div class="card  box-bg" style="background: linear-gradient(270deg, #272727 0, #000000)!important">
                  	<div class="card-body">
                    	<div class="chartjs-size-monitor">
							<div class="chartjs-size-monitor-expand">
								<div class=""></div>
							</div>
							<div class="chartjs-size-monitor-shrink">
								<div class=""></div>
						</div>
					</div>
					<h4 class="card-title  text-white">Income Progress(<span class="text-success">Total Limit :<?php echo $user['incomeLimit2'];?></span>)</h4>
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
	</div>

<div class="col-md-12">
<div class="row">
<div class="card card-body">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Level</th>
									<th>Directs</th>
									<th>Status</th>
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
    <div>
  </div>
</div>
</div>

<div class="modal fade" id="stackingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Stacking <span id="coinBalance"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	<form id="stackFrom">
      	<div class="modal-body">
			<input type="hidden" class="tokenall" name="csrf_test_name" value="<?php echo $this->security->get_csrf_hash();?>" style="display:none;">
			<div class="form-group">
				<label>BNX Amount</label>
				<input type="number" name="amount" id="stackAmount" class="form-control" onkeyup="calculateCoin()">
			</div>
			<span id="extraStack"></span>
			<span id="totalStack"></span>
			<div class="form-group">
				<label>Stake Holding Period</label>
				<select class="form-control" name="months" id="months" onchange="calculateCoin()">
					<option value="18">18 Months 20% Extra</option>
					<option value="24">24 Months 36% Extra</option>
					<option value="36">36 Months 48% Extra</option>
					<option value="48">48 Months 60% Extra</option>
				<select>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Stack</button>
		</div>
	</form>
    </div>
  </div>
</div>
<div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Purchase BNX <span id="walletBalance"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	<form id="purchaseFrom">
      	<div class="modal-body">
			<input type="hidden" class="tokenall" name="csrf_test_name" value="<?php echo $this->security->get_csrf_hash();?>" style="display:none;">
			<div class="form-group">
				<label>Select Currency</label>
				<select class="form-control" name="currency">
					<option value="bnb">BNB</option>
					<option value="busd">BUSD</option>]
				<select>
			</div>
			<div class="form-group">
				<label>Magnetic Period</label>
				<select class="form-control" name="months">
					<option value="18">18 Months 3% Monthly</option>
				<select>
			</div>
			<div class="form-group">
				<label>Dollar Amount (Minimum $100)</label>
				<input type="number" name="amount" class="form-control" onkeyup="getMHY()" id="amount">
				<span id="murphyCoin"></span>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Purchase BNX</button>
		</div>
	</form>
    </div>
  </div>
</div>
<div class="modal fade" id="buyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Buy Coin <span id="walletBalance2"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	<form id="buyCoinForm">
      	<div class="modal-body">
			<input type="hidden" class="tokenall" name="csrf_test_name" value="<?php echo $this->security->get_csrf_hash();?>" style="display:none;">
			<div class="form-group">
				<label>Dollar Amount</label>
				<input type="number" name="amount" class="form-control" onkeyup="getMHY2()" id="buyCoinAmount1">
			</div>
			<div class="form-group">
				<label>Approx. Coin</label>
				<input type="text" class="form-control" id="buyCoinAmount2">
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Buy Coin</button>
		</div>
	</form>
    </div>
  </div>

</div>
<!-- <h4 class="text-dark">text</h4> -->

<div class="modal fade" id="sellModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Free Hold Stack Coin <span id="walletBalance3"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	<form id="sellCoinForm">
      	<div class="modal-body">
			<input type="hidden" class="tokenall" name="csrf_test_name" value="<?php echo $this->security->get_csrf_hash();?>" style="display:none;">
			<div class="form-group">
				<label>Coin Amount</label>
				<input type="number" name="amount" class="form-control" onkeyup="getMHY2()" id="sellCoinAmount1">
			</div>
			<div class="form-group">
				<label>Approx. USDT</label>
				<input type="text" class="form-control" id="sellCoinAmount2">
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Stake Now</button>
		</div>
	</form>
    </div>
  </div>
<
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
  var url2 = "<?php echo base_url('Dashboard/Activation/purchaseMurphy');?>";
  purchaseFrom.onsubmit = async (e) => {
    e.preventDefault();
    let response = await fetch(url2, {
      method: 'POST',
      body: new FormData(purchaseFrom)
    });
    let result = await response.json();
	updateToken(result.token);
    if(result.status == 1){
      alert(result.message);
      location.reload();
    }else{
      alert(result.message);
    }
  };

  var url3 = "<?php echo base_url('Dashboard/Activation/stackKSN');?>";
  ksnForm.onsubmit = async (e) => {
    e.preventDefault();
    let response = await fetch(url3, {
      method: 'POST',
      body: new FormData(ksnForm)
    });
    let result = await response.json();
	updateToken(result.token);
    if(result.status == 1){
      alert(result.message);
      location.reload();
    }else{
      alert(result.message);
    }
  };

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
	var url = "<?php echo base_url('Dashboard/User/jsonData');?>";
	fetch(url,{
		method:"GET"
	})
	.then(response => response.json())
	.then(response => {
		//console.log(response.freeTeam.team);
		//console.log(response.paidDirects.paidDirects);
		document.getElementById('paidTeam').innerHTML = 'Active : '+response.paidTeam.team;
		document.getElementById('freeTeam').innerHTML = 'InActive : '+response.freeTeam.team;
		document.getElementById('paidDirects').innerHTML = 'Active : '+response.paidDirects.paidDirects;
		document.getElementById('freeDirects').innerHTML = 'InActive : '+response.freeDirects.freeDirects;
		kycData();
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
