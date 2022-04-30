<?php
// if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
//     $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//     header('HTTP/1.1 301 Moved Permanently');
//     header('Location: ' . $redirect);
//     exit();
// }
$user_info = userinfo();
$bankinfo = bankinfo();
$none = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo title;?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo base_url('');?>assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url('');?>assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?php echo base_url('');?>assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo base_url('');?>assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?php echo base_url('');?>assets/css/demo_4/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?php echo base_url('');?>assets/images/logo-mini.png" />
    <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url('');?>assets/css/appstyle.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <style>
    #tile-1 .nav-tabs .active {
    background-color: #03657e!important;
    border: none!important;
    color: #ffffff!important;
}
.portfolio-head {
    background: #03657e;

}
.card.card-body h1 {
    font-size: 29px;
}
.app-top-head {
    background: #01667f;
}
#tile-1 .nav-tabs .active {
    background-color: #03657e !important;
    border: none!important;
    color: #ffffff!important;
}
#tile-1 .nav-tabs a:hover {
    background-color: #03657e!important;
    border: none;
}
    </style>
  </head>
  <body>
    <div class="container-scroller">
      
      <div class="app-top-head">
                            <div class="app-logo">
                              <a href ="<?php echo base_url('App/User'); ?>">
                                <img src="https://zilgrow.io/uploads/logo.png" class="img-fluid">
                              </a>
                            </div>

                            <div class="app-logout">
                                <a href="https://zilgrow.io/App/User/logout">
                                    <img src="https://zilgrow.io/assets/images/app-logout-img.png">
                                </a>
                            </div>
                            <div class="app-logout">
                                <a href="#">
                                    <img src="https://zilgrow.io/uploads/notification.png">
                                </a>
                            </div>
                        </div>
