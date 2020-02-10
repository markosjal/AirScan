
<?php
include_once 'phppagestart.php';
// include 'lang.php'; 
include 'lang.inc.php'; 
?>
<!DOCTYPE html> 
<html lang="<?php echo $lang;?>">
<head>
<title><?php echo $pagetitle;?></title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="pagecss/bootstrap.min.css">
<?php /*
<link rel="stylesheet" type="text/css" href="pagecss/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="pagecss/simple-line-icons.css">
*/
?>
<link rel="stylesheet" type="text/css" href="pagecss/device-mockups.min.css">
<link rel="stylesheet" type="text/css" href="pagecss/style.css">
<link href="//fonts.googleapis.com/css?family=Lato">
<link href="//fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900">
<link href="//fonts.googleapis.com/css?family=Muli">
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
</head>
<body id="page-top">
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"><span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i></button>
      <a class="navbar-brand page-scroll" href="#page-top"><?php echo $airscan;?></a></div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a class="page-scroll" href="#features"><?php echo $aboutairscan;?></a></li>
        <li><a class="page-scroll" href="#download"><?php echo $download;?></a></li>
<li><a class="page-scroll" href="<?php if($lang=='es'){ echo 'http://airscan.tecnologiadeleon.com/login.php';}else{echo 'http://airscan.teknogeekz.com/login.php';}?>"><?php if($lang=='es'){ echo 'demo en Vivo';}else{echo 'Live Demo';}?></a></li>


<li><a class="page-scroll" href="<?php if($lang=='en'){ echo 'http://teknogeekz.com';} else { echo 'http://tecnologiadeleon.com';}?>"><?php if($lang=='en'){ echo 'Main Page';}else{echo 'Página Principal';}?></a></li>


<li><a class="page-scroll" href="<?php if($lang=='es'){ echo 'http://airscan.teknogeekz.com';}else{echo 'http://airscan.tecnologiadeleon.com';}?>"><?php if($lang=='es'){ echo 'English';}else{echo 'Español';}?></a></li>
      </ul>
    </div>
  </div>
</nav>
<header>
  <div class="container">
    <div class="row">
      <div class="col-sm-7">
        <div class="header-content">
	<img style="filter: brightness(70%)"src="/img/ScannerGeneric.png"/>
          <div class="header-content-inner">
<table><tr><td>
            <h1><span style='text-shadow: 3px 3px #111'><?php echo$pagetop;?></span></h1></td></tr>
		<tr><td  style="text-align: left"><span style='text-shadow: 2px 2px  #111'>		
		<ul><?php echo $scannerlist;?></ul>
		</td></tr></table></span>
<table style="text-align: left"><tr><td><span style='text-shadow: 2px 2px  #111'><?php echo $introtxt;?></span></td></tr></table>



            <table><tr><td><a href="#features" class="btn btn-outline btn-xl page-scroll"><?php echo $readmore;?></a></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td><a href="login.php" class="btn btn-outline btn-xl page-scroll"><?php echo $livedemo;?></a></td></tr></table></div>

        </div>
      </div>
      <div class="col-sm-5">
        <div class="device-container">
          <div class="device-mockup iphone6_plus portrait white">
            <div class="device">
              <div class="screen"><img src="img/airscantablet.png" class="img-responsive" alt=""></div>
              <div class="button"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<section id="features" class="features">

  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <h2 class="section-heading"><?php echo $intheair;?></h2><?php echo $moreinfo;?>
	
        <?php /* <div class="badges"><a class="badge-link" href="#"><img src="img/google-play-badge.svg" alt=""></a> <a class="badge-link" href="#"><img src="img/app-store-badge.svg" alt=""></a></div> */ ?>
      </div>
    </div>
  </div>
