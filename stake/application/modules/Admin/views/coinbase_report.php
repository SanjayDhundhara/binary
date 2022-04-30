<?php include'header.php' ?>
<div class="main-content">
    <div class="page-content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <section class="content-header">
              <span class=""><?php echo $header; ?></span>
            </section>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo $header; ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
              <!-- <div class="card-header">
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="tableView">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Transation ID</th>
                            <th>User ID</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <!-- <th>Payment Method</th>
                            <th>Transaction ID</th>
                            <th>Remark</th>
                            <th>CreatedAt</th>
                            <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($btc as $key => $request) {
                          // pr($request);
                            ?>
                            <tr>
                                <td><?php echo ($key + 1) ?></td>
                                <td><?php echo $request['transaction_id']; ?></td>
                                <td><?php echo $request['first_name']; ?></td>
                                <td><?php echo $request['amountf']; ?></td>
                                <td><?php echo $request['status']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>

                    </tbody>
                </table>
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