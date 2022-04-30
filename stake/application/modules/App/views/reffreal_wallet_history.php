<?php include'header.php' ?>
<div class="main-content">
  <div class="page-content">
<div class="container">
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <style>
    .text-success {
      color: #1e9f34!important;
      font-size: 16px;
      font-weight: bold;
    }
    .text-danger {
        color:#fe7c96 !important;
        font-size: 16px;
        font-weight: bold;
    }
    .withdraw-coin-btn{
      width: auto;
      padding: 6px 8px;
      font-size: 14px;
      box-shadow: 0px 0px 10px rgb(1 102 127);
      background: #03657e;
      border: 0px;
      display: inline-block;
      margin-top: 9px;
      color: #fff;
      border-radius: 3px;
    }
    </style>
    <div class="panel-heading">

        <span style="">Bonus  /  <?php echo $header; ?> ZIL. <?php echo $total_income['total_income'];?></span>
        <a class = "withdraw-coin-btn" href ="<?php echo base_url('App/Fund/withdrawZil') ?>" > Withdrwal Coin</a>
    </div>

    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <div class="">
      <div class="">
       
         <?php
            foreach ($records as $key => $income) {
          ?>
        <div class="boxesmain">
          <div style="float: left;font-weight:bold;color:#000;width: 75%;">
              <?php echo 'Refferal Zil From '.$income['from_user']; ?>
              <p><?php echo $income['created_at']; ?></p>
              <p style="font-weight: normal;color: #000;font-weight: 600;"><?php echo  $income['type']; ?></p>
          </div>
              <div style="float: right;width:25%;text-align: right;"> 
                <?php echo $income['amount'] > 0 ? '<span class="text-success"> + ZIL. ' . $income['amount'] . '</span>' : '<span class="text-danger"> - ZIL. ' . $income['amount'] . '</span>'; ?>
              </div>
        </div>
 <?php
                                  }
                                  ?>description

    <div id="rootwizard" class="wizard wizard-full-width">
        <!-- BEGIN wizard-header -->

        <!-- END wizard-header -->
        <!-- BEGIN wizard-form -->

            <div class="wizard-content tab-content">
                <!-- BEGIN tab-pane -->
                <div class="tab-pane active show" id="tabFundRequestForm">
                    <!-- BEGIN row -->
                    <div class="row">
                        <!-- BEGIN col-6 -->
                        <div class="col-md-12">
                            <div class="box box-solid bg-black">
                             
                               <div class="box-body">
                          <div class="table-responsive">
                          
                        </div>
                      </div>
                    </div>
                        </div>

                        <!-- END col-6 -->
                    </div>
                    <!-- END row -->
                </div>
                <!-- END tab-pane -->
                <!-- BEGIN tab-pane -->

            </div>
            <!-- END wizard-content -->

        <!-- END wizard-form -->
    </div>
    <!-- END wizard -->
  </div>
</div>
</div>
</div>
</div>






<?php include'footer.php' ?>
