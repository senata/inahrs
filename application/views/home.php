<?php $this->load->view('_partials/paralax_header'); ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php $this->load->view('_partials/navbarslider'); ?>
<!-- view: home.php -->
  <?php echo $about->content;?>
  <!--/#about-us-->
<?php echo $messages->content;?>
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
      <div class="container">
        <div class="row">
          <div class="col-sm-8 col-sm-offset-2">
            <div class="facebook-icon text-center">
		<img src="/assets/images/facebook_120x120px.png" style="width:10%"/>
            </div>
            <!-- <a class="twitter-timeline"  href="https://twitter.com/search?q=Heart%20Rhythm%20Society" data-widget-id="713279741546139648">Tweets about Heart Rhythm Society</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>     -->
            <div class="fb-page" data-href="https://www.facebook.com/inahrs3rdannualmeeting" data-width="500" data-height="500" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/inahrs3rdannualmeeting"><a href="https://www.facebook.com/inahrs3rdannualmeeting">4th Annual Scientific Meeting Indonesian Heart Rhythm Society</a></blockquote></div></div>
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
<?php $this->load->view('_partials/paralax_footer'); ?>
