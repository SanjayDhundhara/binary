<?php
if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
  $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  header('HTTP/1.1 301 Moved Permanently');
  header('Location: ' . $redirect);
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo title; ?></title>
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta content="" name="keywords">
<meta content="BTT brings overseas payments solutions in forex to brokers, traders and liquidity providers using cryptocurrency and one of the most secure and reliable digital currencies exchange." name="description">
<link rel="shortcut icon" href="assets/site/images/favicon.png" type="image/x-icon">
<!-- Bootstrap CSS File -->
<link href="<?php echo base_url('SiteAssets/'); ?>assets/site/css/bootstrap.min.css" type="text/css" rel="stylesheet">
<!-- Main Stylesheet File -->
<link href="<?php echo base_url('SiteAssets/'); ?>assets/site/css/style.css" type="text/css" rel="stylesheet">
<link href="<?php echo base_url('SiteAssets/'); ?>assets/site/js/owlcarousel/assets/owl.theme.default.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('SiteAssets/'); ?>assets/site/js/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" type="text/css">
<!-- <script src="<?php echo base_url('SiteAssets/'); ?>assets/site/js/crawler.js" ></script> -->

</head>
<body id="top">
<!--==========================
  Header
  ============================-->
<header id="header home" >
  <div class="top-header fixed-tab">
    <div class="container">
        <div class="row">
        <div class="col-sm-3"><a href="/" class="logo"><img src="<?php echo base_url('SiteAssets/'); ?>assets/site/images/logo.png" alt="logo"></a></div>
        <div class="col-sm-6">
          <div class="main-nav">
            <nav id="nav" class="navbar navbar-expand-lg navbar-light bg-light"> <a class="navbar-brand" href="#">Menu</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                  <li class="nav-item active"><a class="jumper" href="#top">Home</a></li>
                  <li class="nav-item"><a class="jumper" href="#about-us">About BTT</a></li>
                  
                  <li class="nav-item"><a class="jumper" href="#contactus">Contact</a></li>
                </ul>
              </div>
            </nav>
          </div>
        </div>
        <div class="col-sm-3">
        		        	<a class="sign in" href="<?php echo base_url('Dashboard/User/MainLogin'); ?>">Sign in</a>
	        	<a class="sign up" href="<?php echo base_url('Dashboard/User/Register'); ?>">Sign up</a>

        </div>
      </div>
    </div>
  </div>
  <div class="slider">
    <div class="container">
      <div class="row">
        <div class="col-sm-8">
          <div class="slider-text">
            <h1><img style="max-width:400px" src="<?php echo base_url('SiteAssets/'); ?>assets/site/images/logo-banner.png" alt=""></h1>
            <p>With BTT trading platform, Start trading in FOREX with cryptocurrency and enjoy the quickest international transactions with minimum transaction fee.</p>
            <a class="slider-botton paper" href="<?php echo base_url('SiteAssets/'); ?>assets/site/images/BTT-whitepaper.pdf" target="_blank">White Paper</a> <a class="slider-botton paper" href="#">Presentation</a> <a class="slider-botton video" href="#">Watch Video<i><img src="<?php echo base_url('SiteAssets/'); ?>assets/site/images/video-icon.png" alt="video-icon"></i></a> </div>
        </div>

      </div>
    </div>
  </div>
</header>
