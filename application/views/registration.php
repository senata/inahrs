<?php $this->load->view('_partials/paralax_header'); ?>
<?php $this->load->view('_partials/navbar_topfixed'); ?>
  <section id="portofolio">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="heading text-center about-info wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1000ms">
        <h1>Symposia</h1>
          <p>
          <table class="table table-striped table-bordered table-hover" id="tablepress-24">
            <thead>
              <tr class="info">
                <th class="info">
                  Symposium</th>
                <th class="info">
                  <?php echo $event['label_before_boundary'];?></th>
                  <th class="info">
                  <?php echo $event['label_after_boundary'];?></th>
              </tr>
            </thead>
            <tbody class="row-hover">
            <?php foreach($symposiums as $symposium){?>
              <tr>
              <!-- <?php echo $participants[$symposium['membership_type']]['name'];?> -->
                <td><?php echo $symposium['name'];?></td>
                <td><?php echo "Rp. ".$symposium['fee_before_boundary'].".000,-";?></td>
                <td><?php echo "Rp. ".$symposium['fee_after_boundary'].".000,-";?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
          </p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="heading text-center about-info wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1000ms">
        <h1>Workshop</h1>
        <p>
          <table class="table table-striped table-bordered table-hover" id="tablepress-24">
            <thead>
              <tr class="info">
                <th class="info">
                  Workshop</th>
                <th class="info">
                  <?php echo $event['label_before_boundary'];?></th>
                  <th class="info">
                  <?php echo $event['label_after_boundary'];?></th>
              </tr>
            </thead>
            <tbody class="row-hover">
            <?php foreach($workshops as $workshop){?>
              <tr>
              <!-- <?php echo $participants[$symposium['membership_type']]['name'];?> -->
                <td><?php echo $workshop['name'];?></td>
                <td><?php echo "Rp. ".$workshop['fee_before_boundary'].".000,-";?></td>
                <td><?php echo "Rp. ".$workshop['fee_after_boundary'].".000,-";?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
          </p>
          <p>
          <table class="table table-striped table-bordered table-hover" id="tablepress-24">
            <thead>
              <tr class="info">
                <th class="info">
                  SPECIAL PACKAGE FOR GP (Limited for 50 participants)</th>
                <th class="info">
                  <?php echo $event['label_before_boundary'];?></th>
              </tr>
            </thead>
            <tbody class="row-hover">
            <?php foreach($special_workshops as $workshop){?>
              <tr>
              <!-- <?php echo $participants[$symposium['membership_type']]['name'];?> -->
                <td><?php echo $workshop['name'];?></td>
                <td><?php echo "Rp. ".$workshop['fee_before_boundary'].".000,-";?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
          </p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <div class="heading text-center about-info wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1000ms">
        <h1>Bank Details</h1>
        <p style="text-align: center;">
          Account Name: Pokja Electrophysiology &amp; Pacing<br>
          Bank Name: <strong>Bank Mandiri</strong><br>
          Account Number : <strong>117 0006 313 845</strong><br>
          Branch : Jakarta Harapan Kita</p>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="heading text-center about-info wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1000ms">
        <h1>Contact Detail</h1>
        <p style="text-align: center;">Phone : (021) 568 4093, ext 5004, 1223<br>
          Fax : (021) 568 4130/4230<br>
          Email : <a href="mailto:info@inahrs.or.id" target="_blank">info@inahrs.or.id</a><br>
          Web :&nbsp;<a href="http://www.inahrs.or.id/">http://www.inahrs.or.id</a>
        </p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="heading text-center about-info wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1000ms">
        <a href="/eventreg/register?event_id=<?php echo $event['id'];?>" class="btn-submit">Register Now</a>
        
        </div>
      </div>
      <div class="col-sm-4">
        <div class="heading text-center about-info wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1000ms">
          <a href="/eventreg/paymentconfirmation" class="btn-submit">Confirm Payment</a>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="heading text-center about-info wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1000ms">
        <a href="/eventreg/checkstatus" class="btn-submit">Check Status</a>
        </div>
      </div>
    </div>
  </div>
  </section><!--/#portfolio-->
  <?php $this->load->view('_partials/paralax_footer'); ?>