<?php include'header.php' ?>
 <div class="main-content">
    <div class="page-content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <section class="content-header">
            <span class="">ZIL Withdraw Request </span>
          </section>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">ZIL Withdraw Request</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="tableView">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Remark</th>
                            <th>Request Date</th>
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
                                <td><?php
                                if ($request['status'] == 0)
                                    echo'<span class ="badge badge-info">Pending</sapn>';
                                elseif ($request['status'] == 1)
                                    echo'<span class ="badge badge-success">Approved</span>';
                                elseif ($request['status'] == 2)
                                    echo '<span class ="badge badge-danger">Rejected</span>';
                                ?></td>
                                <td><?php echo $request['remark']; ?></td>
                                <td><?php echo $request['created_at']; ?></td>
                                  <?php if($request['status'] == 0){ ?>
                                <td><a class ="btn btn-success" href="<?php echo base_url('Admin/Withdraw/Zilapprove/'.$request['id']) ?>" >Approve</a> /
                                <a class ="btn btn-danger" href="<?php echo base_url('Admin/Withdraw/Zilreject/'.$request['id']) ?>" >Reject</a></td>
                                <?php }  ?>
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
