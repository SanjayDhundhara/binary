<?php include'header.php' ?>

<div class="content-body">
   <div class="container-fluid">
    <h2 class="page-titel">
        <spna style="">Game / <?php echo $title; ?>  <?php echo $total_income['total_income'];?></span> 
    </h2>
     <div class="tab-pane active show">
         <div class="card-header">
          
      </div>
                    <div class="row">
                       <div class="col-md-12">
                <table class="table table-bordered table-striped dataTable">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>User ID</th>
                                      <th>Amount</th>
                                      <th>Token</th>
                                      <th>Credit Date</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                  foreach ($games as $key => $income) {
                                      ?>
                                      <tr>
                                          <td><?php echo ($key + 1) ?></td>
                                          <td><?php echo $income['user_id']; ?></td>
                                          <td><?php echo $income['amount'] > 0 ? '<span class="text-success"> ' .$income['amount'] . '</span>' : '<span class="text-danger"> ' .$income['amount'] . '</span>'; ?></td>
                                          <td><?php echo  ($income['token']); ?></td>
                                          <td><?php echo $income['created_at']; ?></td>
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
