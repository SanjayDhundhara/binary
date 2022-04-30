<?php include_once'header.php'; ?>
  <div class="main-content">
    <div class="page-content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <section class="content-header">
            <span class=""><?php echo $header;?></span>
          </section>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Fund Management</li>
              <li class="breadcrumb-item active"><?php echo $header;?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
    <div>
        <div class="row">
          <div class="col-md-12 card">
            <div class="card-body">
          <div class="col-md-6">
            <?php echo form_open('',array('id' => 'walletForm'));?>
                <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
                <div class="form-group">
                    <label>User ID</label>
                    <input type="text" class="form-control" id="user_id" name="user_id"
                        value="<?php echo set_value('user_id'); ?>" placeholder="User ID"
                        style="max-width: 400px" />
                    <span class="text-danger"><?php echo form_error('user_id') ?></span>
                    <span class="text-danger" id="errorMessage"></span>
                </div>
                <div class="form-group">
                    <label>Choose Package</label>
                    <select class="form-control" name="package_id" style="max-width: 400px">
                        <?php
                        foreach($packages as $key => $package){
                            echo'<option value="'.$package['id'].'">'.$package['title'].' With '.currency.' '.$package['price'].' </option>';
                        }
                        ?>
                    </select>
                    <!-- <p>220% Returns</p> -->
                </div>

                <div class="form-group" id="SaveBtn">
                    <button type="subimt" name="save" class="btn btn-success">Activate</button>
                </div>
            <?php echo form_close();?>
          </div>
        </div>
      </div>
       </div>
      </div>
    </div>
  </div>
    </div>
<?php include_once'footer1.php'; ?>
<script>
  $(document).on('blur','#user_id',function(){
    var user_id = $(this).val();
    var url  = '<?php echo base_url("Admin/Management/get_user/")?>'+user_id;
    $.get(url,function(res){
      $('#errorMessage').html(res);
    })
  })
  $(document).on('submit','#walletForm',function(){
      if (confirm('Do you want to Send Fund on This Account?')) {
           yourformelement.submit();
       } else {
           return false;
       }
  })
</script>