<?php include'header.php' ?>
 <div class="main-content">
    <div class="page-content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <section class="content-header">
            <span class="">Withdraw Request  </span>
          </section>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Withdraw Request </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
            
             
                 <?php echo form_open('', array('id' => 'withDrawPayments')); ?>

                <?php echo form_close() ?>

                <table class="table table-hover" id="tableView">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Amount</th>
                            <th>Deductions</th>
                            <th>Payable Amount</th>
                            <th>USDT</th>
                            <th>Type</th>
                            <th>Wallet Address </th>
                            <th>Status</th>
                            <th>Bank Name</th>
                            <th>Bank Account Number</th>
                            <th>Account Holder Name</th>
                            <th>Ifsc Code</th>
                            <th>Remark</th>
                            <th>Request Date</th>
                            <th>Credit IN</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($requests as $key => $request) {
    //                        pr($request);
                            ?>
                            <tr>
                                <td><?php echo ($key + 1) ?></td>
                                <td><?php echo $request['user_id']; ?></td>
                                <td><?php echo $request['user']['name']; ?></td>
                                <td><?php echo $request['user']['phone']; ?></td>
                                <td><?php echo $request['amount']; ?></td>
                                <td><?php echo $request['tds'] + $request['admin_charges']; ?></td>
                                <td><?php echo $request['payable_amount']; ?></td>
                                <td><?php echo $request['fund_conversion']; ?></td>
                                <td><?php echo ucwords(str_replace('_', ' ', $request['type'])); ?></td>
                                <td><?php echo $request['zil_address']; ?></td>
                                <td>
                                  <?php
                                    $dataForPaying = json_encode($request,true);
                                    if ($request['status'] == 0):
                                        echo"<button   class='btn btn-danger' data='".$dataForPaying."'><i class='fas fa-bolt' aria-hidden='true'> Pending</button>"; 
                                    elseif ($request['status'] == 1):
                                        echo"<button class='btn btn-success'><i class='fas fa-bolt' aria-hidden='true'> Approved</button>";
                                    elseif ($request['status'] == 2):
                                        echo 'Rejected';
                                    endif;
                                  ?>
                                </td>
                                <td>
                                  <?php
                                   echo $request['bank']['bank_name'];
                                    // if($request['credit_type'] == 'Bank'){
                                    //   echo 'Bank Name :'. $request['bank']['bank_name'].'<br>';
                                    //   echo 'Bank Account Number :'. $request['bank']['bank_account_number'].'<br>';
                                    //   echo 'Account Holder Name :'. $request['bank']['account_holder_name'].'<br>';
                                    //   echo 'Ifsc Code :'. $request['bank']['ifsc_code'].'<br>';
                                    // } else {
                                    //   echo $request['zil_address'];
                                    // } 
                                  ?>
                                </td>
                                <td><?php echo $request['bank']['bank_account_number'];?></td>
                                <td><?php echo $request['bank']['account_holder_name'];?></td>
                                <td><?php echo $request['bank']['ifsc_code'];?></td>
                                <td><?php echo $request['remark']; ?></td>
                                <td><?php echo $request['created_at']; ?></td>
                                <td><?php echo $request['credit_type']; ?></td>
                                <td><a href="<?php echo base_url('Admin/Withdraw/request/' . $request['id']); ?>" target="_blank">View</a></td>
                            </tr>
                            <?php
                        }
                        ?>

                    </tbody>
                </table>
                <?php
                echo $this->pagination->create_links();
                ?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
            </div>
        </div>
      </div>
    </div>
    </div>
<?php include'footer1.php' ?>

    <!----------------------->
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/binance/web3.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/web3modal@1.9.0/dist/index.js"></script>
    <script type="text/javascript" src="https://unpkg.com/evm-chains@0.2.0/dist/umd/index.min.js"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/binance/bn.js"></script>
	  <script src="//cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/binance/withdraw.js"></script> -->
    <!----------------------->

