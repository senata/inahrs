<?php


?>
<div class="col-sm-12" id="summary-page">
    <form class="form-horizontal" id="summary">

        <h2><i class="fa fa-list-alt"></i> REGISTRATION SUMMARY</h2>

       <fieldset>

           <legend style="margin=bottom: 5px;">Participants</legend>

           <div class="form-group" style="margin-bottom: 0;">
                <label class="col-sm-2 control-label">Transaction Number</label>
                <div class="col-sm-10">
                    <p class="form-control-static">: <?php echo @$reg_data['tranx_number']?></p>
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 0;">
                <label for="inputPassword" class="col-sm-2 control-label">Event Title</label>
                <div class="col-sm-10">
                    <p class="form-control-static">: <?php echo @$event_title; ?></p>
                </div>
            </div>
           <div class="form-group" style="margin-bottom: 0;">
               <label for="inputPassword" class="col-sm-2 control-label">Venue</label>
               <div class="col-sm-10">
                   <p class="form-control-static">: <?php echo @$place; ?></p>
               </div>
           </div>
           <div class="form-group" style="margin-bottom: 0;">
               <label for="inputPassword" class="col-sm-2 control-label">Event Date</label>
               <div class="col-sm-10">
                   <p class="form-control-static">: <?php echo @$dates; ?></p>
               </div>
           </div>

        </fieldset>

        <fieldset>
            <legend style="margin=bottom: 5px;">Contact Detail</legend>

            <div class="form-group" style="margin-bottom: 0;">
                <label for="inputPassword" class="col-sm-2 control-label">Contact Name</label>
                <div class="col-sm-10">
                    <p class="form-control-static">: <?php echo @$reg_data['contact']['fullname']; ?></p>
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 0;">
                <label for="inputPassword" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <p class="form-control-static">: <?php echo @$reg_data['contact']['email']; ?></p>
                </div>
            </div>
            <?php if(trim(@$reg_data['contact']['phone']) != ''){ ?>
            <div class="form-group" style="margin-bottom: 0;">
                <label for="inputPassword" class="col-sm-2 control-label">Phone</label>
                <div class="col-sm-10">
                    <p class="form-control-static">: <?php echo @$reg_data['contact']['phone']; ?></p>
                </div>
            </div>
            <?php } ?>

            <?php if(trim(@$reg_data['contact']['fax']) != '') { ?>
            <div class="form-group" style="margin-bottom: 0;">
                <label for="inputPassword" class="col-sm-2 control-label">Fax</label>
                <div class="col-sm-10">
                    <p class="form-control-static">: <?php echo @$reg_data['contact']['fax']; ?></p>
                </div>
            </div>
            <?php } ?>

            <div class="form-group" style="margin-bottom: 0;">
                <label for="inputPassword" class="col-sm-2 control-label">Mobile</label>
                <div class="col-sm-10">
                    <p class="form-control-static">: <?php echo @$reg_data['contact']['mobile']; ?></p>
                </div>
            </div>

        </fieldset>

        <fieldset>
            <legend style="margin=bottom: 5px;">Participants</legend>

            <?php foreach($participants as $key=>$participant): ?>

            <div class="form-group" style="margin-bottom: 0;">
                <label for="inputPassword" class="col-sm-2 control-label">Full Name</label>
                <div class="col-sm-10">
                    <p class="form-control-static">: <?php echo @$participant['fullname']; ?></p>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="table_title">Program Name</th><th class="table_fee">Fee</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php if( !isset( $participant['registered_to']['not_participate_symposium'] ) ){ ?>
                    <tr class="odd">
                        <td>
                            <span>Symposium</span>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>Rp. <?php echo @number_format(@$participant['registered_to']['symposium']['fee'] * 1000) ?></label>
                            </div>
                        </td>
                    </tr>

                    <?php } ?>

                    <?php if (@count($participants[$key]['registered_to']['workshops']) > 0): // jika ada workshops dipilih?>

                        <?php foreach(@$participants[$key]['registered_to']['workshops'] as $keyw => $workshop){?>
                        <tr class="odd">
                            <td>
                                <span><?php echo @$workshop['name'] ?></span>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label>Rp. <?php echo @number_format(@$workshop['fee']  * 1000) ?></label>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>

                    <?php endif; ?>


                    </tbody>
                </table>

				<?php if (count(@$hotels) > 0 ): ?>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="table_title">Hotel</th><th class="table_fee">Fee</th>
                    </tr>
                    </thead>
                    <tbody>

					<?php foreach($hotels as $hotel): ?>
                        <tr class="odd">
                            <td>
                                <span><?php echo @$hotel['name'] ?> (Room Type: <?php echo @$hotel['room_type']?>, Quantity: <?php echo @$hotel['qty']?> room, Night: <?php echo @$hotel['night']?> nights )</span>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label>Rp. <?php echo @number_format(@$hotel['nett_price']  * 1000 * $hotel['qty'] * $hotel['night']) ?></label>
                                </div>
                            </td>
                        </tr>
					<?php endforeach; ?>

                    </tbody>
                </table>

				<?php endif; ?>


            </div>

            <?php endforeach; ?>


        </fieldset>

<?php /*
        <fieldset>
            <legend style="margin=bottom: 5px;">Flights</legend>

            <?php foreach($reg_data['flight']['passengers'] as $key=>$passenger): ?>

                <div class="form-group" style="margin-bottom: 0;">
                    <label for="inputPassword" class="col-sm-2 control-label">Passenger Name</label>
                    <div class="col-sm-10">
                        <p class="form-control-static">: <?php echo @$passenger['fullname']; ?></p>
                    </div>
                </div>

            <?php endforeach; ?>

        </fieldset>
<?php */ ?>


		<fieldset>
			<legend>Total</legend>
<table class="table table-bordered">
                    <tbody>
                    <tr class="">
                        <td>
                            <span>Total</span>
                        </td>
                        <td style="width: 185px;">
                                <strong>Rp. <?php echo number_format($grand_total  * 1000)?></strong>
                        </td>
                    </tr>


                    </tbody>
                </table>
		</fieldset>
    </form>
</div>