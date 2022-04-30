<?php include'header.php' ?>
  <div class="main-content">
      <div class="page-content">
         <div class="container-fluid">
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
                    <li class="breadcrumb-item"><?php echo $header;?></li>
                    <li class="breadcrumb-item active"><?php echo $header;?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->


            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                    <h4 class="kt-portlet__head-title"><?php echo $this->session->flashdata('message');?></h4>
                    <?php echo form_open(); ?>
                    <div class="kt-portlet__body">
                        <div class="kt-section kt-section--first">
                            <div class="kt-section__body">
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">User ID</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <?php echo form_input(array('type' => 'text', 'class' => 'form-control','name' =>'user_id')); ?>
                                        <label class="text-danger"><?php echo form_error('user_id');?></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Points</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <?php echo form_input(array('type' => 'text', 'class' => 'form-control','name' =>'amount')); ?>
                                        <label class="text-danger"><?php echo form_error('amount');?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-3 col-xl-3">
                                </div>
                                <div class="col-lg-9 col-xl-9">
                                    <?php
                                     echo form_input(array('type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Approve', 'name' => 'status'));
                                    ?>
                                </div>
                            </div>
                             </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<?php include'footer.php' ?>
