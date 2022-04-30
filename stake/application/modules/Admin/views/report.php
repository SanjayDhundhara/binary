<?php $this->load->view('header'); ?>
<div class="main-content page-content">
   <div class="container-fluid">
    <h2 class="page-titel">
        <spna style=""><?php echo $header; ?> </span> 
    </h2>
     <div class="tab-pane active show">
         <div class="card-header">
          <form method="GET" action="<?php  echo $path;?>">
             <div class="row ">
                  </div>
              <div class="row">
                      <?php echo $field;?>
              </div>
          </form>
      </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <?php echo $thead; ?>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($tbody as $key => $value) {
                            echo $value;
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </div>
</div>
</div>
<?php $this->load->view('footer');?>
