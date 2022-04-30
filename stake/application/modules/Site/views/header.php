<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>

<!-- Meta Tags -->
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<meta name="description" content="KonsultPlus | Business Consulting & Corporate Finance HTML5 Template" />
<meta name="keywords" content="advisor,corporate,business,accountant,consulting,finance,financial,insurance,trading" />
<meta name="author" content="ThemeMascot" />

<!-- Page Title -->
<title><?php echo title;?></title>

<!-- Favicon and Touch Icons -->
<link href="<?php echo base_url('Latestsite/');?>images/favicon.png" rel="shortcut icon" type="image/png">
<link href="<?php echo base_url('Latestsite/');?>images/apple-touch-icon.png" rel="apple-touch-icon">
<link href="<?php echo base_url('Latestsite/');?>images/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
<link href="<?php echo base_url('Latestsite/');?>images/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
<link href="<?php echo base_url('Latestsite/');?>images/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">

<!-- Stylesheet -->
<link href="<?php echo base_url('Latestsite/');?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('Latestsite/');?>css/jquery-ui.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('Latestsite/');?>css/animate.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('Latestsite/');?>css/css-plugin-collections.css" rel="stylesheet"/>
<!-- CSS | menuzord megamenu skins -->
<link id="menuzord-menu-skins" href="<?php echo base_url('Latestsite/');?>css/menuzord-skins/menuzord-boxed.css" rel="stylesheet"/>
<!-- CSS | Main style file -->
<link href="<?php echo base_url('Latestsite/');?>css/style-main.css" rel="stylesheet" type="text/css">
<!-- CSS | Preloader Styles -->
<link href="<?php echo base_url('Latestsite/');?>css/preloader.css" rel="stylesheet" type="text/css">
<!-- CSS | Custom Margin Padding Collection -->
<link href="<?php echo base_url('Latestsite/');?>css/custom-bootstrap-margin-padding.css" rel="stylesheet" type="text/css">
<!-- CSS | Responsive media queries -->
<link href="<?php echo base_url('Latestsite/');?>css/responsive.css" rel="stylesheet" type="text/css">
<!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->
<!-- <link href="css/style.css" rel="stylesheet" type="text/css"> -->

<!-- Revolution Slider 5.x CSS settings -->
<link  href="<?php echo base_url('Latestsite/');?>js/revolution-slider/css/settings.css" rel="stylesheet" type="text/css"/>
<link  href="<?php echo base_url('Latestsite/');?>js/revolution-slider/css/layers.css" rel="stylesheet" type="text/css"/>
<link  href="<?php echo base_url('Latestsite/');?>js/revolution-slider/css/navigation.css" rel="stylesheet" type="text/css"/>

<!-- CSS | Theme Color -->
<link href="<?php echo base_url('Latestsite/');?>css/colors/theme-skin-color-set2.css" rel="stylesheet" type="text/css">

<script src="<?php echo base_url('Latestsite/');?>js/jquery-2.2.4.min.js"></script>
<script src="<?php echo base_url('Latestsite/');?>js/jquery-ui.min.js"></script>
<script src="<?php echo base_url('Latestsite/');?>js/bootstrap.min.js"></script>
<!-- JS | jquery plugin collection for this theme -->
<script src="<?php echo base_url('Latestsite/');?>js/jquery-plugin-collection.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="">
<div id="wrapper" class="clearfix">
  <!-- preloader -->
  <div id="preloader">
    <div id="spinner">
      <div class="preloader-dot-loading">
        <div class="cssload-loading"><i></i><i></i><i></i><i></i></div>
      </div>
    </div>
    <div id="disable-preloader" class="btn btn-default btn-sm">Disable Preloader</div>
  </div> 
  
  <!-- Header -->
  <header id="header" class="header modern-header modern-header-theme-colored">
    <div class="header-top bg-theme-colored sm-text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="widget text-white">
              <i class="fa fa-phone text-theme-colored2"></i><span><a href="tel:0987654321"><?php echo phone;?></a></span>
            </div>
          </div>
          <div class="col-md-4">
            
            <div class="widget">
              <ul class="list-inline  text-right flip sm-text-center">
                <li class="m-0 pl-10"> <a href="<?php echo base_url('Dashboard/User/MainLogin'); ?>" class="text-white ajaxload-popup"><i class="fa fa-user-o mr-5 text-theme-colored2"></i> Login /</a> </li>
                <li class="m-0 pl-0 pr-10"> 
                  <a href="<?php echo base_url('Dashboard/User/Register'); ?>" class="text-white ajaxload-popup"><i class="fa fa-edit mr-5 text-theme-colored2"></i>Register</a> 
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="header-middle p-0 bg-light xs-text-center">
      <div class="container pt-30 pb-30">
        <div class="row">
          <div class="col-xs-12 col-sm-4 col-md-3">
            <div class="widget sm-text-center">
              <i class="fa fa-envelope text-theme-colored2 font-32 mt-5 mr-sm-0 sm-display-block pull-left flip sm-pull-none"></i>
              <a href="#" class="font-12 text-gray text-uppercase">Mail Us Today</a>
              <h5 class="font-13 text-black m-0"> <?php echo email;?></h5>
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-6">
            <div class="widget text-center">
              <a class="" href="/"><img src="<?php echo base_url('Latestsite/');?>images/logo.png" alt="" style="max-width: 250px;"></a>
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-3">
            <div class="widget sm-text-center">
              <i class="fa fa-building-o text-theme-colored2 font-32 mt-5 mr-sm-0 sm-display-block pull-left flip sm-pull-none"></i>
              <a href="#" class="font-12 text-gray text-uppercase">Company Location</a>
              <h5 class="font-13 text-black m-0"> 121 King Street</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="header-nav">
      <div class="header-nav-wrapper navbar-scrolltofixed">
        <div class="container">
          <nav id="menuzord" class="menuzord red">
            <ul class="menuzord-menu">
              <li class="home"><a href="#"><i class="fa fa-home font-28"></i></a></li>
              <li class="active"><a href="/">Home</a>
                
              </li>
              <li><a href="#">About</a>
                
              </li>
              
              <li><a href="#">Businss Plan</a>
                
              </li>
              <li><a href="#">Contact Us</a>
              </li>
              <li><a href="<?php echo base_url('Dashboard/User/Register'); ?>">Register</a>
              </li>
              <li><a href="<?php echo base_url('Dashboard/User/MainLogin'); ?>">Login</a>
              </li>
              
               <li class="active pull-right"><a href="tel:+(012) 345 6789" class="font-20 line-height-1"><i class="pe-7s-call mr-10 font-28"></i> +(012) 345 6789</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </header>