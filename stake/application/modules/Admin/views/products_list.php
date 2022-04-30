<?php include'header.php' ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Paid users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                            <a href="<?php echo base_url('Admin/Package/CreateProduct');?>" class="btn btn-success btn-icon-sm">
                                <i class="la la-add"></i> Create New
                            </a>    
                    </div>
                    <?php echo $this->session->flashdata('message');?>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>BV</th>
                            <th>MRP</th>
                            <th>DP</th>
                            <th>IGST</th>
                            <th>SGST</th>
                            <th>CreatedAt</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($products as $key => $product) {
                            ?>
                            <tr>
                                <td><?php echo ($key + 1)?></td>
                                <td><?php echo $product['title'];?></td>
                                <td><?php echo $product['bv'];?></td>
                                <td>$<?php echo $product['mrp'];?></td>
                                <td>$<?php echo $product['dp'];?></td>
                                <td>$<?php echo $product['igst'];?></td>
                                <td>$<?php echo $product['sgst'];?></td>
                                <td><?php echo $product['created_at'];?></td>
                                <td><a href="<?php echo base_url('Admin/package/EditProduct/'.$product['id']);?>">Edit</a> |
                                    <a href="<?php echo base_url('Admin/package/DeleteProduct/'.$product['id']);?>"  onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
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
<?php include'footer1.php' ?>