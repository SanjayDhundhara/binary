<?php include'header.php' ?>
<div class="main-content">
    <div class="page-content">
        
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
             <section class="content-header">
            <span class="">Set Hub Price</span>
          </section>  
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('Admin/Management/'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Set Hub Price</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
     
    
  
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
              <!-- /.card-header -->
              <div class="card-body">
                  <h3><?php echo $this->session->flashdata('message');?></h3>
                <?php echo form_open();?>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" name="title" value="<?php echo $hub_rate['title']; ?>" class="form-control"  placeholder="Enter Title"/>
                        <label class="text-danger"><?php echo form_error('title');?></label>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" name="rate" value="<?php echo $hub_rate['hub_rate']; ?>" class="form-control"  placeholder="Current Hub Price"/>
                        <label class="text-danger"><?php echo form_error('rate');?></label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success pull-right">Update</button>
                    </div>
                <?php echo form_close();?>
              </div>
              <!-- /.card-body -->
              <!-- <iframe src="<?php //echo $task['link']?>"><iframe> -->
            </div>
            <!-- /.card -->
          </div>
           </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include'footer1.php' ?>