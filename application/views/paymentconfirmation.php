  <?php $this->load->view('_partials/paralax_header'); ?>
  <?php $this->load->view('_partials/navbar_topfixed'); ?>
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <section id="contact">
    <div id="contact-us" class="parallax">
      <div class="container">
        <div class="row">
          <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
            <h1>Payment Confirmation</h1>
          </div>
        </div>
        <div class="contact-form wow fadeIn" data-wow-duration="1000ms" data-wow-delay="600ms">
          <div class="row">
            <div class="col-sm-8 col-sm-offset-2 wow fadeInUp">
              <?php // render fields & system message using Form Builder library ?>
      				<?php echo $form->open(); ?>
      				<?php echo $form->messages(); ?>
                <div class="form-group">
                	<?php echo $form->field_text('transaction_number',NULL,array('placeholder'=>'Transaction Number','class'=>'form-control','required'=>'required', 'maxlength'=>"16", 'length'=>"16")); ?>
                </div>
                <div class="form-group">
                   <?php echo $form->field_email('email',NULL,array('placeholder'=>'Email','class'=>'form-control','required'=>'required')); ?>
                </div>
                <div class="form-group">
                    <input name="transfer_to" value="Bank Mandiri<br>Pokja Electrophysiology & Pacing<br>117.000.631.3845" type="radio" id="test1" checked />
                    <label for="transfer_to">Bank Mandiri<br>Pokja Electrophysiology & Pacing<br>117.000.631.3845</label>
                </div>
                <div class="form-group">
                    <?php echo $form->field_text('sender_account_name',NULL,array('placeholder'=>'Sender Account Name','class'=>'form-control','required'=>'required')); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->field_text('transfer_amount',NULL,array('placeholder'=>'Transfer Amount','class'=>'form-control','required'=>'required')); ?>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <?php echo $form->field_text('transfer_date',NULL,array('placeholder'=>'Transfer Date','class'=>'form-control','required'=>'required')); ?>
                  </div>
                </div>
                <div class="form-group">
                <label>Browse Transfer Scan</label>
                    <?php echo $form->field_upload('transfer_proof',NULL,array('required'=>'required')); ?>
                </div>
                <?php echo $form->field_recaptcha(); ?>                        
                <div class="form-group">
                  <?php echo $form->btn_submit('Confirm Payment',array('class'=>"btn-submit")); ?>
                </div>
              <!-- </form> -->
              <?php echo $form->close(); ?>   
            </div>
          </div>
        </div>
      </div>
    </div>        
  </section><!--/#contact-->
  

  <!-- <?php
    foreach ($scripts['foot'] as $file)
    {
      $url = starts_with($file, 'http') ? $file : base_url($file);
      echo "<script src='$url'></script>".PHP_EOL;
    }
  ?>

  <?php // Google Analytics ?>
  <?php $this->load->view('_partials/ga') ?> -->
    <footer id="footer">
    <div class="footer-bottom" style="box-shadow: 0px 0px 5px 2px !important; #FFF;color:black;">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <p>&copy; 2016 Indonesia Heart Rhytym Sociaty</p>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <script type="text/javascript" src="/assets/oxygen/js/jquery.js"></script>
  <script type="text/javascript" src="/assets/oxygen/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
  <script type="text/javascript" src="/assets/oxygen/js/jquery.inview.min.js"></script>
  <script type="text/javascript" src="/assets/oxygen/js/wow.min.js"></script>
  <script type="text/javascript" src="/assets/oxygen/js/mousescroll.js"></script>
  <script type="text/javascript" src="/assets/oxygen/js/smoothscroll.js"></script>
  <script type="text/javascript" src="/assets/oxygen/js/jquery.countTo.js"></script>
  <script type="text/javascript" src="/assets/oxygen/js/lightbox.min.js"></script>
  <script type="text/javascript" src="/assets/oxygen/js/main.js"></script>

<!-- <script src="/assets/event/js/jquery-2.1.1.min.js"></script> -->
<script src="/assets/event/plugins/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
    <link href="/assets/event/plugins/jquery-ui-1.11.4.custom/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/assets/event/plugins/jquery-ui-1.11.4.custom/jquery-ui.theme.min.css" type="text/css">
  <script>
    $(document).ready(function(){
       $( "#transfer_date" ).datepicker();
        // $('.datepicker').datepicker({
        //     selectMonths: true, // Creates a dropdown to control month
        //     selectYears: 15 // Creates a dropdown of 15 years to control year
        // });
    });
</script>
</body>
</html>