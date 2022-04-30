<?php include'header.php' ?>
<div class="main-content">
    <div class="page-content">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $header; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo $header; ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->


      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <form method="GET" action="<?php echo base_url('Admin/Management/secondPoolUsers/'.$type);?>">
                <div class="row">
                    <div class="col-3">
                      <select class="form-control" name="type">
                        <option value="user_id" <?php echo $type == 'user_id' ? 'selected' : '';?>>User ID</option>
                      </select>
                    </div>
                    <div class="col-3">
                      <input type="text" name="value" class="form-control float-right" value="<?php echo $value;?>" placeholder="Search">
                    </div>
                    
                    <div class="col-3">
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            <!-- </div> -->
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Upline ID</th>
                            <?php for ($i1=1; $i1 <=1 ; $i1++) { 
                               echo '<th>Level '.$i1.'</th>';
                            }
                            ?>
                            <th>Created At</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i = ($segament) + 1;
                        foreach ($users as $key => $user) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $user['user_id']; ?></td>
                                <td><?php echo $user['name']['name']; ?></td>
                                 <td><?php echo $user['upline_id']; ?></td>
                                 <?php for ($i1=1; $i1 <=1 ; $i1++) { 
                               echo '<td>'.$user['level'.$i1].'</td>';
                            }
                            ?>
                                
                                <td><?php echo $user['created_at']; ?></td>
                               
                                  
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>

                    </tbody>
                </table>
                <div class="row">
                  <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info" id="tableView_info" role="status" aria-live="polite">Showing <?php echo ($segament + 1) .' to  '.$i;?> of <?php echo $total_records;?> entries</div>
                  </div>
                  <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="tableView_paginate">
                      <?php
                        echo $this->pagination->create_links();
                        ?>
                    </div>
                  </div>
                </div>
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
<script>
$(document).on('click','.blockUser',function(){
  var status = $(this).data('status');
  var user_id = $(this).data('user_id');
  var url = "<?php echo base_url('Admin/Management/blockStatus/');?>"+user_id + '/' + status;
  $.get(url,function(res){
    alert(res.message)
    if(res.success == 1)
      location.reload()
  },'json')
})
</script>