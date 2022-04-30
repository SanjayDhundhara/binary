<?php require_once'header.php';?>
<style>
    .caping-bg {
        background: #05647d !important;
    }
    /*body {
        font-size: 0;
        text-align: center;
    }
    .circle {
        width: 200px;
        margin: 6px 20px 20px;
        display: inline-block;
        position: relative;
        text-align: center;
        vertical-align: top;

    }*/
    /*.strong {
            position: absolute;
            top: 70px;
            left: 0;
            width: 100%;
            text-align: center;
            line-height: 45px;
            font-size: 43px;
        }*/
    button.btn.btn-primary {
    background: #e8ad4d;
    border: 2px #07637c solid;
}
table.table.table-bordered h3 {
    font-size: 18px;
    font-weight: normal;
}

body {
    font-size: 0;
    text-align: center;
}
.circle {
  width: 79px;
    margin: -46px 20px 20px;
    display: inline-block;
    position: relative;
    text-align: center;
    vertical-align: top;

}
.strong {
    position: absolute;
    top: 14px;
    left: 0;
    width: 100%;
    text-align: center;
    line-height: 45px;
    font-size: 24px;
}
.caping-bg {

    height: 97px;
}
.circle canvas {
    max-width: 100% !important;
    height: auto !important;
}

</style>
 <div class="table-portfolio">
      <div class="portfolio-head text-center">
                        <!-- <h6>Welcome <?php echo $user['name'];?></h6> -->
                        <p>User Name : <?php echo $user['name'];?></p>
                        <p>User Id : <?php echo $user['user_id'];?></p>
                        <p>Email : <?php echo $user['email'];?></p>

                    </div>
                             <table class="table table-bordered">
                        <tr>
                            <td>
                            <a href="<?php echo base_url('App/User/income_ledgar')?>">
                            <img src="<?php echo base_url('uploads/salary.png');?>">
                                    <p>Total Income</p>
                                    <h3>Zil <?php echo round($total_income['total_income'],2);?></h3>
</a>
                            </td>
                            <td>
                            <a href="<?php echo base_url('App/User/income/matching_bonus')?>">

                                    <img src="<?php echo base_url('uploads/salary.png');?>">
                                    <p>Matching Income</p>
                                    <h3>Zil <?php echo round($matching_bonus['matching_bonus'],2)?></h3>
