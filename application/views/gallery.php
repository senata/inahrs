<?php $this->load->view('_partials/paralax_header'); ?>
<?php $this->load->view('_partials/navbar_topfixed'); ?>
  <section id="portfolio">
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
  <?php $this->load->view('_partials/paralax_footer'); ?>