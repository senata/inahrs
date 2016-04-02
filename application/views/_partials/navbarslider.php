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
      <a class="left-logo-inahrs" href="/" data-slide="home"><img src="assets/images/inahrslogo.png"/></a>
      <a class="left-control" href="#home-slider" data-slide="prev"><i class="fa fa-angle-left"></i></a>
      <a class="right-control" href="#home-slider" data-slide="next"><i class="fa fa-angle-right"></i></a>

      <a id="tohash" href="#about-us"><i class="fa fa-angle-down"></i></a>

    </div><!--/#home-slider-->
    <?php $this->load->view('_partials/navbar'); ?>
  </header><!--/#home-->