<?php
include_once 'header.php';
$userinfo = userinfo();
$bankinfo = bankinfo();
?>


<div class="main-content py-5">

    <div class="page-content">
        <div class="container">
          <!-- BEGIN row -->
          <div class="row row-space-20">
              <!-- BEGIN col-8 -->
              <div class="col-md-12">
                  <!-- BEGIN tab-content -->
                  <div class="tab-content p-0">                      <!-- END tab-pane -->
                      <!-- BEGIN tab-pane -->
                      <div class="row">
                       
                        <div class="col-md-12 mb-4">
                          <div class="card card-body">
                             <div class="panel-heading">
                          <h4 class="panel-title">News</h4>
                        </div>
                            <div class="col-xs-12 col-md-9 col-lg-12">
                                <div class="panel-white panel">
                                  

                                    <div class="panel-body">
                                    <table class="table table-layout-fixed uploaded-docs-table" width="100%">
                                        <tbody>
                                            <tr>
                                                <td class="uploaded-docs-table-status">
                                                    <div class="profile-img" id="ImgID">
                                                        <p><?php echo $news['news'];?></p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                          </div>
                        </div>
                        </div>
                  </div>
                  <!-- END panel-body -->
                  <!-- end panel -->
              </div>
              <!-- BEGIN col-4 -->

              <!-- END col-4 -->
          </div>
          <!-- END col-8 -->
      </div>
      <!-- END row -->
  </div>


    </div>

<?php include_once 'footer.php'; ?>
