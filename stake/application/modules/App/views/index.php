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
marquee {
    height: 100%;
}
.news-bg {
    background: #01667f;

}
.app-box p {
    color: #fff;
    text-transform: capitalize;
    margin: 0px;
    font-weight: bold;
    font-size: 12px;
}
.app-top-head {
    background: #01667f;

}
.app-box {
    width: 100%;
    text-align: center;
    box-shadow: 0px 0px 10px rgb(1 102 127);
    border-radius: 4px;
    padding: 10px 0px;
    display: inline-block;
    margin: 10px 0px;
    border-bottom: 3px #01667f solid;
    border: 3px #01667f solid;
    background: #01667f;
    color: #fff;
}
.package-head-box {

    background: #03657e;
    border-radius: 4px;
    box-shadow: 0px 0px 10px rgb(1 102 127);
    margin: auto;
    padding: 6px;
    border: 1px #03657e solid;
    border-bottom: 3px #03657e solid;
    color: #fff;
}
.package-head-box p {
    margin: 0px;
    color: #fff;
    font-size: 12px;
    margin-top: 0px;
    font-weight: 500;
    font-weight: bold;
}
.total-income-box.text-center {
    background: #03657e;
    box-shadow: 0px 0px 10px rgb(3 101 126);
    border-radius: 4px;
    padding: 10px 0px;
    border-bottom: 3px #03657e solid;
    border: 1px #03657e solid;
    width: 60%;
    margin: auto;
    margin-top: 20px;
    color: #ffff;
}
.total-income-box h4 {
    color: #fff;
    margin: 0px;
    font-size: 14px;
    font-weight: bold;
}
tr:nth-child(even) {background-color: #f2f2f2;}
.wallet-box.wallet-btn {
  background: #006780;
    text-align: center;
    padding: 5px;
    color: #fff;
    border-radius: 10px;
    border: 2px #fff solid;
}
.wallet-box.wallet-btn a {
    color: #fff;
    font-weight: bold;
}
@media screen and (max-width:575px){
    .news {
        height: 100px;
    }
}
.horizontal-menu{
    visibility: hidden;
}
</style>


            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content py-0">
                <div class="footer-tab">
                    <div class="tile" id="tile-1">

  <!-- Nav tabs -->


  <!-- Tab panes -->
      <div class="tab-content">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                        <div class="user-deatils-bg" style="background:url(https://zilgrow.io/forex.jpg) !important">
                            <div class="user-deatils">
                                <p style="color:#fff">User Name : <?php echo $userinfo->name ?> </p>
                                <p style="color:#fff">User Id :  <?php echo $userinfo->user_id ?></p>

                                <p style="color:#fff">Joining Date :  <?php echo $userinfo->created_at ?> </p>
                                <div class="package-box">
                                      <p>Total Package <span> Zil <?php echo $userinfo->package_amount; ?></span></p>
                                </div>
                               
                                <div class="wallets">
                                    <a href="<?php echo base_url('App/User/income_ledgar'); ?>">
                                        <div class="wallet-box wallet-btn">
                                            Main Wallet
                                            <p style="font-size:20px; color:white">Zil <?php echo round($income_balance['income_balance'],2); ?></p>
                                    </div>
                                    </a>
                                   <a href="<?php echo base_url('App/fund/wallet_ledger') ?>"> <div class="wallet-box wallet-btn">
                                         Fund Wallet
                                          <p style="font-size:20px; color:white"><?php echo round($wallet_balance['wallet_balance'],2);?> ZiL </p>
                                    </div></a>
                                </div>
                            </div>
                        </div>
                        <p style="font-size: 20px;
    margin: 0px;
    padding: 0px;
    color: #26677f;
    font-family: Arial;
    text-align: center;
    font-weight: bold;" class="d-none"> Current Package <?php echo $currentPackage; ?> Zil </p>
                        <?php if($user_info->retopup == 1):?>
                        <div class="news-bg" style="background:red; font-family:Arial; font-weight:bold">
                            <marquee direction="left">Note : Your 5x Limit is Up Kindly Upgrade Your Account to continue Income. Thanks</marquee>
                        </div>
                        <?php endif;?>
                        <div class="package-head">
                            <a href="<?php echo base_url('App/Activation'); ?>">
                                <div class="package-head-box">
                                    <img src="<?php echo base_url('uploads/package.png');?>">
                                    <p>Buy Package</p>
                                </div>
                            </a>
                            <a href="<?php echo base_url('App/Payment'); ?>">
                                <div class="package-head-box">
                                    <img src="<?php echo base_url('uploads/deposit.png');?>">
                                    <p>Deposit</p>
                                </div>
                            </a>
                            <a href="<?php echo base_url('App/Dashboard/DirectIncomeWithdraw'); ?>">
                                <div class="package-head-box">
                                    <img src="<?php echo base_url('uploads/withdrawal.png');?>">
                                    <p>Withdraw</p>
                                </div>
                            </a>
                        </div>
                        <div class="news-bg">
                            <marquee direction="left">Latest News : <?php foreach($news as $key => $new) { echo $new['news']; } ?></marquee>
                        </div>
                        <div class="app-body">
                            <a href="<?php echo base_url('App/User/Directs') ?>">
                                <div class="app-box">
                                    <img src="<?php echo base_url('uploads/team.png');?>" class="img-fluid">
                                    <p>My Directs</p>
                                </div>
                            </a>
                             <a href="<?php echo base_url('App/Network/levelReport') ?>">
                                <div class="app-box">
                                    <img src="<?php echo base_url('uploads/team-1.png');?>" class="img-fluid">
                                    <p>My Team</p>
                                </div>
                            </a>
                              <a href="<?php echo base_url('App/User/GenelogyTree/' . $user_info->user_id); ?>">
                                <div class="app-box">
                                    <img src="<?php echo base_url('uploads/salary.png');?>" class="img-fluid">
                                    <p>Team Tree</p>
                                </div>
                            </a>
                            <a href="<?php echo base_url('App/Activation/UpgradeAccount'); ?>">
                                <div class="app-box">
                                    <img src="<?php echo base_url('uploads/salary.png');?>" class="img-fluid">
                                    <p>Upgrade Package</p>
                                </div>
                            </a>
                              <a href="<?php echo base_url('App/Fund/maintransfer_fund'); ?>">
                                <div class="app-box">
                                    <img src="<?php echo base_url('uploads/salary.png');?>" class="img-fluid">
                                    <p>Main TO Fund</p>
                                </div>
                            </a>

                             <a href="<?php echo base_url('App/Fund/transfer_fund') ?>">
                                <div class="app-box">
                                    <img src="<?php echo base_url('uploads/salary.png');?>" class="img-fluid">
                                    <p>Fund To Fund</p>
                                </div>
                            </a>
                            <a href="<?php echo base_url('App/Fund/activation_history'); ?>">
                                <div class="app-box">
                                    <img src="<?php echo base_url('uploads/data-collection.png');?>" class="img-fluid">
                                    <p>Activaction History</p>
                                </div>
                            </a>
                            <a href="<?php echo base_url('App/Fund/upgrade_history'); ?>">
                                <div class="app-box">
                                    <img src="<?php echo base_url('uploads/data-collection.png');?>" class="img-fluid">
                                    <p>Upgrade History</p>
                                </div>
                            </a>




                            <div class="total-income-box text-center">
                                <h4>Total Team : <?php echo $totalTeam['totalTeam'];?></h4>
                            </div>
                            <div class="total-income-box text-center">
                                <h4>Total Income : ZIL <?php echo round($total_income['total_income'],2);?></h4>
                            </div>


                        </div>

            </div>
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

          </div>
          <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

            B
          </div>
          <div class="tab-pane fade" id="setting" role="tabpanel" aria-labelledby="setting-tab">

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
                <div class="profile-setting">
                    <ul>
                        <li>
                            <a href="<?php echo base_url('App/Support/ComposeMail');?>">Help & Support</a>
                        </li>

                        <li>
                            <a href="<?php echo base_url('App/Profile/changePassword');?>">Update Password </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('App/Profile');?>">Edit Profile </a>
                        </li>
                        <li>
                            <a href="#">Refer & Earn</a>
                        </li>
                    </ul>
                    <div class="logout text-center">
                        <a class="btn btn-primary d-inline" href ="<?php echo base_url('App/User/logout') ?>" style="border-radius: 30px;">
                            Logout
                        </a>
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
                                    <h4 class="font-size-18">App</h4>
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item active">Welcome <?php echo ($userinfo->name) ?> (<?php echo ($userinfo->user_id) ?>)</li>

                                    </ol>
                                    <p class="breadcrumb-item">

                                    </p>
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

                        

  </div>
</div>
<?php include_once 'footer.php';  ?>

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
