<?php
$count = count($passengers);
if($count==0) $passengers[] = array();
?>
<div class="col-sm-12">
    <!--<form class="form-horizontal" data-toggle="validator" role="form">
    <input type="hidden" name="form_name" value="flight">
    -->
    <fieldset>

        <!-- Form Name -->
        <legend><i class="fa fa-location-arrow"></i> Flight Arrangement</legend>

        <!-- Text input-->
        <div class="form-group">
            <center><label class="control-label" for="fullname">Sorry, flight arrangement is not available at this moment.</label></center>
        </div>


		<?php /*

        <!-- Text input-->

        <!-- Multiple Radios (inline) -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="need_flight">Do you need flight arrangement?</label>
            <div class="col-md-4">
                <label class="radio-inline" for="needflight_no">
                    <input type="radio" name="need_flight" id="needflight_no" value=0 <?php echo (@!$need_flight)?'checked':''?>>
                    No
                </label>
                <label class="radio-inline" for="needflight_yes">
                    <input type="radio" name="need_flight" id="needflight_yes" value=1 <?php echo (@$need_flight)?'checked':''?>>
                    Yes
                </label>
            </div>
        </div>


        <div id="flight-form" style="<?php echo (!$need_flight)?'display: none;':''?>">

        <div class="form-group">
            <label class="col-md-4 control-label">
                Passanger count</label>
            <div class="col-md-2">
                <select id="passenger-count" class="form-control" name="passenger_count">
                    <option value="1" <?php echo ($count == 1)?'selected':''?>>1</option>
                    <option value="2" <?php echo ($count == 2)?'selected':''?>>2</option>
                    <option value="3" <?php echo ($count == 3)?'selected':''?>>3</option>
                    <option value="4" <?php echo ($count == 4)?'selected':''?>>4</option>
                    <option value="5" <?php echo ($count == 5)?'selected':''?>>5</option>
                    <option value="6" <?php echo ($count == 6)?'selected':''?>>6</option>
                    <option value="7" <?php echo ($count == 7)?'selected':''?>>7</option>
                    <option value="8" <?php echo ($count == 8)?'selected':''?>>8</option>
                    <option value="9" <?php echo ($count == 9)?'selected':''?>>9</option>
                    <option value="10" <?php echo ($count == 10)?'selected':''?>>10</option>
                </select>
            </div>
        </div>

        <hr />

            <?php foreach($passengers as $key=>$passenger): ?>

        <!-- passenger form -->
        <div id="passenger-form-<?php echo (int) @$key ?>" class="passenger-form">
            <a class="accordion-toggle" data-toggle="collapse" href="#passenger-form-more-<?php echo (int) @$key ?>" aria-expanded="false" aria-controls="passenger-form-more-0">
                <span class="btn btn-danger glyphicon pull-right morepassform glyphicon-plus" data-passenger-id="0"></span>
            </a>

            <div class="form-group">
                <label class="col-md-4 control-label" for="passengers[<?php echo (int) @$key ?>][fullname]">Full Name</label>
                <div class="col-md-4">
                    <input id="passengers[<?php echo (int) @$key ?>][fullname]" name="passengers[<?php echo (int) @$key ?>][fullname]" type="text" class="form-control input-md" value="<?php echo @$passenger['fullname'] ?>">
                </div>
            </div>

            <!-- more area -->
            <div id="passenger-form-more-<?php echo (int) @$key ?>" class="collapse passenger-form-more" aria-expanded="false" style="height: 0px;">

            <div class="form-group">
                <label class="col-md-4 control-label" for="passengers[<?php echo (int) @$key ?>][passport_number]">Passport Number</label>
                <div class="col-md-4">
                    <input id="passengers[<?php echo (int) @$key ?>][passport_number]" name="passengers[<?php echo (int) @$key ?>][passport_number]" type="text" class="form-control input-md" value="<?php echo @$passenger['passport_number'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="passengers[<?php echo (int) @$key ?>][gender]">Do you need flight arrangement?</label>
                <div class="col-md-4">
                    <label class="radio-inline" for="passengers[<?php echo (int) @$key ?>][gender][male]">
                        <input type="radio" id="passengers[<?php echo (int) @$key ?>][gender][male]" name="passengers[<?php echo (int) @$key ?>][gender]" value="male" <?php echo (@$passenger['gender']=='male')?'checked':''?>>
                        Male
                    </label>
                    <label class="radio-inline" for="passengers[<?php echo (int) @$key ?>][gender][female]">
                        <input id="passengers[<?php echo (int) @$key ?>][gender][female]" type="radio" name="passengers[<?php echo (int) @$key ?>][gender]" value="female" <?php echo (@$passenger['gender']=='female')?'checked':''?>>
                        Female
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="passengers[<?php echo (int) @$key ?>][birthdate]">Birth Date</label>
                <div class="col-md-4">
                    <input id="passengers[<?php echo (int) @$key ?>][birthdate]" name="passengers[<?php echo (int) @$key ?>][birthdate]" type="text" class="form-control input-md" value="<?php echo @$passenger['birthdate'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="passengers[<?php echo (int) @$key ?>][passenger_seating]">Seating</label>
                <div class="col-md-2">
                    <select id="passengers[<?php echo (int) @$key ?>][passenger_seating]" class="form-control" name="passengers[<?php echo (int) @$key ?>][passenger_seating]">
                        <option value="random" <?php echo (@$passenger['passenger_seating']=='random')?'selected':''?>> Random </option>
                        <option value="aisle" <?php echo (@$passenger['passenger_seating']=='aisle')?'selected':''?>> Aisle Seater </option>
                        <option value="middle" <?php echo (@$passenger['passenger_seating']=='middle')?'selected':''?>> Middle Seats </option>
                        <option value="window" <?php echo (@$passenger['passenger_seating']=='window')?'selected':''?>> Window Flier </option>
                        <option value="bulkhead" <?php echo (@$passenger['passenger_seating']=='bulkhead')?'selected':''?>> Bulk Head </option>
                        <option value="exitrow" <?php echo (@$passenger['passenger_seating']=='exitrow')?'selected':''?>> Exit Row </option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="passengers[<?php echo (int) @$key ?>][specialmeal]">Special Meal</label>
                <div class="col-md-4">
                    <input id="passengers[<?php echo (int) @$key ?>][specialmeal]" name="passengers[<?php echo (int) @$key ?>][specialmeal]" type="text" class="form-control input-md" value="<?php echo @$passenger['specialmeal'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="passengers[<?php echo (int) @$key ?>][specialrequest]">Special Request</label>
                <div class="col-md-4">
                    <input id="passengers[<?php echo (int) @$key ?>][specialrequest]" name="passengers[<?php echo (int) @$key ?>][specialrequest]" type="text" class="form-control input-md" value="<?php echo @$passenger['specialrequest'] ?>">
                </div>
            </div>

            <h4>Departure Flight</h4>

            <div class="form-group">
                <label class="col-md-4 control-label" for="passengers[<?php echo (int) @$key ?>][departure_date]">Departure Date</label>
                <div class="col-md-4">
                    <input id="passengers[<?php echo (int) @$key ?>][departure_date]" name="passengers[<?php echo (int) @$key ?>][departure_date]" type="text" class="form-control span2" value="<?php echo @$passenger['departure_date'] ?>">
                    <span class="add-on"><i class="icon-calendar"></i></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="passengers[<?php echo (int) @$key ?>][departure_time]">Departure Time</label>
                <div class="col-md-2">
                    <select class="form-control" name="passengers[<?php echo (int) @$key ?>][departure_time]">
                        <option value="morning" <?php echo (@$passenger['departure_time']=='morning')?'selected':''?>>Morning</option>
                        <option value="noon" <?php echo (@$passenger['departure_time']=='noon')?'selected':''?>>Noon</option>
                        <option value="evening" <?php echo (@$passenger['departure_time']=='evening')?'selected':''?>>Evening</option>
                        <option value="night" <?php echo (@$passenger['departure_time']=='night')?'selected':''?>>Night</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="passengers[<?php echo (int) @$key ?>][departure_origin]">Origin</label>
                <div class="col-md-4">
                    <input id="passengers[<?php echo (int) @$key ?>][departure_origin]" name="passengers[<?php echo (int) @$key ?>][departure_origin]" type="text" class="form-control input-md" value="<?php echo @$passenger['departure_origin'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="passengers[<?php echo (int) @$key ?>][departure_destination]">Destination</label>
                <div class="col-md-4">
                    <input id="passengers[<?php echo (int) @$key ?>][departure_destination]" name="passengers[<?php echo (int) @$key ?>][departure_destination]" type="text" class="form-control input-md" value="<?php echo @$passenger['departure_destination'] ?>">
                </div>
            </div>

            <h4>Return Flight</h4>

            <div class="form-group">
                <label class="col-md-4 control-label" for="passengers[<?php echo (int) @$key ?>][return_date]">Return Date</label>
                <div class="col-md-4">
                    <input id="passengers[<?php echo (int) @$key ?>][return_date]" name="passengers[<?php echo (int) @$key ?>][return_date]" type="text" class="form-control input-md" value="<?php echo @$passenger['return_date'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="passengers[<?php echo (int) @$key ?>][return_time]">Return Time</label>
                <div class="col-md-2">
                    <select class="form-control" name="passengers[<?php echo (int) @$key ?>][return_time]">
                        <option value="morning" <?php echo (@$passenger['return_time']=='morning')?'selected':''?>>Morning</option>
                        <option value="noon" <?php echo (@$passenger['return_time']=='noon')?'selected':''?>>Noon</option>
                        <option value="evening" <?php echo (@$passenger['return_time']=='evening')?'selected':''?>>Evening</option>
                        <option value="night" <?php echo (@$passenger['return_time']=='night')?'selected':''?>>Night</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="passengers[<?php echo (int) @$key ?>][return_origin]">Origin</label>
                <div class="col-md-4">
                    <input id="passengers[<?php echo (int) @$key ?>][return_origin]" name="passengers[<?php echo (int) @$key ?>][return_origin]" type="text" class="form-control input-md" value="<?php echo @$passenger['return_origin'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="passengers[<?php echo (int) @$key ?>][return_destination]">Destination</label>
                <div class="col-md-4">
                    <input id="passengers[<?php echo (int) @$key ?>][return_destination]" name="passengers[<?php echo (int) @$key ?>][return_destination]" type="text" class="form-control input-md" value="<?php echo @$passenger['return_destination'] ?>">
                </div>
            </div>

            <h4>Flight Preference</h4>

            <div class="form-group">
                <label class="col-md-4 control-label" for="passengers[<?php echo (int) @$key ?>][flight_class]">Ticket Class</label>
                <div class="col-md-2">
                    <select class="form-control" name="passengers[<?php echo (int) @$key ?>][flight_class]">
                        <option value="economic" <?php echo (@$passenger['flight_class']=='economic')?'selected':''?>>Economic</option>
                        <option value="business" <?php echo (@$passenger['flight_class']=='business')?'selected':''?>>Business</option>
                        <option value="firstclass" <?php echo (@$passenger['flight_class']=='firstclass')?'selected':''?>>First Class</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="passengers[<?php echo (int) @$key ?>][flight_airline1]">Airline 1</label>
                <div class="col-md-4">
                    <select class="form-control" name="passengers[<?php echo (int) @$key ?>][flight_airline1]">
                        <option value=""> -- SELECT -- </option>
                        <?php if(count(@$airlines)):foreach($airlines as $airline):?>
                        <option value="<?php echo $airline['name']?>" <?php echo (@$passenger['flight_airline1']==$airline['name'])?'selected':''?> ><?php echo $airline['name']?></option>
                        <?php endforeach; endif;?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="passengers[<?php echo (int) @$key ?>][flight_airline2]">Airline 2</label>
                <div class="col-md-4">
                    <select class="form-control" name="passengers[<?php echo (int) @$key ?>][flight_airline2]">
                        <option value=""> -- SELECT -- </option>
                        <?php if(count(@$airlines)):foreach($airlines as $airline):?>
                            <option value="<?php echo $airline['name']?>" <?php echo (@$passenger['flight_airline2']==$airline['name'])?'selected':''?>><?php echo $airline['name']?></option>
                        <?php endforeach; endif;?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="passengers[<?php echo (int) @$key ?>][flight_airline3]">Airline 3</label>
                <div class="col-md-4">
                    <select class="form-control" name="passengers[<?php echo (int) @$key ?>][flight_airline3]">
                        <option value=""> -- SELECT --
                            <?php if(count(@$airlines)):foreach($airlines as $airline):?>
                        <option value="<?php echo $airline['name']?>" <?php echo (@$passenger['flight_airline3']==$airline['name'])?'selected':''?>><?php echo $airline['name']?></option>
                        <?php endforeach; endif;?>
                    </select>
                </div>
            </div>

            </div> <!-- / passenger-form-more -->

            <hr />

        </div>




        <!-- / passenger-form -->

        <?php endforeach; ?>


        </div>




        <div class="clearfix"></div>


		<?php */ ?>

    </fieldset>

    <!--</form>-->
