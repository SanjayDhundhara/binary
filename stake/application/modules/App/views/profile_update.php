<?php
include_once 'header.php';
$userinfo = userinfo();
$bankinfo = bankinfo();
?>
<style>
    .profile-heading span{
      color: #000;
    }
    .profile-contact span {
        background: transparent;
        color: #000;
        border:1px #d9d9d9 solid;
    }


</style>

<div class="main-content py-5">

    <div class="page-content">
        <div class="container">
          <!-- BEGIN row -->
          <div class="row row-space-20">
              <!-- BEGIN col-8 -->
              <div class="col-md-12">
                  <!-- BEGIN tab-content -->
                  <div class="tab-content p-0">
                      <!-- BEGIN tab-pane -->
                      <div class="tab-pane  " id="REFERRAL-LINK">
                          <div class="post">
                              <div class="post-content" id="sharethis">
                                  <!-- BEGIN panel -->
                                  <div class="panel panel-default">
                                      <!-- BEGIN panel-heading -->
                                      <div class="panel-heading">
                                          <h4 class="panel-title">Deal with us via given  below link </h4>
                                          <p class="desc" id="RefLink102">
                                              <a href="<?php echo base_url('Dashboard/User/Register/?sponser_id='.$userinfo->user_id);?>" target="_blank">Click Link</a>
                                          </p>
                                      </div>
                                      <!-- END panel-heading -->
                                      <!-- BEGIN panel-body -->
                                      <div class="panel-body">
                                          <div class="row">
                                              <!--  <p><span  id="ref_clickr" style="font-size: 15px;"></span></p> -->
                                              <!----------fb-links--------------->
                                              <div class="fb-section">
                                                  <div class="addthis_toolbox addthis_default_style" addthis:url="" addthis:title="We are professionally engaged in cryptocurrencies mining and trading and have a large experience of the investment industry.&quot; /">
                                                      <div class="row">
                                                          <div class="col-sm-6 col-md-12">
                                                              <a class="addthis_button_facebook_like  at300b" fb:''like:''layout="button_count">
                                                                 <div class="fb-like fb_iframe_widget" data-layout="button_count" data-show_faces="false" data-share="false" data-action="like" data-width="90" data-height="25" data-font="arial" data-href="" data-send="false" style="height: 25px;">
                                                                      <!-- <span style="vertical-align: bottom; width: 0px; height: 0px;">
                                                                          <iframe name="f35fe8d0ab72a28" width="90px" height="25px" title="fb:like Facebook Social Plugin" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" src="./My Profile_files/like.html" class="" style="border: none; visibility: visible; width: 0px; height: 0px;"></iframe>
                                                                      </span> -->
                                                                  </div>
                                                              </a>
                                                              <a class="addthis_button_tweet at300b">
                                                                  <div class="tweet_iframe_widget" style="width: 62px; height: 25px;">
                                                                      <span>
                                                                          <!-- <iframe id="twitter-widget-0" scrolling="no" frameborder="0" allowtransparency="true" allowfullscreen="true" class="twitter-share-button twitter-share-button-rendered twitter-tweet-button" title="Twitter Tweet Button" src="./My Profile_files/tweet_button.69e02060c7c44baddf1b5629549acc0c.en.html" data-url="" style="position: static; visibility: visible; width: 1px; height: 1px;"></iframe> -->
                                                                      </span>
                                                                  </div>
                                                              </a>
                                                          </div>
                                                          <div class="col-sm-6 col-md-12 fff">
                                                              <div class="row">
                                                                  <div class="col-sm-6 col-md-12">
                                                                        <input type="text" id="linkTxt" value="<?php echo base_url('Dashboard/User/Register/?sponser_id='.$userinfo->user_id);?>" class="form-control">
                                                                        <button id="btnCopy" iconcls="icon-save" class="btncopy btn-rounded m-b-5 copy-section">
                                                                            <i class="ti-export f-s-14 pull-left m-r-5"></i>Click here to copy referral link
                                                                        </button>
                                                                  </div>
                                                                  <div class="col-sm-6 col-md-12">
                                                                      <span id="addnewuser2">
                                                                          <a href="<?php echo base_url('Dashboard/User/Register/?sponser_id='.$userinfo->user_id);?>" target="_blank">
                                                                              <i class="ti-link"></i>Add one more user
                                                                          </a>
                                                                      </span>
                                                                      <!--<a href="#" target="_blank" id="ref_click"><i class="ti-link  f-s-14 pull-left m-r-5"></i><span id="RefLink1" >Add one more user </a></span>-->
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="atclear"></div>
                                                  </div>
                                                  <!-- <script type="text/javascript" src="./MyProfile_files/addthis_widget.js"></script> -->
                                              </div>
                                              <!--<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5bb4c0eae2bd7243"></script>-->
                                              <!----------fb-links-ens--------------->
                                          </div>
                                      </div>
                                      <!-- END panel-body -->
                                  </div>
                                  <!-- end panel -->
                              </div>
                          </div>
                      </div>
                      <!-- END tab-pane -->
                      <!-- BEGIN tab-pane -->
                      <div class="row">
                       
                        
                        </div>

                        <div class="tab-pane active" id="ACCOUNT-DETAILS">
                          <div class="col-md-12 card card-body">
                          <div class="">
                            <div class="post">
                                <?php echo form_open(base_url('App/Profile/Index'),array('class' => ''));?>
                                  <div class="">
                                      <!-- <h4 class="panel-title">MY PERSONAL INFORMATION</h4> -->
                                      <?php echo $this->session->flashdata('message');?>
                                  </div>
                                  <div class="row align-items-center mb-3">
                                        <div class="col-md-4 profile-heading my-3">
                                            <span>Name</span>
                                        </div>
                                        <div class="col-md-8  profile-contact">
                                            <input type="text" class="form-control" value="<?php echo $userinfo->name;?>" name="name">
                                                <!-- <span id="txtMobileNo"></span>
                                                <span class="pull-right">
                                                    <a href="#" data-toggle="modal">
                                                        <i class="ti-pencil-alt text-primary f-s-14 pull-left m-r-10"></i> Edit
                                                    </a>
                                                </span> -->
                                        </div>
                                      </div>

                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-4 profile-heading my-3">
                                            <span>Contact Number</span>
                                        </div>
                                        <div class="col-md-8  profile-contact">
                                            <input type="number" class="form-control" value="<?php echo $userinfo->phone;?>" name="phone">
                                                <!-- <span id="txtMobileNo"></span>
                                                <span class="pull-right">
                                                    <a href="#" data-toggle="modal">
                                                        <i class="ti-pencil-alt text-primary f-s-14 pull-left m-r-10"></i> Edit
                                                    </a>
                                                </span> -->
                                        </div>
                                      </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-4 profile-heading my-3">
                                            <span>Email</span>
                                        </div>
                                        <div class="col-md-8  profile-contact">
                                            <input type="email" class="form-control" value="<?php echo $userinfo->email;?>" name="email">
                                                <!-- <span id="Emailid"><?php echo $userinfo->email;?></span>
                                                <span class="pull-right">
                                                    <a href="#" data-toggle="modal">
                                                        <i class="ti-pencil-alt text-primary f-s-14 pull-left m-r-10"></i> Edit
                                                    </a>
                                                </span> -->
                                        </div>
                                      </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-4 profile-heading my-3">
                                            <span>Country</span>
                                        </div>
                                        <div class="col-md-8  profile-contact">
                                            <select name="country" class="form-control">
                                                        <?php foreach($countries as $key => $value){
                                                            echo '<option value="'.$value['name'].'" '.($value['name'] == $userinfo->country ? 'selected' : '').'>'.$value['name'].'</option>';
                                                        }?>
                                                </select>
                                                <!-- <input type="text" class="form-control" value="<?php //echo $userinfo->city;?>" name="city"> -->
                                        </div>
                                      </div>
                                    <!-- <div class="row align-items-center mb-3">
                                        <div class="col-md-4 profile-heading my-3">
                                            <span>State</span>
                                        </div>
                                        <div class="col-md-8  profile-contact">
                                          <input type="text" class="form-control" value="<?php // echo $userinfo->state;?>" name="state">
                                                 <span id="txtCity"></span>
                                                <span class="pull-right">
                                                    <a href="#" data-toggle="modal">
                                                        <i class="ti-pencil-alt text-primary f-s-14 pull-left m-r-10"></i> Edit
                                                    </a>
                                                </span> -->
                                        <!-- </div>
                                      </div> -->
                                    <!-- <div class="row align-items-center mb-3">
                                        <div class="col-md-4 profile-heading my-3">
                                            <span>City</span>
                                        </div>
                                        <div class="col-md-8  profile-contact">
                                           <input type="text" class="form-control" value="<?php //echo $userinfo->city;?>" name="city">
                                        </div>
                                      </div> -->
                                    <!-- <div class="row align-items-center mb-3">
                                        <div class="col-md-4 profile-heading my-3">
                                            <span>Address</span>
                                        </div>
                                        <div class="col-md-8  profile-contact">
                                           <input type="text" class="form-control" value="<?php //echo $userinfo->address;?>" name="address" placeholder="Enter Address">
                                        </div>
                                      </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-4 profile-heading my-3">
                                            <span>Address 2</span>
                                        </div>
                                        <div class="col-md-8  profile-contact">
                                          <input type="text" class="form-control" value="<?php //echo $userinfo->address2;?>" name="address2" placeholder="Near/Landmark">
                                        </div>
                                      </div> -->
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-4 profile-heading my-3">
                                            <span>Registration Date</span>
                                        </div>
                                        <div class="col-md-8  profile-contact">
                                          <span id="signon" class="form-control"><?php echo $userinfo->created_at;?> </span>
                                        </div>
                                      </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-4 profile-heading my-3">
                                            <span>Activation Date</span>
                                        </div>
                                        <div class="col-md-8  profile-contact">
                                           <span id="Activeon" class="form-control"><?php echo $userinfo->topup_date;?></span>
                                        </div>
                                      </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-4 profile-heading my-3">
                                            <span>Status</span>
                                        </div>
                                        <div class="col-md-8  profile-contact">
                                            <span id="sts" class="form-control">
                                                <?php echo $userinfo->package_id > 0 ? 'Active' : 'Free';?>
                                                </span>
                                        </div>
                                      </div>
                                     
                                        <tr>
                                            <td class="field"></td><td class="value">
                                                <button class="btn btn-xs btn-primary" >Update</button>
                                            </td>
                                        </tr>

                                    </tbody>
                               
                                <?php echo form_close();?>
                            </div>
                          </div>
                        </div>

                        
                        </div>
                      <!-- END tab-pane -->
                      <!-- BEGIN tab-pane -->
                        <div class="tab-pane" id="E-CURRENCY-ACCOUNT">

                        </div>
                      <!-- END tab-pane -->
                      <!-- BEGIN tab-pane -->
                      <div class="tab-pane " id="RESET-PASSWORD">
                          <!-- BEGIN panel -->

                          <!-- end panel -->

                      </div>
                      <!-- END tab-pane -->
                      <!-- BEGIN tab-pane -->
                      <div class="tab-pane " id="KYC" style="display:none;">
                          <!-- BEGIN panel -->
                          <div class="panel panel-default">
                              <!-- BEGIN panel-heading -->
                              <div class="panel-heading">
                                  <h4 class="panel-title">KYC VERIFICATION</h4>
                              </div>
                              <!-- END panel-heading -->
                              <!-- BEGIN panel-body -->

                              <!-- END file-upload-form -->
                          </div>
                          <!-- BEGIN panel -->
                          <div class="panel panel-default" style="margin-top:20px;display:none;" id="pochanki">
                              <!-- BEGIN panel-heading -->
                              <div class="panel-heading">
                                  <h4 class="panel-title"> Identity Document (ID)</h4>
                              </div>
                              <!-- END panel-heading -->
                              <!-- BEGIN panel-body -->
                              <div class="panel-body gtdtf">
                                  <!-- BEGIN file-upload-form -->
                              </div>
                              <div class="container-fluid  ng-scope nxs nxz" id="Div2">
                                  <div class="row tyomy">
                                      <div class="col-sm-12">
                                          <div class="lead mb10">
                                              PAN CARD
                                          </div>
                                          <p>If your ID document also states your residential address, then an additional Proof of Address document may not be required.</p>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-xs-12 col-md-9 col-lg-12">
                                          <div class="panel-white panel">
                                              <div class="panel-heading">
                                                  <h4 class="color-orange" style="color:Orange;font-weight:600;">Select files to upload</h4>
                                              </div>
                                              <div class="panel-body">
                                                  <ul class="">
                                                      <li> We accept both scanned copies and mobile photos of the FRONT of your document.</li>
                                                      <li>
                                                          <span class="color-blue">Accepted formats when uploading:</span>
                                                          jpg, jpeg, gif, png, tiff, doc, docx, pdf

                                                      </li>
                                                      <li> Max. file size: 500 KB</li>
                                                  </ul>
                                                  <table class="document-verify-step2-table table form-condensed ng-pristine ng-valid" width="100%">
                                                      <tbody>
                                                          <tr>
                                                              <td colspan="6" style="BORDER:UNSET;">
                                                                  <div>
                                                                      <span class="">Select ID Proof</span>
                                                                      <div class="radio-inline m-b-3">
                                                                          <input type="radio" name="KYCTYPE" id="radio-option-1" value="PAN CARD">
                                                                          <label for="radio-option-1">PAN CARD</label>
                                                                      </div>
                                                                  </div>
                                                              </td>
                                                              <td style="BORDER:UNSET;"></td>
                                                          </tr>
                                                          <tr>
                                                              <td width="100%">
                                                                  <label class="form-control mb0  ng-pristine ng-untouched ">
                                                                      <span class="vertical-middle ng-binding">FRONT Scan/Photo of ID</span>
                                                                  </label>
                                                              </td>
                                                              <td>
                                                                  <span class="btn btn-primary fileinput-button btn-sm m-r-3 m-b-3" style="padding: 6px 16px;">
                                                                      <i class="glyphicon glyphicon-plus"></i>
                                                                      <span>Add files...</span>
                                                                      <input type="file" name="files[]" onchange="ShowImagePreview2(this);" id="IMGADDUPLOAD" multiple="">
                                                                  </span>
                                                              </td>
                                                          </tr>
                                                          <tr style="border-bottom: 1px solid #e0e0e0;">
                                                              <td>
                                                                  <input name="txtuserid" type="text" maxlength="20" id="KYCIdNo" placeholder="Enter Id Number" class="form-control input-sm">
                                                              </td>
                                                              <td>
                                                                  <a href="#" onclick="SaveKYCInfo();" class="btn btn-primary btn-sm m-r-3 m-b-3 start">
                                                                      <i class="glyphicon glyphicon-upload"></i>
                                                                      <span>Start upload</span>
                                                                  </a>
                                                              </td>
                                                          </tr>
                                                          <tr>
                                                              <td>
                                                                  <div id="DvKYCUpdate"></div>
                                                              </td>
                                                          </tr>
                                                      </tbody>
                                                  </table>
                                                  <div class="col-sm-12">
                                                      <img id="ImgAdd789" alt="Identity Document (ID)" width="80" height="80" style="display:none;">
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row document-upload-help tyomy">
                                      <div class="col-xs-12">
                                          <h5 class="neds">In order for the document to be valid it needs to meet the following requirements and contain the following information:</h5>
                                          <ul class="">
                                              <li>
                                                  <i class="icon-Verified color-salad mr10"></i>Clear, with no blurs, light reflections or shadows
                                              </li>
                                              <li>
                                                  <i class="icon-Verified color-salad mr10"></i>Full name should be visible
                                              </li>
                                              <li>
                                                  <i class="icon-Verified color-salad mr10"></i>Issue or expiry date
                                              </li>
                                              <li>
                                                  <i class="icon-Verified color-salad mr10"></i>Place and Date of Birth OR Tax Identification Number
                                              </li>
                                          </ul>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- BEGIN panel -->
                          <div class="panel panel-default" style="margin-top:20px;display:none; " id="rozhok">
                              <div class="panel-heading">
                                  <h4 class="panel-title"> Proof of Residence (POR)</h4>
                              </div>
                              <div class="panel-body gtdtf"></div>
                              <div class="container-fluid  ng-scope nxs nxz" id="Div1">
                                  <div class="row tyomy">
                                      <div class="col-sm-12">
                                          <div class="lead mb10">
                                              Aadhar Card
                                          </div>
                                          <p>If your ID document also states your residential address, then an additional Proof of Address document may not be required.</p>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-xs-12 col-md-9 col-lg-12">
                                          <div class="panel-white panel">
                                              <div class="panel-heading">
                                                  <h4 class="color-orange" style="color:Orange;font-weight:600;">Select files to upload</h4>
                                              </div>
                                              <div class="panel-body">
                                                  <ul class="">
                                                      <li> We accept both scanned copies and mobile photos of the FRONT of your document.</li>
                                                      <li>
                                                          <span class="color-blue">Accepted formats when uploading:</span>
                                                          jpg, jpeg, gif, png, tiff, doc, docx, pdf

                                                      </li>
                                                      <li> Max. file size: 500 KB</li>
                                                  </ul>
                                                  <table class="document-verify-step2-table table form-condensed ng-pristine ng-valid" width="100%">
                                                      <tbody>
                                                          <tr>
                                                              <td colspan="6" style="BORDER:UNSET;">
                                                                  <div>
                                                                      <span class="">Select ID Proof</span>
                                                                      <div class="radio-inline m-b-3">
                                                                          <input type="radio" name="KYCTYPE1" id="radio-option-4" value="Aadhar Card">
                                                                          <label for="radio-option-4">Aadhar Card</label>
                                                                      </div>
                                                                  </div>
                                                              </td>
                                                              <td style="BORDER:UNSET;"></td>
                                                          </tr>
                                                          <tr>
                                                              <td width="100%">
                                                                  <label class="form-control mb0  ng-pristine ng-untouched ">
                                                                      <span class="vertical-middle ng-binding">FRONT Scan/Photo of ID</span>
                                                                  </label>
                                                              </td>
                                                              <td>
                                                                  <span class="btn btn-primary fileinput-button btn-sm m-r-3 m-b-3" style="padding: 6px 16px;">
                                                                      <i class="glyphicon glyphicon-plus"></i>
                                                                      <span>Add files...</span>
                                                                      <input type="file" name="files[]" onchange="ShowImagePreview98(this);" id="IMGADDUPLOAD1">
                                                                  </span>
                                                              </td>
                                                          </tr>
                                                          <tr style="border-bottom: 1px solid #e0e0e0;">
                                                              <td>
                                                                  <input name="txtuserid" type="text" maxlength="20" id="KYCIdNo1" placeholder="Enter Id Number" class="form-control input-sm">
                                                              </td>
                                                              <td>
                                                                  <a href="#" onclick="SavePorInfo();" class="btn btn-primary btn-sm m-r-3 m-b-3 start">
                                                                      <i class="glyphicon glyphicon-upload"></i>
                                                                      <span>Start upload</span>
                                                                  </a>
                                                              </td>
                                                          </tr>
                                                          <tr>
                                                              <td>
                                                                  <div id="DvKYCUpdate1"></div>
                                                              </td>
                                                          </tr>
                                                      </tbody>
                                                  </table>
                                                  <div class="col-sm-12">
                                                      <img id="ImgAdd78985" alt="Identity Document (ID)" width="80" height="80" style="display:none;">
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row document-upload-help tyomy">
                                      <div class="col-xs-12">
                                          <h5 class="neds">In order for the document to be valid it needs to meet the following requirements and contain the following information:</h5>
                                          <ul class="">
                                              <li>
                                                  <i class="icon-Verified color-salad mr10"></i>Clear, with no blurs, light reflections or shadows
                                              </li>
                                              <li>
                                                  <i class="icon-Verified color-salad mr10"></i>Full name should be visible
                                              </li>
                                              <li>
                                                  <i class="icon-Verified color-salad mr10"></i>Issue or expiry date
                                              </li>
                                              <li>
                                                  <i class="icon-Verified color-salad mr10"></i>Place and Date of Birth OR Tax Identification Number
                                              </li>
                                          </ul>
                                      </div>
                                  </div>
                              </div>
                              <!-- END file-upload-form -->
                          </div>
                          <!-- BEGIN panel3 -->
                          <div class="panel panel-default" style="margin-top:20px;display:none;" id="ruins">
                              <!-- BEGIN panel-heading -->
                              <div class="panel-heading">
                                  <h4 class="panel-title">  Bank Account Proof</h4>
                              </div>
                              <!-- END panel-heading -->
                              <!-- BEGIN panel-body -->
                              <div class="panel-body gtdtf">
                                  <!-- BEGIN file-upload-form -->
                              </div>
                              <div class="container-fluid  ng-scope nxs nxz" id="Div3">
                                  <div class="row tyomy">
                                      <div class="col-sm-12">
                                          <div class="lead mb10">
                                              Cheque or Passbook
                                          </div>
                                          <p>If you already submited your bank account proof, then an additional Bank account proof may not be required.</p>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-xs-12 col-md-9 col-lg-12">
                                          <div class="panel-white panel">
                                              <div class="panel-heading">
                                                  <h4 class="color-orange" style="color:Orange;font-weight:600;">Select files to upload</h4>
                                              </div>
                                              <div class="panel-body">
                                                  <ul class="">
                                                      <li> We accept both scanned copies and mobile photos of the FRONT of your document.</li>
                                                      <li>
                                                          <span class="color-blue">Accepted formats when uploading:</span>
                                                          jpg, jpeg, gif, png, tiff, doc, docx, pdf

                                                      </li>
                                                      <li> Max. file size: 500 KB</li>
                                                  </ul>
                                                  <table class="document-verify-step2-table table form-condensed ng-pristine ng-valid" width="100%">
                                                      <tbody>
                                                          <tr>
                                                              <td colspan="6" style="BORDER:UNSET;">
                                                                  <div>
                                                                      <span class="">Select ID Proof</span>
                                                                      <div class="radio-inline m-b-3">
                                                                          <span>
                                                                              <input type="radio" name="BANKPROF2" id="radio-option-9" value="Cancel Cheque">
                                                                              <label for="radio-option-9">Cancel Cheque</label>
                                                                          </span>
                                                                          <span class="bcmp">
                                                                              <input type="radio" name="BANKPROF2" id="radio-option-10" value="Bank Passbook">
                                                                              <label for="radio-option-10">Bank Passbook</label>
                                                                          </span>
                                                                      </div>
                                                                  </div>
                                                              </td>
                                                              <td style="BORDER:UNSET;"></td>
                                                          </tr>
                                                          <tr>
                                                              <td width="100%">
                                                                  <label class="form-control mb0  ng-pristine ng-untouched ">
                                                                      <span class="vertical-middle ng-binding">FRONT Scan/Photo of ID</span>
                                                                  </label>
                                                              </td>
                                                              <td>
                                                                  <span class="btn btn-primary fileinput-button btn-sm m-r-3 m-b-3" style="padding: 6px 16px;">
                                                                      <i class="glyphicon glyphicon-plus"></i>
                                                                      <span>Add files...</span>
                                                                      <input type="file" name="files[]" id="IMGADDUPLOAD5" onchange="ShowImagePreview9889(this);" multiple="">
                                                                  </span>
                                                              </td>
                                                          </tr>
                                                          <tr style="border-bottom: 1px solid #e0e0e0;">
                                                              <td>
                                                                  <input name="txtaccountnumber" type="text" maxlength="20" id="bankidNo2" placeholder="Enter Account Number" class="form-control input-sm">
                                                              </td>
                                                              <td>
                                                                  <a href="#" onclick="SavePorInfo6();" class="btn btn-primary btn-sm m-r-3 m-b-3 start">
                                                                      <i class="glyphicon glyphicon-upload"></i>
                                                                      <span>Start upload</span>
                                                                  </a>
                                                              </td>
                                                          </tr>
                                                          <tr>
                                                              <td>
                                                                  <div id="DvKYCUpdate56"></div>
                                                              </td>
                                                          </tr>
                                                      </tbody>
                                                  </table>
                                                  <div class="col-sm-12">
                                                      <img id="ImgAdd7898558" alt="Bank account proof" width="80" height="80" style="display:none;">
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row document-upload-help tyomy">
                                      <div class="col-xs-12">
                                          <h5 class="neds">In order for the document to be valid it needs to meet the following requirements and contain the following information:</h5>
                                          <ul class="">
                                              <li>
                                                  <i class="icon-Verified color-salad mr10"></i>Clear, with no blurs, light reflections or shadows
                                              </li>
                                              <li>
                                                  <i class="icon-Verified color-salad mr10"></i>Full name should be visible
                                              </li>
                                              <li>
                                                  <i class="icon-Verified color-salad mr10"></i>Issue or expiry date
                                              </li>
                                              <li>
                                                  <i class="icon-Verified color-salad mr10"></i>Place and Date of Birth OR Tax Identification Number
                                              </li>
                                          </ul>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- BEGIN pane3 -->
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
