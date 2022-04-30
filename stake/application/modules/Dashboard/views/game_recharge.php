<?php
    include_once 'header.php';
    date_default_timezone_set('Asia/Kolkata');
?>

<div class="container-fluid pt-5">
  <div class="page-content">
<div class="container">
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
  <div class="panel-heading">
        <span style=""><?php echo $title; ?> /   Join Game</span>
    </div>

    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <div class="card">
          <div class="card-body">
    
    <div id="rootwizard" class="wizard-full-width border-0">
        <!-- BEGIN wizard-header -->

        <!-- END wizard-header -->
        <!-- BEGIN wizard-form -->

            <div class="wizard-content tab-content p-0">
                <!-- BEGIN tab-pane -->
                <div class="tab-pane active show" id="tabFundRequestForm">
                    <!-- BEGIN row -->
                    <div class="row">
                        <!-- BEGIN col-6 -->
                        <div class="col-md-6">

                            <?php ?>
                            <?php echo $this->session->flashdata('message'); 

                            //echo $this->session->flashdata('success');

                            // if(empty($game)){

                                echo form_open('',array('id' => 'TopUpForm'));
                            ?>


                            <div class="form-group">
                                <label>User Id</label>
                                <input type="text" class="form-control" name="user_id" id="user_id" placeholder="Enter User Id" value="<?php echo $game['loggin_id']; ?>" required="true"/>
                                <span class="text-danger"><?php echo form_error('user_id')?></span>
                            </div>
                            
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter Amount" value="" required="true"/>
                                <span class="text-danger"><?php echo form_error('amount')?></span>
                            </div>

                            
                           
                            <div class="form-group">
                                <button type="subimt" name="save" class="btn btn-success" />Submit</button>
                                
                            </div>
                            <?php echo form_close();

                            // }else{
                            //     if(!empty($this->session->flashdata('success'))){
                            //         echo 'User Already Registered!';
                            //     }
                            // }

                            ?>

                        </div>
                        <!-- END col-6 -->
                    </div>
                    <!-- END row -->
                </div>
                <!-- END tab-pane -->
                <!-- BEGIN tab-pane -->

            </div>
            <!-- END wizard-content -->

        <!-- END wizard-form -->
    </div>
  </div>
    <!-- END wizard -->
</div>
</div>
</div>
</div>

<?php include_once'footer.php'; ?>
<script>
    $(document).on('blur','#user_id',function(){
        var user_id = $('#user_id').val();
        if(user_id != ''){
            var url  = '<?php echo base_url("Dashboard/get_app_user/")?>'+user_id;
            $.get(url,function(res){
                if(res.success == 1){
                    $('#errorMessage').html(res.user.name);
                }else{
                    $('#errorMessage').html(res.message);
                }

            },'json')
        }
    })
    $(document).on('submit','#TopUpForm',function(){
        if (confirm('Are You Sure U want to Withdraw This Account')) {
            yourformelement.submit();
        } else {
            return false;
        }
    })
    $(document).on('blur','#amount',function(){
      var amount = $(this).val();
    //   var netAmount = amount * 90 /100;
    //   $('#netAmount').text(netAmount);
    })
    function calculate_net_amount(){
        var amount = $('#amount').val();
        var bankAmount;
        var tds = 0;
        var transfer_wallet = $("input[name='pin_transfer']:checked").val();
        console.log(transfer_wallet);
        if(transfer_wallet == 0){
            bankAmount = amount * 90 /100;
            // tds = amount * 5 /100;
        }else{
            bankAmount = amount * 90 /100;
            // tds = amount * 5 /100;
        }

        var NetbankAmount = (bankAmount);
        $('#netAmount').text(NetbankAmount);
         $('#NetbankAmount').text(NetbankAmount);
        $('#bankAmount').text(bankAmount);
        $('#tds').text(tds);
    }


     function total_hub(evt) {
                    const total_hub = evt.value;
                    if(total_hub > 0){

                        fetch("<?php echo base_url('Admin/Settings/getHubRate/'); ?>"+total_hub, {
                           method: "GET",
                           headers: {
                             "X-Requested-With": "XMLHttpRequest"
                           },
                           // body: formData,
                       })
                       .then(response => response.json())
                       .then(result => {
                           if(result.success == '1'){
                                // document.getElementById('total_hub').innerHTML = 'Total Hub: '+result.message;
                                document.getElementById('usd_amount').innerHTML = 'Net Byeol You Will Recieve: '+total_hub/<?php echo $tokenValue['amount'];?>;
                           }else{
                              document.getElementById('total_hub').innerHTML = 'Please enter vaild amount!';
                           }
                        });
                    }else{
                      document.getElementById('total_hub').innerHTML = 'Invaild Package Amount!';
                   }
                }

</script>
