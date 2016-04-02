  <?php $this->load->view('_partials/paralax_header'); ?>
  <?php $this->load->view('_partials/navbar_topfixed'); ?>
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <section id="contact">
    <div id="contact-us" class="parallax">
      <div class="container">
        <div class="row">
          <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
            <h1>Abstract Submission</h1>
            <p>Abstract Deadline : September 15th, 2016</p>
          </div>
        </div>
        <div class="contact-form wow fadeIn" data-wow-duration="1000ms" data-wow-delay="600ms">
          <div class="row">
            <div class="col-sm-6">
              <div class="contact-info wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                <?php echo $data->content; ?>
              </div>                            
            </div>
            <div class="col-sm-6">
              <!-- <form id="main-contact-form" name="contact-form" method="post" action="submitabstract/new" enctype="multipart/form-data"> -->
              <?php // render fields & system message using Form Builder library ?>
				<?php echo $form->open(); ?>
				<?php echo $form->messages(); ?>
                <div class="form-group">
                	<?php echo $form->field_text('name',NULL,array('placeholder'=>'Name','class'=>'form-control','required'=>'required')); ?>
                </div>
                <div class="row  wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                  <div class="col-sm-6">
                    <div class="form-group">
                    <?php echo $form->field_text('phone_number',NULL,array('placeholder'=>'Phone Number','class'=>'form-control','required'=>'required')); ?>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                       <?php echo $form->field_email('email',NULL,array('placeholder'=>'Email','class'=>'form-control','required'=>'required')); ?>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                    <?php echo $form->field_textarea('topic',NULL,array('rows'=>3,'placeholder'=>'Topics','class'=>'form-control','required'=>'required')); ?>
                </div>
                <div class="form-group">
                  <input type="checkbox" name="poster" value="1"> Poster Presentation<br>
                  <input type="checkbox" name="oral" value="1"> Oral Presentation<br>
                </div>
                <div class="form-group">
                <label>Curriculum Vitae</label>
                    <?php echo $form->field_upload('cv',NULL,array('required'=>'required')); ?>
                </div>
                <div class="form-group">
                <label>Abstract</label>
                    <?php echo $form->field_upload('abstract',NULL,array('required'=>'required')); ?>
                </div>
                <?php echo $form->field_recaptcha(); ?>                        
                <div class="form-group">
                  <?php echo $form->btn_submit('Send Now',array('class'=>"btn-submit")); ?>
                </div>
              <!-- </form> -->
              <?php echo $form->close(); ?>   
            </div>
          </div>
        </div>
      </div>
    </div>        
  </section><!--/#contact-->
  <?php $this->load->view('_partials/paralax_footer'); ?>