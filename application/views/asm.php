<?php $this->load->view('_partials/paralax_header'); ?>
<?php $this->load->view('_partials/navbar_topfixed'); ?>
  <section id="portofolio">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="heading text-center about-info wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1000ms">
	        <?php echo $data->content; ?>
        </div>
      </div>
    </div>
    </div>
  </section><!--/#portfolio-->
<?php $this->load->view('_partials/paralax_footer'); ?>