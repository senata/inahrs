<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>InaHRS | Indonesia Heart Rhythm Sociaty</title>
  <link href="assets/oxygen/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/oxygen/css/animate.min.css" rel="stylesheet"> 
  <link href="assets/oxygen/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/oxygen/css/lightbox.css" rel="stylesheet">
  <link href="assets/oxygen/css/main.css" rel="stylesheet">
  <link id="css-preset" href="assets/oxygen/css/presets/preset2.css" rel="stylesheet">
  <link href="assets/oxygen/css/responsive.css" rel="stylesheet">

  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
  <![endif]-->
  
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
  <!-- <link rel="shortcut icon" href="assets/oxygen/images/favicon.ico"> -->
</head><!--/head-->

<body>

  <!--.preloader-->
  <div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div>
  <!--/.preloader-->

  <header id="home">
    <div id="home-slider" class="carousel slide carousel-fade" data-ride="carousel">
      <div class="carousel-inner">
        <!-- <div class="item active" style="background-image: url(assets/oxygen/images/slider/1.jpg)"> -->
        <?php 
        $active = "\"item active\"";
        foreach ($photos as $photo){
          $backimage = "background-image: url(http://admin.inahrsdev.or.id/assets/content_inahrs/inahrs_upload/cover/".$photo->image_url.")";
          ?>
          <div class=<?php echo $active; ?> style="<?php echo $backimage;?>">
          <div class="caption">
            <h1 class="animated fadeInLeftBig"><?php echo $photo->title; ?></h1>
            <p class="animated fadeInRightBig"><?php echo $photo->subtitle; ?></p>
            <?php if(!empty($photo->button_label)){?>
            <a data-scroll class="btn btn-start animated fadeInUpBig" href=<?php echo $photo->button_url;?> > <?php echo $photo->button_label; ?></a>
            <?php }?>
          </div>
        </div>
        <?php 
          $active = "\"item\"";
        } 
        ?>
      </div>
      <a class="left-logo-inahrs" href="/" data-slide="home"><img src="assets/images/logo.png"/></a>
      <a class="left-control" href="#home-slider" data-slide="prev"><i class="fa fa-angle-left"></i></a>
      <a class="right-control" href="#home-slider" data-slide="next"><i class="fa fa-angle-right"></i></a>

      <a id="tohash" href="#services"><i class="fa fa-angle-down"></i></a>

    </div><!--/#home-slider-->
    <div class="main-nav">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">
            <h1><img class="img-responsive" src="assets/images/logo.png" alt="logo"></h1>
          </a>                    
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">                 
            <li class="scroll"><a class="btn btn-primary" href="#home">Home</a></li>
            <li class="scroll dropdown">
              <a class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Annual Scientific Meeting<span class="caret"></span>
              </a>
                <ul class="dropdown-menu sub-menu">
                  <li><a href="#" class="btn btn-primary">Workshop</a></li>
                  <li><a href="#" class="btn btn-primary">Symposium</a></li>
                  <li><a href="#" class="btn btn-primary">Submit Abstract</a></li>
                  <li><a href="#" class="btn btn-primary">Registration</a></li>
                </ul>
            </li> 
            <li class="scroll"><a class="btn btn-primary" href="http://i2cp.inahrsdev.or.id/">I2CP</a></li>
            <li class="scroll"><a class="btn btn-primary" href="#portfolio">Gallery</a></li>
            <li class="scroll"><a class="btn btn-primary" href="#contact">Contact</a></li>       
          </ul>
        </div>
      </div>
    </div><!--/#main-nav-->
  </header><!--/#home-->
  
  <?php echo $about->content;?>
  <!--/#about-us-->

  <section id="portfolio">
    <?php echo $i2cp_intro->content;?>
    <div class="container-fluid">
      <div class="row">
        <?php foreach($galleries as $gallery){?>
        <div class="col-sm-3">
          <div class="folio-item wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="300ms">
            <div class="folio-image">
              <img class="img-responsive" src=<?php echo "http://admin.inahrsdev.or.id/assets/content_inahrs/inahrs_upload/gallery/".$gallery->image_url; ?> alt="">
            </div>
            <div class="overlay">
              <div class="overlay-content">
                <div class="overlay-text">
                  <div class="folio-overview">
                    <span class="folio-expand"><a href=<?php echo "http://admin.inahrsdev.or.id/assets/content_inahrs/inahrs_upload/gallery/".$gallery->image_url; ?> data-lightbox="portfolio"><i class="fa fa-search-plus"></i></a></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
    <div id="portfolio-single-wrap">
      <div id="portfolio-single">
      </div>
    </div><!-- /#portfolio-single-wrap -->
  </section><!--/#portfolio-->

  <?php echo $guidelines->content;?>
  <!--/#team-->

  <section id="twitter" class="parallax">
    <div>
      <a class="twitter-left-control" href="#twitter-carousel" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
      <a class="twitter-right-control" href="#twitter-carousel" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
      <div class="container">
        <div class="row">
          <div class="col-sm-8 col-sm-offset-2">
            <div class="twitter-icon text-center">
              <i class="fa fa-twitter"></i>
              <h4>@inahrs</h4>
            </div>
            <div id="twitter-carousel" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="item active wow fadeIn" data-wow-duration="1000ms" data-wow-delay="300ms">
                  <p>Introducing Shortcode generator for Helix V2 based templates <a href="#"><span>#helixframework #joomla</span> http://bit.ly/1qlgwav</a></p>
                </div>
                <div class="item">
                  <p>Introducing Shortcode generator for Helix V2 based templates <a href="#"><span>#helixframework #joomla</span> http://bit.ly/1qlgwav</a></p>
                </div>
                <div class="item">                                
                  <p>Introducing Shortcode generator for Helix V2 based templates <a href="#"><span>#helixframework #joomla</span> http://bit.ly/1qlgwav</a></p>
                </div>
              </div>                        
            </div>                    
          </div>
        </div>
      </div>
    </div>
  </section><!--/#twitter-->

  <section id="contact">
    <!-- <div id="google-map" class="wow fadeIn" data-latitude="-6.1855247" data-longitude="106.7980735" data-wow-duration="1000ms" data-wow-delay="400ms"></div> -->
    <div id="contact-us" class="parallax">
      <div class="container">
        <div class="row">
          <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
            <h1>Contact Us</h1>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ut enim ad minim veniam</p> -->
          </div>
        </div>
        <div class="contact-form wow fadeIn" data-wow-duration="1000ms" data-wow-delay="600ms">
          <div class="row">
            <?php echo $contact_us->content;?>
          </div>
        </div>
      </div>
    </div>        
  </section><!--/#contact-->
  <footer id="footer">
<!--     <div class="footer-top wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
      <div class="container text-center">
        <div class="footer-logo">
          <a href="index.html"><img class="img-responsive" src="assets/oxygen/images/logo.png" alt=""></a>
        </div>
        <div class="social-icons">
          <ul>
            <li><a class="envelope" href="#"><i class="fa fa-envelope"></i></a></li>
            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li> 
            <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
            <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
            <li><a class="tumblr" href="#"><i class="fa fa-tumblr-square"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
 -->    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <p>&copy; 2016 Indonesia Heart Rhytym Sociaty</p>
          </div>
<!--           <div class="col-sm-6">
            <p class="pull-right">Crafted by <a href="http://designscrazed.org/">Allie</a></p>
          </div> -->
        </div>
      </div>
    </div>
  </footer>
  <script type="text/javascript" src="assets/oxygen/js/jquery.js"></script>
  <script type="text/javascript" src="assets/oxygen/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
  <script type="text/javascript" src="assets/oxygen/js/jquery.inview.min.js"></script>
  <script type="text/javascript" src="assets/oxygen/js/wow.min.js"></script>
  <script type="text/javascript" src="assets/oxygen/js/mousescroll.js"></script>
  <script type="text/javascript" src="assets/oxygen/js/smoothscroll.js"></script>
  <script type="text/javascript" src="assets/oxygen/js/jquery.countTo.js"></script>
  <script type="text/javascript" src="assets/oxygen/js/lightbox.min.js"></script>
  <script type="text/javascript" src="assets/oxygen/js/main.js"></script>

</body>
</html>