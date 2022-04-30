<?php include'header.php' ?>
<style>
  section.content-header{
        background: #e0e0e0;
    color: #000;
    padding: 8px 16px;
    border-radius: 10px;
}

  .messageBox {
  padding: 1em;
  background: #002e3666;
  border: #eee solid 2px;
  position: absolute;
  top: 50%;
  left: 50%;
  margin-right: -50%;
  transform: translate(-50%, -50%);
  text-shadow: 0px 0px 8px #000;
  color: #fff;
}
#text {
  font-family: Questrial;
  text-align: center;
}
#construction {
  font-family: "Pacifico", cursive;
}

</style>

<!-- <div class="messageBox">
  <h1 id="construction">Coming Soon!</h1>
</div> -->

<?php  $none = 0; ?>
 <?php //($none == 1){ ?>
<main>
    <div class="container-fluid site-width">
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <section class="content-header">
        <span style="">Deposit History</span>
    </section>
    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <div class="content">
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
                        <div class="card card-body">
                            <p class="desc m-b-20" style="margin-top:20px;font-size: 18px;">Make sure to use a valid input, you'll need to verify it before you can submit request.</p>
                            <div class="form-group m-b-10">

                            </div>
                            <div class="form-group m-b-10">
                               <div class="box box-solid bg-black">
                               <div class="box-body">
                              <div class="table-responsive">
                              <table class="table table-bordered table-striped dataTable" id="tableView">
                                  <thead>
                                      <tr>
                                          <th>S No.</th>
                                          <th>User ID</th>
                                          <th>blockNumber</th>
                                          <th>timeStamp</th>
                                          <th>hash</th>
                                          <th>nonce</th>
                                          <th>blockHash</th>
                                          <th>from</th>
                                          <th>contractAddress</th>
                                          <!-- <th>to</th> -->
                                          <th>value</th>
                                          <th>tokenName</th>
                                          <th>tokenSymbol</th>
                                          <th>tokenDecimal</th>
                                          <th>transactionIndex</th>
                                          <th>gas</th>
                                          <th>gasPrice</th>
                                          <th>gasUsed</th>
                                          <th>cumulativeGasUsed</th>
                                          <th>input</th>
                                          <th>confirmations</th>
                                          <th>transfer_status</th>


                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                      foreach ($records as $key => $request) {
                                          ?>
                                          <tr>
                                              <td><?php echo ($key + 1) ?></td>
                                              <td><?php echo $request['user_id']; ?></td>
                                              <td><?php echo $request['blockNumber']; ?></td>
                                              <td><?php echo $request['timeStamp']; ?></td>
                                              <td><?php echo $request['hash']; ?></td>
                                              <td><?php echo $request['nonce']; ?></td>
                                              <td><?php echo $request['blockHash']; ?></td>
                                              <td><?php echo $request['from']; ?></td>
                                              <td><?php echo $request['contractAddress']; ?></td>
                                              <!-- <td><?php //echo $request['to']; ?></td> -->
                                              <td><?php echo $request['value']; ?></td>
                                              <td><?php echo $request['tokenName']; ?></td>
                                              <td><?php echo $request['tokenSymbol']; ?></td>
                                              <td><?php echo $request['tokenDecimal']; ?></td>
                                              <td><?php echo $request['transactionIndex']; ?></td>
                                              <td><?php echo $request['gas']; ?></td>
                                              <td><?php echo $request['gasPrice']; ?></td>
                                              <td><?php echo $request['gasUsed']; ?></td>
                                              <td><?php echo $request['cumulativeGasUsed']; ?></td>
                                              <td><?php echo $request['input']; ?></td>
                                              <td><?php echo $request['confirmations']; ?></td>
                                              <td><?php echo $request['transfer_status']; ?></td>


                                          </tr>
                                          <?php
                                      }
                                      ?>

                                  </tbody>
                              </table>
                            </div>
                          </div>
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
  </div>
    <!-- END wizard -->


</div>
</main>
 <?php //} ?>





<?php include'footer.php' ?>