</div>


<script>
var prevCountVal;

$(function(){


    $('input[name$="][birthdate]"]').datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:-10",
        dateFormat: 'dd-mm-yy',
    });
    $('input[name$="][departure_date]"]').datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "0:+2",
        dateFormat: 'dd-mm-yy'
    });
    $('input[name$="][return_date]"]').datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "0:+2",
        dateFormat: 'dd-mm-yy'
    });


    $(document).off('click', '.morepassform');

    $(document).on('click', '.morepassform', function(){
        var id = $(this).data('passenger-id');
        //$('#passenger-form-more-' + id).toggle(); // already handle by bootstrap
    });

    $(document).on("shown.bs.collapse", 'div[id^=passenger-form-more]', function(){
        $("#wizard").smartWizard('fixHeight');
    });
    $(document).on("hidden.bs.collapse", 'div[id^=passenger-form-more]', function(){
        $("#wizard").smartWizard('fixHeight');
    });


    // need flight button
    $(document).off('click','input[name=need_flight]');
    $(document).on('click','input[name=need_flight]', function(){
        if($(this).val() == '1'){
            $('#flight-form').show();
        } else {
            $('#flight-form').hide();
        }
    });

    $(document).off('click','select#passenger-count');
    $(document).on('click','select#passenger-count', function(){
        window.prevCountVal = $(this).val();
    })

    $(document).off('change','select#passenger-count');
    $(document).on('change','select#passenger-count', function(){

            // tambah
            var count = $(this).val();
            var current_count = $('.passenger-form').size();

            if(count>current_count){
            var tambah = count - current_count;
            var nextId = current_count;

            for( var i = 0; i < tambah; i++){
                var newElem = $('.passenger-form').first().clone();
                newElem.attr('id','passenger-form-' + nextId);
                newElem.find('input').each(function(){//ganti input names
                    //rename Ids
                    if( $(this).attr("id") ) $(this).attr("id", $(this).attr("id").replace($(this).attr("id").match(/\[[0-9]+\]/), "["+nextId+"]"));
                    //rename names
                    $(this).attr("name", $(this).attr("name").replace($(this).attr("name").match(/\[[0-9]+\]/), "["+nextId+"]"));
                    $(this).prop('checked', false);
                });
                newElem.find('input[type=text]').each(function() {//ganti input names
                    $(this).val('');
                });
                newElem.find('input[type=email]').each(function() {//ganti input names
                    $(this).val('');
                });
                newElem.find('select').each(function() {//ganti select names
                    if( $(this).attr("id") ) $(this).attr("id", $(this).attr("id").replace($(this).attr("id").match(/\[[0-9]+\]/), "["+nextId+"]"));
                    $(this).attr("name", $(this).attr("name").replace($(this).attr("name").match(/\[[0-9]+\]/), "["+nextId+"]"));
                    $(this).val('');
                });
                newElem.find('label').each(function() {//ganti select names
                    if( $(this).attr("for") ) $(this).attr("for", $(this).attr("for").replace($(this).attr("for").match(/\[[0-9]+\]/), "["+nextId+"]"));
                });

                newElem.find('span.morepassform').first().attr('data-passenger-id', nextId);
                newElem.find('span.morepassform').first().parents('a').attr('href','#passenger-form-more-' + nextId);

                newElem.find("div[id^=passenger-form-more-]").first().attr('id', 'passenger-form-more-' + nextId);

                newElem.appendTo('#flight-form');
                nextId++;
            }
        } else if(count<current_count) {
            if(!confirm('Are you sure you want to reduce the number? This will remove some passengers.')){
                $(this).val(window.prevCountVal);
                return false;
            }
            // kurangi
            var kurang = current_count - count;
            var maxId = current_count-1;
            for( var i = 0; i < kurang; i++){
                $('#passenger-form-' + maxId).remove();
                maxId--;
            }
        }

        $("#wizard").smartWizard('fixHeight');
    });

    $(document).on('click',".morepassform", function(e){

        if($(this).parents('.passenger-form').find(".passenger-form-more").is(":visible")){
            $(this).addClass('glyphicon-plus');
            $(this).removeClass('glyphicon-minus');
            //$(this).parents('.passenger-form').find(".passenger-form-more").hide();
        }else{

            $(this).removeClass('glyphicon-plus');
            $(this).addClass('glyphicon-minus');
            //$(this).parents('.passenger-form').find(".passenger-form-more").show();
        }

    })

});

</script>