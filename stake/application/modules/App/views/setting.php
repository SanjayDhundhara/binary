<?php require_once'header.php';?>
<style>
    .caping-bg {
    background: #05647d !important; 
}
.profile-setting li i {
    font-size: 17px;
    margin-right: 5px;
    color: #000;
}
</style>
 <div class="table-portfolio">
      <div class="portfolio-head text-center">
                        <!-- <h6>Welcome <?php echo $user['name'];?></h6> -->
                        <p>User Name : <?php echo $user['name'];?></p>
                        <p>User Id : <?php echo $user['user_id'];?></p>
                        <p>Email : <?php echo $user['email'];?></p>
                    </div>
                             
                    <div class="profile-setting">
                    <ul>
                    <li>
                            <a href="https://zilgrow.io/App/Profile"><i class="fa fa-pencil-square-o"></i> Edit Profile </a>
                        </li>
                        <li>
                            <a href="https://zilgrow.io/App/Profile/changePassword"><i class="fa fa-pencil-square-o"></i> Update Password </a>
                        </li>
                        <li>
                            <a href="https://zilgrow.io/App/Support/ComposeMail"><i class="fa fa-ticket"></i> Help &amp; Support</a>
                        </li>

                        
                        
                        <li>
                            <a href="#"><i class="fa fa-exclamation-circle"></i> Refer &amp; Earn</a>
                        </li>
                    </ul>
                    <div class="logout text-center">
                        <a class="btn btn-primary d-inline" href="https://zilgrow.io/App/User/logout" style="border-radius: 30px;">
                            Logout
                        </a>
                    </div>
                </div>
                    

                    
                               
                           </div>

<?php require_once'footer.php';?>