<?php
$count = count($participants);
if($count == 0){
    $participants[] = array();
}


foreach($participants as $key => $participant){
    foreach($symposium as $symposium_rate){
        if(isset($participant[$key]['participant_type'])) {
            exit('Membership type was not selected. Please go back to Participants page.');
        }
        if($symposium_rate['membership_type'] == $participant['participant_type']){
            $participants[$key]['symposium']['fee_before_boundary'] = $symposium_rate['fee_before_boundary'];
            $participants[$key]['symposium']['fee_after_boundary'] = $symposium_rate['fee_after_boundary'];
        }
    }
}
?>


<div class="col-sm-12">
    <form class="form-horizontal" data-toggle="validator" role="form">
        <input type="hidden" name="form_name" value="fees">

        <fieldset>
            <legend><i class="fa fa-money"></i> Registration Fees</legend>
            <div class="col-xs-3"> <!-- required for floating -->
                <!-- Nav tabs -->
                <ul id="tabs-fee" class="nav nav-tabs tabs-left">
                    <?php foreach($participants as $key=>$val): ?>
                        <?php $id=$key;$num=$key+1;?>
                        <li class="<?php if($id==0) echo "active" ?> tab-<?php echo $id ?>">
                            <a id="btnTabFee-<?php echo $num?>" href="#fee-<?php echo $num?>" data-toggle="tab" aria-expanded="true"><?php if(@$val['fullname']!=''){
                                    echo $val['fullname'];
                                } else { ?>
                                    Participant <?php echo $num?>
                                <?php } ?></a>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>

            <div class="col-xs-9">
                <!-- Tab panes -->
                <div class="tab-content">

                    <?php foreach($participants as $key=>$val): ?>
                        <?php
                        if($count == 0) $key=0;
                        ?>
                        <?php $id=$key;$num=$key+1;?>

                    <div class="tab-pane <?php if($key==0) echo "active" ?> tab-pane-<?php echo $key?>" id="fee-<?php echo (int) @$num?>">
                        <div class="participant-tab-content">

                            <h2>Participant: <?php echo @$participants[$key]['fullname']; ?></h2>

                            <fieldset>

                                <div class="checkbox">
                                    <label><input type="checkbox" name="participants[<?php echo $key ?>][not_participate_symposium]" value="1" <?php if(@$participants[$key]['registered_to']['not_participate_symposium']) echo "checked"?>>Do not participate to Symposium</label>
                                </div>

                                <!-- Form Name -->
                                <legend class="participant-tab-title">Symposium</legend>

                                <div id="symposium-table-<?php echo $key ?>">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>

                                            <th id="yw5_c1"><?php echo $event['label_before_boundary'] ?></th>

                                            <th id="yw5_c2"><?php echo $event['label_after_boundary'] ?></th>

                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tr class="odd">
                                            <td>
                                                <label>
                                                <input value="<?php echo $participants[$key]['symposium']['fee_before_boundary'] ?>" name="participants[<?php echo $key?>][symposium][fee]" id="participants[<?php echo $key?>][symposium]" type="radio"  <?php echo ($is_before_boundary) ? 'checked="checked"' : 'disabled' ?>> Rp. <?php echo number_format ($participants[$key]['symposium']['fee_before_boundary'] * 1000) ?>
                                                </label>
                                            </td>
                                            <td>
                                                <label>
                                                <input value="<?php echo $participants[$key]['symposium']['fee_after_boundary'] ?>" name="participants[<?php echo $key?>][symposium][fee]" id="participants[<?php echo $key?>][symposium]" type="radio"  <?php echo (!$is_before_boundary) ? 'checked="checked"' : 'disabled' ?>> Rp. <?php echo number_format ($participants[$key]['symposium']['fee_after_boundary'] * 1000) ?>
                                                </label>
                                            </td>

                                        </tr>


                                        </tbody>
                                    </table>
                                </div>

                            </fieldset>

                            <fieldset>
                                <legend>Workshops</legend>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th id="workshop_title">Workshop Title</th><th id="workshop_fee"><?php echo $event['label_before_boundary'] ?></th><th id="workshop_fee"><?php echo $event['label_after_boundary'] ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1; ?>

                                    <?php foreach($workshops[$key] as $keyw => $workshop): // $workshops = list workshop dari db ?>
                                    <tr class="<?php echo ($i%2 == 0) ? 'odd' : 'even'; ?>">
                                        <td>
                                            <?php echo $workshop['name']?>
                                        </td>
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input
                                                        type="checkbox"
                                                        name="participants[<?php echo $key?>][workshops][]"
                                                        id="participants[<?php echo $key?>][workshops][<?php echo $workshop['id']?>]"
                                                        value="<?php echo $workshop['id']?>|<?php echo $workshop['name'] ?>|<?php echo $workshop['fee_before_boundary']?>"
                                                        <?php if(isset($participants[$key]['registered_to']['workshops'][$workshop['id']]) AND $is_before_boundary)
                                                            echo "checked"; ?>
                                                        <?php echo (!$is_before_boundary) ? 'disabled' : ''  ?>
                                                        > <?php 
													if($workshop['fee_before_boundary'] == null){
														echo 'N/A';
													} else {
														echo 'Rp. '. number_format ($workshop['fee_before_boundary'] * 1000);
													}
													?>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input 
														type="checkbox" 
														name="participants[<?php echo $key?>][workshops][]"
														id="participants[<?php echo $key?>][workshops][<?php echo $workshop['id']?>]"
														value="<?php echo $workshop['id']?>|<?php echo $workshop['name'] ?>|<?php echo $workshop['fee_after_boundary']?>"
														<?php if(isset($participants[$key]['registered_to']['workshops'][$workshop['id']]) AND !$is_before_boundary) echo "checked"; ?>
														<?php echo ($is_before_boundary) ? 'disabled' : '' ?>
													> <?php 
													if($workshop['fee_after_boundary'] == null){
														echo 'N/A';
													} else {
														echo 'Rp. '. number_format ($workshop['fee_after_boundary'] * 1000);
													}
													?>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>


                                    </tbody>
                                </table>
                            </fieldset>

							<?php if(count($package_workshops[$key])>0): ?>

                            <fieldset>
                                <legend>Special Package For GP</legend>
                                <table class="table table-bordered">
                                    
                                    <thead>
                                    <tr>
                                        <th id="workshop_title">Workshop Title</th><th id="workshop_fee"><?php echo $event['label_before_boundary'] ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1; ?>

                                    <?php foreach($package_workshops[$key] as $keyw => $workshop): // $workshops = list workshop dari db ?>
									<?php
									if(!is_null($workshop['registrant_type_id']) and $val['participant_type'] != $workshop['registrant_type_id']){
										continue;
									}
									?>
                                    <tr class="<?php echo ($i%2 == 0) ? 'odd' : 'even'; ?>">
                                        <td>
                                            <?php echo $workshop['name']?>
                                        </td>
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input
                                                        type="checkbox"
                                                        name="participants[<?php echo $key?>][workshops][]"
                                                        id="participants[<?php echo $key?>][workshops][<?php echo $workshop['id']?>]"
                                                        value="<?php echo $workshop['id']?>|<?php echo $workshop['name'] ?>|<?php echo $workshop['fee_before_boundary']?>"
                                                        <?php if(isset($participants[$key]['registered_to']['workshops'][$workshop['id']]) AND $is_before_boundary and !is_null($workshop['fee_before_boundary']))
                                                            echo "checked"; ?>
                                                        <?php echo (!$is_before_boundary) ? 'disabled' : ''  ?>
                                                        <?php echo (is_null($workshop['fee_before_boundary'])) ? 'disabled' : ''; ?>
                                                        > <?php 
													if($workshop['fee_before_boundary'] == null){
														echo 'N/A';
													} else {
														echo 'Rp. '. number_format ($workshop['fee_before_boundary'] * 1000);
													}
													?>
                                                </label>
                                            </div>
                                        </td>
                                        
                                    </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                    
                                    <tr>
                                    <td colspan="2" align="center">*Limited for 50 participants</td>
                                    </tr>
                                    </tbody>
                                    
                                </table>
                            </fieldset>

							<?php endif; ?>

                            <?php if(count($satellite_symposium[$key])>0): ?>
                                
                            <fieldset>
                                <legend>Satelite Symposium</legend>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th id="workshop_title">Satelite Symposium Title</th><th id="workshop_fee"><?php echo $event['label_before_boundary'] ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1; ?>

                                    <?php foreach($satellite_symposium[$key] as $keyw => $workshop): // $workshops = list workshop dari db ?>
									<?php
									if(!is_null($workshop['registrant_type_id']) and $val['participant_type'] != $workshop['registrant_type_id']){
										continue;
									}
									?>
                                    <tr class="<?php echo ($i%2 == 0) ? 'odd' : 'even'; ?>">
                                        <td>
                                            <?php echo $workshop['name']?>
                                        </td>
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input
                                                        type="checkbox"
                                                        name="participants[<?php echo $key?>][workshops][]"
                                                        id="participants[<?php echo $key?>][workshops][<?php echo $workshop['id']?>]"
                                                        value="<?php echo $workshop['id']?>|<?php echo $workshop['name'] ?>|<?php echo $workshop['fee_before_boundary']?>"
                                                        <?php if(isset($participants[$key]['registered_to']['workshops'][$workshop['id']]) AND $is_before_boundary and !is_null($workshop['fee_before_boundary']))
                                                            echo "checked"; ?>
                                                        <?php echo (!$is_before_boundary) ? 'disabled' : ''  ?>
                                                        <?php echo (is_null($workshop['fee_before_boundary'])) ? 'disabled' : ''; ?>
                                                        > <?php 
													if($workshop['fee_before_boundary'] == null){
														echo 'N/A';
													} else {
														echo 'Rp. '. number_format ($workshop['fee_before_boundary'] * 1000);
													}
													?>
                                                </label>
                                            </div>
                                        </td>
                                        
                                    </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                    <tr>
                                    <td colspan="2" align="center">
                                    <?php
                                    if($val['participant_type'] == $satellite_symposium[$key][0]['registrant_type_id']){
                                        echo "Symposium will be held in National Cardiovascular Center Harapan Kita";
                                    }
                                    ?></td>
                                    </tr>
                                    </tbody>
                                    </table>
                            </fieldset>
                            
                            <?php endif; ?>

                            <?php if(count($satellite_workshop[$key])>0): ?>
                                
                            <fieldset>
                                <legend>Satelite Workshop</legend>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th id="workshop_title">Satelite Workshop Title</th><th id="workshop_fee"><?php echo $event['label_before_boundary'] ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1; ?>

                                    <?php foreach($satellite_workshop[$key] as $keyw => $workshop): // $workshops = list workshop dari db ?>
                                    <?php
                                    if(!is_null($workshop['registrant_type_id']) and $val['participant_type'] != $workshop['registrant_type_id']){
                                        continue;
                                    }
                                    ?>
                                    <tr class="<?php echo ($i%2 == 0) ? 'odd' : 'even'; ?>">
                                        <td>
                                            <?php echo $workshop['name']?>
                                        </td>
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input
                                                        type="checkbox"
                                                        name="participants[<?php echo $key?>][workshops][]"
                                                        id="participants[<?php echo $key?>][workshops][<?php echo $workshop['id']?>]"
                                                        value="<?php echo $workshop['id']?>|<?php echo $workshop['name'] ?>|<?php echo $workshop['fee_before_boundary']?>"
                                                        <?php if(isset($participants[$key]['registered_to']['workshops'][$workshop['id']]) AND $is_before_boundary and !is_null($workshop['fee_before_boundary']))
                                                            echo "checked"; ?>
                                                        <?php echo (!$is_before_boundary) ? 'disabled' : ''  ?>
                                                        <?php echo (is_null($workshop['fee_before_boundary'])) ? 'disabled' : ''; ?>
                                                        > <?php 
                                                    if($workshop['fee_before_boundary'] == null){
                                                        echo 'N/A';
                                                    } else {
                                                        echo 'Rp. '. number_format ($workshop['fee_before_boundary'] * 1000);
                                                    }
                                                    ?>
                                                </label>
                                            </div>
                                        </td>
                                        
                                    </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                    <tr>
                                    <td colspan="2" align="center"></td>
                                    </tr>
                                    </tbody>
                                    </table>
                            </fieldset>
                            
                            <?php endif; ?>

                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>

            <div class="clearfix"></div>
        </fieldset>

    </form>
</div>


<script>
$(document).ready(function(){
    $(document).off('change', 'input[name$="][not_participate_symposium]"]');
    $(document).on('change', 'input[name$="][not_participate_symposium]"]', function(){
        var id=$(this).attr('name').match(/\[([0-9]+)\]/)[1];
        if($(this).is(":checked"))
        {
            $('#symposium-table-' + id).fadeOut();
        } else {
            $('#symposium-table-' + id).fadeIn();
        }

    });
    $('input[name$="][not_participate_symposium]"]').change();
});
</script>