</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="<?php echo base_url('App/User/income/self_income')?>">
                                    <img src="<?php echo base_url('uploads/salary.png');?>">
                                    <p>D.T.P. Income</p>
                                    <h3>Zil <?php echo round($self_income['self_income'],2)?></h3>
                                </a>
                            </td>
                            <td>
                                <a href="<?php echo base_url('App/User/income/direct_income')?>">
                                    <img src="<?php echo base_url('uploads/salary.png');?>">
                                    <p>Direct Income</p>
                                    <h3>Zil <?php echo round($direct_income['direct_income'],2);?></h3>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                 <a href="<?php echo base_url('App/User/income/royalty_income')?>">
                                    <img src="<?php echo base_url('uploads/salary.png');?>">
                                    <p>Performance Income</p>
                                    <h3>Zil <?php echo round($royalty_income['royalty_income'],2);?></h3>

                                </a>
                            </td>
                            <td>
                                <a href="<?php echo base_url('App/User/income/reward_income')?>">
                                    <img src="<?php echo base_url('uploads/salary.png');?>">
                                    <p>Income Rewards</p>
                                    <h3>Zil <?php echo round($reward_income['reward_income'],2); ?></h3>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/salary.png');?>">
                                    <p>Left Team</p>
                                    <h3><?php echo $user['left_count']?></h3>
                                </a>
                            </td>
                            <td>
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/salary.png');?>">
                                    <p>Right Team</p>
                                    <h3><?php echo $user['right_count'];?></h3>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/salary.png');?>">
                                    <p>Left Directs</p>
                                    <h3><?php echo $leftDirect['leftDirect'];?></h3>
                                </a>
                            </td>
                            <td>
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/salary.png');?>">
                                    <p>Right Directs</p>
                                    <h3><?php echo $rightDirect['rightDirect'];?></h3>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/salary.png');?>">
                                    <p>Left ZS</p>
                                    <h3><?php echo $user['leftBusiness']?></h3>
                                </a>
                            </td>
                            <td>
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/salary.png');?>">
                                    <p>Right ZS</p>
                                    <h3><?php echo $user['rightBusiness']?></h3>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/salary.png');?>">
                                    <p>Left BUsiness</p>
                                    <h3>Zil <?php echo $user['leftPower']?></h3>
                                </a>
                            </td>
                            <td>
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/salary.png');?>">
                                    <p>Right Business</p>
                                    <h3>Zil <?php echo $user['rightPower']?></h3>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/salary.png');?>">
                                    <p>Total Business</p>
                                    <h3><?php echo round($business['business'],2);?></h3>
                                </a>
                            </td>
                            <td>
                                <a href="<?php echo base_url('App/User/reffrelWalletHistory')?>">
                                        <button class="btn btn-primary">
                                           Refer Income
                                        </button>
                                </a>
                            </td>
                        </tr>
                    </table>

                    <div class="caping-bg">
                        <div class="caping-earn">

                            <?php

                        $newAmount2 = $user['package_amount']-$today_income['today_income'];
                        if($user['package_amount'] > 0){
                            $descrased2 = round(100-($newAmount2/$user['package_amount']*100),3);
                        } else {
                            $descrased2 = 0;
                        }

                        if($user['package_amount'] > 0){
                            if($today_income['today_income'] >= $user['package_amount']){
                                $setValue2 = '10.0';
                            }else{
                                if($descrased2 >= 10){
                                    $setValue2 = '0.'.str_replace('.', '', $descrased2);
                                }else{
                                    $setValue2 = '0.0'.str_replace('.', '', $descrased2);
                                }
                                
                            }
                        } else {
                            $setValue2 = '0.'.str_replace('.', '', $descrased2);
                        }
                        // pr($descrased2);
                        ?>
                            <p>Today Earn Upto
                                <span>Zil <?php echo $user['package_amount']; ?></span></p>
                        </div>
                        <div class="caping-earn">
                           <div class="progress d-none">
                                <span class="title timer" data-from="0" data-to="70" data-speed="1500">70</span>
                                <div class="overlay"></div>
                                <div class="left"></div>
                                <div class="right"></div>
                            </div>
                           <!-- <div class="circle" id="circle-a">
                                <strong></strong>
                            </div>
                            <div class="circle" id="circle-b">
                                <strong></strong>
                            </div> -->
                            <div class="circle" id="circle-c">
                                <!-- <canvas width="50" height="50" style="color: red;"> -->
                                <strong class="strong"></strong>
                            </div>
                        </div>
                        <div class="caping-earn">
                            <p>Income Received
                                <span>Zil <?php echo round($today_income['today_income'],2);?></span></p>
                        </div>

                    </div>

                    <div class="caping-bg">
                        <?php

                        $newAmount = ($user['package_amount']*5)-$total_income['total_income'];
                        if($user['package_amount'] > 0){
                            $descrased = round(100-($newAmount/($user['package_amount']*5)*100),3);
                            //$setValue = str_replace('.', '', $descrased);
                        } else {
                            $descrased = 0;
                        }

                        if($user['package_amount'] > 0){
                            if($total_income['total_income'] >= ($user['package_amount']*5)){
                                $setValue = '10.0';
                            }else{
                                // if($descrased <= 9.00){
                                //     $setValue = '0.0'.str_replace('.', '', $descrased);
                                // }else{
                                //     $setValue = '0.'.str_replace('.', '', $descrased);
                                // }
                                if($descrased >= 10){
                                    $setValue = '0.'.str_replace('.', '', $descrased);
                                }else{
                                    $setValue = '0.0'.str_replace('.', '', $descrased);
                                }

                            }
                        } else {
                            $setValue = '0.'.str_replace('.', '', $descrased);
                        }

                        ?>
                        <div class="caping-earn">
                            <p>Total Earn Upto 5x
                                <span>Zil <?php echo (($user['package_amount']*5) < 60000)? ($user['package_amount']*5):'60000'; ?></span></p>
                        </div>
                        <div class="caping-earn">
                            <div class="circle" id="circle-b">
                                <strong class="strong"></strong>
                            </div>
                           <div class="progress d-none">
                                <span class="title timer" data-from="0" data-to="<?php echo $descrased; ?>" data-speed="1500"><?php echo $descrased; ?></span>
                                <div class="overlay"></div>
                                <div class="left"></div>
                                <div class="right"></div>
                            </div>
                        </div>
                        <div class="caping-earn">
                            <p>Income Received 5x
                                <span>Zil <?php echo round($total_income['total_income'],2);?></span></p>
                        </div>

                    </div>

                           </div>

