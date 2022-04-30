<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title><?php echo title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo-mini.png') ?>">

        <!-- Bootstrap Css -->
        <link href="<?php echo base_url('NewDashboard/') ?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?php echo base_url('NewDashboard/') ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?php echo base_url('NewDashboard/') ?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <script src='https://www.google.com/recaptcha/api.js'></script>

         <style>
		    body{
	        	background:#01667f;
	        	background-size: cover;
	        	background-position: center;
	            overflow-x: hidden;
	        }
	         .card-wrapper {
            max-width: 500px;
            width: 100%;
        }

        .top-head {
            border-radius: 50px 50px 0px 0px;
        }
        .login-top-heading{
            text-transform: uppercase;
            color: #fff;
            font-weight: bold;
            font-size: 20px;
            display: inline-block;
        }
		    /*.bg-black{
		        background-color:#3b3363;
		        padding: 21px 0 0px;
		    }*/
		    .form-control {
			    padding: 7px 20px;
			    font-size: 17px;
			    border-radius: 15px;
			    box-shadow: 0px 0px 10px rgb(230 230 230);
			    border: 0px;
			}
			.form-control:focus{
				box-shadow: 0px 0px 10px rgb(230 230 230);
			}
		    .form-group{
		    	margin-bottom: 0px;
		    }
		    .submit-btn {
			    font-size: 18px;
			    background: linear-gradient(to right, #da8cff, #9a55ff) !important;
			    border: 0px;
			}
			.otp-btn {
			    background:#05647d!important;
			    border: 0px;
			    font-size: 18px;
			}
   			a.back-to-home {
	            color: #fff;
	            padding: 0 20px;
	            font-size: 21px;
	        }
			input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
   @media screen and (max-width: 767px){
           .card{
             margin-bottom:0px;
           }
           .card-wrapper{
                max-width: 100%;
                width: 100%;
           }

        }
    </style>

    </head>

    <body>

        <!-- <div class="home-btn d-none d-sm-block">
            <a href="index-2.html" class="text-dark"><i class="fas fa-home h2"></i></a>
        </div> -->
        <div class="account-pages pt-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="card-wrapper">
                    	 <a href="https://zilgrow.io/app/" class="back-to-home"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                    	  <div class="text-center top-head-logo">
                    	  	   <a href="https://zilgrow.io/app/" class="logo logo-admin">
                            <img src="<?php echo base_url('uploads/'); ?>logo.png" style="max-width: 200px;background: #01667f;margin: 0;border-radius: 10px;" alt="logo">
                        </a>
                    	  </div>
                    	   <div class="bg-black">
                            <div class="text-primary text-center">
                                <h5 class="my-3 login-top-heading" style="">Register</h5>
                               <!--  <p class="text-white">Get your free <?php echo title;?> account now.</p>-->
                            </div>
                        </div>
                        <div class="card overflow-hidden top-head">

                            <div class="card-body p-2">
                                <div class="p-3">
                                    <div class="form-element">
							<!-- <h5><?php //echo title;   ?></h5> -->
							<span class="text-danger"><?php echo $this->session->flashdata('error'); ?></span>
							<!-- <div class="form-group has-feedback text-danger mb-2">Do you have Sponsor ID
								<input type="radio" onclick="docload('yes')" id="yes"> Yes
								<input type="radio" onclick="docload('no')" id="no"> No
							</div> -->
							<?php echo form_open('App/User/Register?sponser_id=' . $sponser_id, array('id' => 'RegisterForm')); ?>
							<div class="form-group has-feedback">
								<input type="text" class="form-control" id="sponser_id" placeholder="Sponser ID" value="<?php echo $sponser_id; ?>" name="sponser_id" required>
								<span class="ion ion-locked form-control-feedback "></span>
								<span class="text-danger"><?php echo form_error('sponser_id'); ?></span>
								<span id="errorMessage" class="text-danger"> </span>
							</div>
							<div class="form-group has-feedback">

							<div class="form-field">
								<label></label>
							<input type="text" class="form-control" placeholder="Enter User ID" name="user_id" value="<?php echo set_value('user_id'); ?>" required>
							<span class="ion ion-locked form-control-feedback "></span>
							</div>
							<span class="text-danger"> <?php echo form_error('user_id'); ?></span>
							</div>
							<div class="form-group has-feedback">

										<div class="form-field">
											<label></label>
									<input type="text" class="form-control" placeholder="Enter Name" name="name" value="<?php echo set_value('name'); ?>" required>
									<span class="ion ion-locked form-control-feedback "></span>
								</div>
									<span class="text-danger"> <?php echo form_error('name'); ?></span>
							</div>
							<div class="form-group has-feedback">
									<div class="row">
										<div class="col-md-12 col-xs-12">
											<div class="form-field">
												<label></label>
												<input type="phone" id = "phone" class="form-control"  placeholder="Enter Phone" name="phone" value="<?php echo set_value('phone'); ?>" required>
											<span class="ion ion-locked form-control-feedback "></span>
										</div></div>
									<span class="text-danger"> <?php echo form_error('phone'); ?></span>
								</div>
							</div>
							<div class="form-group has-feedback">
								<div class="row">
										<div class="col-md-8 col-sm-8">
											<div class="form-field">
												<label></label>
												<input type="text" class="form-control" id="confirm_email" placeholder="Enter Email" name="email" value="<?php echo set_value('email'); ?>">
												<span class="ion ion-locked form-control-feedback "></span>
											</div>
												<span class="text-danger"> <?php echo form_error('email'); ?></span>
										</div>
										<div class="col-md-4 col-sm-4">
		                                       <button type="button" onclick="sendEmailOtp()" class="btn btn-primary rounded border-0 mt-12" style="background:#03657e; min-width: 100% ; margin-top: 0px;">Send OTP</button>
		                                </div>
		                            </div>
							</div>
							<div class="form-group has-feedback">
										<div class="form-field">
											<label></label>
									<input type="number" class="form-control" placeholder="Enter OTP" name="otp" value="<?php echo set_value('otp'); ?>">
									<span class="ion ion-locked form-control-feedback "></span>
								</div>
									<span class="text-danger"> <?php echo form_error('otp'); ?></span>
							</div>

							<div class="form-group has-feedback">
										<div class="form-field">
											<label></label>
									<input type="number" class="form-control" placeholder="Enter Tnx Pin" name="master_key" value="<?php echo set_value('master_key'); ?>">
									<span class="ion ion-locked form-control-feedback "></span>
								</div>
									<span class="text-danger"> <?php echo form_error('master_key'); ?></span>
							</div>
							<div class="form-group has-feedback">
										<div class="form-field">
											<label></label>
									<input type="password" class="form-control" placeholder="Enter Password" name="password" value="<?php echo set_value('password'); ?>">
									<span class="ion ion-locked form-control-feedback "></span>
								</div>
									<span class="text-danger"> <?php echo form_error('password'); ?></span>
							</div>
							<div class="form-group has-feedback">
										<div class="form-field form-control">
											<!-- Material inline 1 -->
											<div class="form-check form-check-inline">
											  <input type="radio" class="form-check-input" id="materialInline1" name="Lposition" value = "L">
											  <label class="form-check-label" for="materialInline1">Left</label>
											</div>

											<!-- Material inline 2 -->
											<div class="form-check form-check-inline">
											  <input type="radio" class="form-check-input" id="materialInline2" name="Lposition"  value = "R">
											  <label class="form-check-label" for="materialInline2">Right</label>
											</div>
										</div>
							</div>
						<!-- 	<div class="form-group has-feedback mt-4">
										<div class="form-field">
											<div class="row">
												<div class="col-7">
													<div class="generate-otp">
														<input type="number" name="" placeholder="OTP" class="form-control">
													</div>
												</div>
												<div class="col-5">
													<button class="btn btn-primary w-100 otp-btn">Generate OTP</button>
												</div>
											</div>
										</div>
							</div> -->
							<!-- <div class="form-group has-feedback mt-4 d-none">
									<label for="pwd">Position:</label>
										<div class="form-field">
									<select class="form-control" name="position">
											<?php//if($_GET['position'] == 'R'){ ?>
												<option value="R">RIGHT</option>
											<?php //}else if($_GET['position'] == 'L'){?>
												<option value="L">LEFT</option>
											<?php //}
                      // else {
                        	// echo '<option value="L" selected>LEFT</option>
                          	// <option value="R">RIGHT</option>';
                      // } ?>
									</select>
								</div>
							</div> -->
							<!-- <div class="form-group has-feedback mb-3">
								<label for="pwd">Country:</label>
								<div class="form-field">
									<select class="form-control" name="country">
										<?php
										// foreach($countries as $key => $country)
										// echo'<option>'.$country['name'].'</option>';
										?>
									</select>
								</div>
							</div> -->



							<div class="g-recaptcha mt-4" data-sitekey="6LdbuCwdAAAAANGXao-fIMTvQWKO43uvoJBOLbg-" name = ""></div>
							<div class="Accept" style="display: none;">
									<span>
											<!-- <input id="chTerms" name="chTerms" type="checkbox" required="required"> -->
									</span>&nbsp;
									I have read the   <a style="cursor:pointer;color:red; font-size:16px" target="_blank" href="#" target="_blank">Terms &amp; Conditions</a>

							</div>
							<div class="form-group has-feedback">
									<button type="submit" class="btn btn-info btn-block mt-3 submit-btn otp-btn">Submit</button>
							</div>

							<?php echo form_close(); ?>
							<p style="display:none"><a href="<?php echo base_url('Site/Main/Register'); ?>">REGISTER NOW!</a></p>



					</div>

                                </div>
                            </div>
    						<div class="text-center">

                            <p>Already have an account ? <a href="https://zilgrow.io/app/" class="font-weight-medium text-white btn btn-success" style="background: #03657e!important"> Login </a> </p>
                          <!--   <p>© <script>document.write(new Date().getFullYear())</script> Veltrix. Crafted with <i class="mdi mdi-heart text-danger"></i> by fortunesclub</p> -->
                        </div>
                        </div>




                    </div>
                </div>
            </div>
        </div>

        <!-- JAVASCRIPT -->
        <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/simplebar/simplebar.min.js"></script>
        <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/node-waves/waves.min.js"></script>
        <script src="<?php echo base_url('NewDashboard/') ?>assets/js/app.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


		<script>
				$(document).on('blur', '#sponser_id', function () {
						check_sponser();
				})
				function check_sponser() {
						var user_id = $('#sponser_id').val();
						if (user_id != '') {
								var url = '<?php echo base_url("Dashboard/User/get_user/") ?>' + user_id;
								$.get(url, function (res) {
										$('#errorMessage').html(res);
								})
						}
				}
				check_sponser();
				$(document).on('submit', '#RegisterForm', function () {
						if (confirm('Please Check All The Fields Before Submit')) {
								yourformelement.submit();
						} else {
								return false;
						}
				})

				function docload(check){
					if(check == 'yes'){
						var radioButton = document.getElementById("no");
						radioButton.checked = false;
						document.getElementById("sponser_id").value = '';
						$('#errorMessage').html('');
					}else if(check == 'no'){
						var radioButton = document.getElementById("yes");
						radioButton.checked = false;
						document.getElementById("sponser_id").value = 'T11111';
						check_sponser();
					}
				}


				function sendEmailOtp() {
	                var email = document.getElementById('confirm_email').value;
	                if(email != ''){
	                    var formData = new FormData();
	                    var csrf = document.getElementsByName("<?php echo $this->security->get_csrf_token_name(); ?>")[0].value;
	                    formData.append("<?php echo $this->security->get_csrf_token_name(); ?>", csrf);
	                    formData.append("email", email);
	                    fetch("<?php echo base_url('Dashboard/User/getMailOtp/'); ?>", {
	                       method: "POST",
	                       headers: {
	                         "X-Requested-With": "XMLHttpRequest"
	                       },
	                       body: formData,
	                   })
	                   .then(response => response.json())
	                   .then(result => {
	                       document.getElementsByName("<?php echo $this->security->get_csrf_token_name(); ?>")[0].value = result.token;
	                       if(result.success == '1'){
	                           toastr.success(result.message, {timeOut: 5000})
	                       }else{
	                          toastr.error(result.message, {timeOut: 5000})
	                       };
	                    });
	                }
	            }

		</script>

	</body>
</html>
