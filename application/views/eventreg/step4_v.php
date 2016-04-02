<div class="col-sm-12">

    <fieldset>

        <!-- Form Name -->
        <legend><i class="fa fa-building-o"></i> Accomodation</legend>

        <!-- Text input-->

        <?php if(count($hotels) > 0): ?>

		<form>
		<input type="hidden" name="form_name" value="accomodation" />

            <center>
                <table id="hotel" class="table table-bordered" style="width:80%;">
                    <tbody>
					<?php $i=0; ?>
                    <?php foreach($hotels as $hotel): ?>

                        <tr>
                            <td style="width: 30%;"><img style="width:100%;" src="<?php echo @$hotel['image_url'] ?>" /></td>
                            <td>

							<div style="font-size:1.5em">
							<?php echo @$hotel['name'] ?>
							</div>

							<div style="font-size:1.2em">Room Type: <?php echo @$hotel['room_type'] ?></div>
							<br>
							
							<?php echo @$hotel['desc'] ?>
							
							</td>

                            <td>Rp. <?php echo number_format(@$hotel['nett_price'] * 1000); ?>/night/room (NETT)</td>
                            <td>
							<label>
							<input data-id="<?php echo $i ?>" name="hotel[<?php echo $i ?>][id]" type="checkbox" value="<?php echo $hotel['id'] ?>"
							<?php
							$qty=0; $night=0;
							$book_from = '';
							$book_to = '';
							if(count(@$uhotels) > 0) {
								foreach($uhotels as $uroom){
									if($hotel['id'] == $uroom['id']){
										echo 'checked';
                                        $night = $uroom['night'];
										$qty = $uroom['qty'];
										$book_from = $uroom['book_from'];
										$book_to = $uroom['book_to'];
										break;
									}
								}
							}
							?>
							/> Select this room
							</label>
                            <br />
                            Night:
                            <input readonly="readonly" type="text" name="hotel[<?php echo $i ?>][night]" class="qty form-control input-number" value="<?php echo $night;?>" min="0" max="12">
                            Room:
							<input readonly="readonly" type="text" name="hotel[<?php echo $i ?>][qty]" class="qty form-control input-number" value="<?php echo $qty;?>" min="0" max="12">
								<br>
							Book any days between:
							<input readonly="readonly" type="text" name="hotel[<?php echo $i ?>][book_from]" class="datepicker form-control" value="<?php echo $book_from;?>">
							and:
							<input readonly="readonly" type="text" name="hotel[<?php echo $i ?>][book_to]" class="datepicker form-control" value="<?php echo $book_to;?>">

							</td>
                        </tr>

						<?php $i++; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </center>

			</form>
        <?php else: ?>

        <div class="form-group">
        	<center><label class="control-label" for="fullname">Sorry, accomodation is not available at this moment.</label></center>
        </div>

        <?php endif; ?>


    </fieldset>

</div>


<script>
$(document).ready(function(){
	$('input.qty').bootstrapNumber({
		upClass: 'success',
		downClass: 'danger'
	});

	$('input.qty').parents('div.input-group').css('width','150px');

	$('input[name^="hotel["]:checkbox').unbind('change');
	$('input[name^="hotel["]:checkbox').change(function(){
		var hotelid = $(this).data('id');
		if(this.checked) {
            $('input.qty[name="hotel['+hotelid+'][night]"]').val(1);
			$('input.qty[name="hotel['+hotelid+'][qty]"]').val(1);
		} else {
            $('input.qty[name="hotel['+hotelid+'][night]"]').val(0);
			$('input.qty[name="hotel['+hotelid+'][qty]"]').val(0);
		}
	});

	$( ".datepicker" ).datepicker({
		dateFormat: "dd/mm/yy"
	});

});
</script>