</section>
<section id="download" class="download bg-primary text-center">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="section-heading">
          <h2><span style="font-size: smaller; color:#666; font-weight:bold"><?php echo $whatitdoes;?></span></h2>
          <p class="text-muted"><span style="font-size: larger; color:#666; font-weight:bold"><?php echo $thisandmore;?></span></p>
          <hr>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="device-container">
          <div class="device-mockup iphone6_plus portrait white">
            <div class="device">
              <div class="screen"><img src="img/airscantablet.png" class="img-responsive" alt=""></div>
              <div class="button"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <div class="feature-item"><i class="icon-screen-smartphone text-primary"></i>
                <h3><span style="color:#666; font-weight:bold"><?php echo $scan;?></span></h3>
                <p class="text-muted"><span style="color:#666; font-weight:bold"><?php echo $scanmore;?></span></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="feature-item"><i class="icon-camera text-primary"></i>
                <h3><span style="color:#666; font-weight:bold"><?php echo $copy;?></span></h3>
                <p class="text-muted"><span style="color:#666; font-weight:bold"><?php echo $copymore;?></span></p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="feature-item"><i class="icon-present text-primary"></i>
                <h3><span style="color:#666; font-weight:bold"><?php echo $crop;?></span></h3>
                <p class="text-muted"><span style="color:#666; font-weight:bold"><?php echo $cropmore;?></span></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="feature-item"><i class="icon-lock-open text-primary"></i>
                <h3><span style="color:#666; font-weight:bold"><?php echo $convert;?></span></h3>
                <p class="text-muted"><span style="color:#666; font-weight:bold"><?php echo $convertmore;?></span></p>
              </div>
            </div>
          </div><table style="text-align: left; width: 100%"><tr><td>
<span style="color:#666; font-weight:bold">
<table><tr><td style="text-align: left; vertical-align: top">	
<ul>
<lh><h3><span style="color:#666; font-weight:bold"><?php echo $requirements;?></h3></lh>
<?php echo $requirementslist;?>
<td><td style="text-align: left; vertical-align: top">		
<ul>
<lh><h3><span style="color:#666; font-weight:bold"><?php echo $compatiblescanners;?></h3></lh>
<?php echo $scannerlist;?></ul></td><tr></table>



</ul></span>
</td><td></td></tr></table><?php echo $rpinote;?><br/>
<table style="width: 100%"><tr style='background-color: #f5f5f5; width: 100%'><td style="text-align: center"><span style="color:#666; font-weight:bold"><?php echo $freeversion;?></span></td><td style="text-align: center"><span style="color:#666; font-weight:bold"><?php echo $price;?></span></td></tr>
<tr style='background-color: #f5f5f5; width: 100%'>
<td style="text-align: center"><a href="http://teknogeekz.com/downloads/AirScan7.0Free.zip"><span style="font-size: larger; color:#333; text-shadow: 2px 2px #fdcc52; font-weight:bold"><?php echo $startdownload;?></span></td>
<td  style="text-align: center">
<?php echo $paypalbutton;?>
</td></tr><tr style='background-color: #f5f5f5; width: 100%'><td colspan=2><span style="color:#666; font-weight:bold">&nbsp;</span></td></tr></table>
<p><span style="color:#666; font-weight:bold"><?php echo $freevspaid;?></span></p>
        </div>
      </div>
    </div>
  </div>
</section>
<?php /*
<section class="cta">
  <div class="cta-content">
    <div class="container">
      <h2>Stop waiting.<br>
        Try the free version now, or buy the commercial version.</h2>
      <a href="#contact" class="btn btn-outline btn-xl page-scroll">Let's Get Started!</a></div>
  </div>
  <div class="overlay"></div>
</section>
<section id="contact" class="contact bg-primary">
  <div class="container">
    <h2>We <i class="fa fa-heart"></i> new friends!</h2>
    <ul class="list-inline list-social">
      <li class="social-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
      <li class="social-facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
      <li class="social-google-plus"><a href="#"><i class="fa fa-google-plus"></i></a></li>
    </ul>
  </div>
</section>
*/ ?>
<footer>
  <div class="container">
<?php echo $homelink;?>
    <p><?php echo $copyright;?></p>
    <?php /*<ul class="list-inline">
      <li><a href="#">Privacy</a></li>
      <li><a href="#">Terms</a></li>
      <li><a href="#">FAQ</a></li>
    </ul> */ ?>

  </div>
</footer>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