<?php require_once'footer.php';?>
<script src="https://cpwebassets.codepen.io/assets/common/browser_support-e442aebd85f2bb9dcd4a47cb43c7fc38efd5522ace0a675bf5e33a06413b5a28.js"></script>
<script src="https://cpwebassets.codepen.io/assets/common/everypage-f84dd91ff413b23b8d1a6f7eadc615dc53c384f74f8254e068449db735b2c8cd.js"></script>
<script src="https://cpwebassets.codepen.io/assets/common/analytics_and_notifications-afa6925cbcff840929f2b7c543587d5f9d7a461af81ee7ca80631c8e37ac42f2.js"></script>
<script src="https://cpwebassets.codepen.io/assets/packs/js/vendor-b5fdc983719cf9de7c76.chunk.js"></script>
<script src="https://cpwebassets.codepen.io/assets/packs/js/referrer-tracking-c7ee6b1c3341e57418f7.js"></script>
<script src="https://cdn.speedcurve.com/js/lux.js?id=410041" async defer crossorigin="anonymous"></script>
<script src="<?php echo base_url('SiteAssets/js/circle-progress.js'); ?>"></script>
<script src="<?php echo base_url('SiteAssets/js/circle-progress.min.js'); ?>"></script>
<script>

// var progressBarOptions = {
// 	startAngle: -1.55,
// 	size: 200,
//     value: 1,
//     fill: {
// 		color: '#000'
// 	}
// }

// $('.circle').circleProgress(progressBarOptions).on('circle-animation-progress', function(event, progress, stepValue) {
// 	$(this).find('strong').text(String(stepValue.toFixed(2)).substr(1));
// });

// $('#circle-b').circleProgress({
// 	value : 0.25,
// 	fill: {
// 		color: '#FF0000'
// 	}
// });

// $('#circle-c').circleProgress({
// 	value : 0.92,
// 	fill: {
// 		color: '#008000'
// 	}
// });

var progressBarOptions = {
    startAngle: -1.55,
    size: 100,
    value: 0.012,
    fill: {
        color: '#ffa500'
    }
}

$('.circle').circleProgress(progressBarOptions).on('circle-animation-progress', function(event, progress, stepValue) {
    // let text = stepValue;
    // let stepValue2 = text.replace("0.", "");
    // var res = stepValue.replace("0.", "");
    //$(this).find('strong').text(String(stepValue.toFixed(2)).replace("0.","")+'%');
    if(stepValue >= 0.01){
        $(this).find('strong').text(String(stepValue.toFixed(2)).replace("0.","")+'%');
    }else{
        $(this).find('strong').text(String(stepValue.toFixed(3))+'%');
    }
});

$('#circle-b').circleProgress({
    value : "<?php echo $setValue; ?>",
    fill: {
        color: '#ffa500'
    }
});

$('#circle-c').circleProgress({
    value : "<?php echo $setValue2; ?>",
    fill: {
        color: '#ffa500'
    }
});
</script>
