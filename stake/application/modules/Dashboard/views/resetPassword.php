<?php
include_once 'header.php';
$userinfo = userinfo();
$bankinfo = bankinfo();
?>

<div class="container-fluid pt-4">

    <div class="page-content">
        <div class="container">
          <!-- BEGIN row -->
          <div class="row row-space-20">
              <!-- BEGIN col-8 -->
              <div class="col-md-12">
                  <!-- BEGIN tab-content -->
                  <div class="tab-content p-0">
                      <!-- BEGIN tab-pane -->
                      
                      <!-- END tab-pane -->
                      <!-- BEGIN tab-pane -->
                      


                        <div class="col-md-12 ">
                           <div class="panel-heading">
                                    <span>Change Password</span>
                                    <?php echo $this->session->flashdata('password_message');?>
                                </div>
                          <div class="card card-body">
                            <div class="panel panel-default">
                               
                                <div class="panel-body">
                                    <p class="desc"></p>
                                        <?php echo form_open(base_url('Dashboard/Profile/passwordReset'),array(''));?>
                                        <div class="form-group">
                                            <label for="txtoldpass">Old Password</label>
                                            <input type="password" class="form-control" name="cpassword" maxlength="20" placeholder="Enter Your Old Password" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="txtnewpass">New Password</label>
                                            <input type="password" class="form-control" name="npassword" maxlength="20" required="" placeholder="Enter Your New Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="txtnewpass">Confirm New Password</label>
                                            <input type="password" class="form-control"  name="vpassword" maxlength="20" required="" placeholder="Re-Enter Your New Password">
                                        </div>
                                        <div id="SLgPWD"></div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        <?php echo form_close();?>
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
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).on('click','#btnCopy',function(){
        //linkTxt
        var copyText = document.getElementById("linkTxt");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /*For mobile devices*/
        /* Copy the text inside the text field */
        document.execCommand("copy");
        /* Alert the copied text */
        alert("Link Copied : " + copyText.value);
    })
    $("form.proofForm").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var url = $(this).attr('action');
        var t = $(this);
        t.find('.loader').css('display','block');
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success: function (data) {
                var res = JSON.parse(data)
                alert(res.message);
                $("form.proofForm").append('<input type="hidden" name="'+res.csrfName+'" value="'+res.csrfHash+'" style="display:none;">')
                $("form.pswrdrst").append('<input type="hidden" name="'+res.csrfName+'" value="'+res.csrfHash+'" style="display:none;">')
                $("form#bankform").append('<input type="hidden" name="'+res.csrfName+'" value="'+res.csrfHash+'" style="display:none;">')
                t.find('.loader').css('display','none');
                if(res.success == 1){
                    t.find('.verification-img img').attr('src',res.image)
                    t.find('span.wanki').remove();
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
    $("#bankform").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var url = $(this).attr('action');
        var t = $(this);
        t.find('.loader').css('display','block');
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success: function (data) {
                var res = JSON.parse(data)
                alert(res.message);
                $("form.proofForm").append('<input type="hidden" name="'+res.csrfName+'" value="'+res.csrfHash+'" style="display:none;">')
                $("form.pswrdrst").append('<input type="hidden" name="'+res.csrfName+'" value="'+res.csrfHash+'" style="display:none;">')
                $("form#bankform").append('<input type="hidden" name="'+res.csrfName+'" value="'+res.csrfHash+'" style="display:none;">')
                t.find('.loader').css('display','none');
                if(res.success == 1){
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
    $(document).on('submit','.pswrdrst',function(e){
        e.preventDefault();
        var formData = new FormData(this);
        var url = $(this).attr('action');
        var formData = $(this).serialize();
        $.post(url,formData,function(res){
            alert(res.message);
            $("form.proofForm").append('<input type="hidden" name="'+res.csrfName+'" value="'+res.csrfHash+'" style="display:none;">')
            $("form.pswrdrst").append('<input type="hidden" name="'+res.csrfName+'" value="'+res.csrfHash+'" style="display:none;">')
            $("form#bankform").append('<input type="hidden" name="'+res.csrfName+'" value="'+res.csrfHash+'" style="display:none;">')
            // if(res.success == 1){
            //     document.getElementById("pswrdrst").reset();
            // }
        },'json')
    })

$.get('<?php echo base_url("Assets/banks.json")?>',function(res){
    var html = '<option value="">Choose your bank</option>';
    var bank_name = '<?php echo $user_bank->bank_name;?>';
    $.each(res,function(key,value){
        html += '<option value="'+value+'" '+( value == bank_name ? 'selected' : '')+'>'+key+'</option>';
    })
    $("#txtBakName").html(html);
},'json')

$(document).on('change','#bnktoggle',function(){
    $('#bankform').toggle();
    $('#btcForm').toggle();
})
</script>
