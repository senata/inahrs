<?php
$country_states = array();
foreach($states as $state) {
    $country_states[$state['country_id']][] = $state['province'];
}
?>

<script>
    var states = <?php echo json_encode($country_states)?>;
</script>

<div class="col-sm-12">
<form id="form1" class="form-horizontal" data-toggle="validator" role="form">
    <input type="hidden" name="form_name" value="contact">
    <fieldset>

        <!-- Form Name -->
        <legend><i class="fa fa-user"></i> Contact Information</legend>

        <p class="note">Fields with <span class="required">*</span> are required.</p>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="fullname">Full Name *</label>
            <div class="col-md-4">
                <input id="fullname" name="fullname" type="text" class="form-control input-md" value="<?php echo @$contact['fullname'] ?>">
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="email">Email Address *</label>
            <div class="col-md-4">
                <input id="email" name="email" value="<?php echo @$contact['email'] ?>" type="email" class="form-control input-md" data-error="Bruh, that email address is invalid">
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="phone">Phone</label>
            <div class="col-md-4">
                <input id="phone" name="phone" value="<?php echo @$contact['phone'] ?>" type="text" class="form-control input-md">
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="fax">Fax</label>
            <div class="col-md-4">
                <input id="fax" name="fax" value="<?php echo @$contact['fax'] ?>" type="text" class="form-control input-md">
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="mobile">Mobile *</label>
            <div class="col-md-4">
                <input id="mobile" name="mobile" value="<?php echo @$contact['mobile'] ?>" type="text" class="form-control input-md">
            </div>
        </div>

    </fieldset>
    <fieldset>

        <!-- Form Name -->
        <legend>Institution / Company</legend>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="company_name">Institution / Company</label>
            <div class="col-md-4">
                <input id="company_name" name="company_name" type="text" class="form-control input-md" value="<?php echo @$contact['company_name'] ?>">
            </div>
        </div>

        <div id="hiddenCompanyForm" style="<?php if(trim($contact['company_name']) == '') echo 'display: none;' ?>">

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="company_address">Address</label>
                <div class="col-md-4">
                    <input id="company_address" name="company_address" type="text" class="form-control input-md" value="<?php echo @$contact['company_address'] ?>">
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="company_country">Country</label>
                <div class="col-md-4">

                    <select class="form-control" id="company_country" name="company_country">
                        <option></option>
                        <?php foreach($countries as $country): ?>
                            <option value="<?php echo $country['alpha2_code']?>" <?php if($country['alpha2_code'] == @$contact['company_country']) echo 'selected' ?>><?php echo $country['name']?></option>
                        <?php endforeach; ?>
                    </select>

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="company_state">State</label>
                <div class="col-md-4">
                    <input id="company_state" name="company_state" type="text" class="form-control input-md" value="<?php echo @$contact['company_state'] ?>">
                </div>
            </div>


            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="company_city">City</label>
                <div class="col-md-4">
                    <input id="company_city" name="company_city" type="text" class="form-control input-md" value="<?php echo @$contact['company_city'] ?>">
                </div>
            </div>

        </div>


    </fieldset>
</form>

</div>

<script>
    $(document).ready(function(){

        $(document).on('keyup change','#company_name', function(){
            if($(this).val() != ''){
                $('#hiddenCompanyForm').show(0,null,function(){
                    $("#wizard").smartWizard('fixHeight');
                });
            } else {
                $('#hiddenCompanyForm').hide(0,null,function(){
                    $("#wizard").smartWizard('fixHeight');
                });
            }
        });

        $(document).on('change','#company_country',function(){
            var countryId = $(this).val();
            if(typeof states[countryId] !== 'undefined' && states[countryId].length){
                // ganti input dengan select
                $('input#company_state').replaceWith('<select id="company_state" class="form-control" name="company_state"></select>');
                var opt ='<option> - Please select state - </option>';
                states[countryId].forEach(function(entry) {
                    //populate states into select options
                    if(entry) opt += '<option value="'+entry+'">'+entry+'</option>';
                });
                $('select#company_state').html(opt);
            } else {
                // kembalikan input
                $('select#company_state').replaceWith('<input class="form-control input-md" type="text" name="company_state" />');
            }
        });

        $(document).on('change','#company_state',function(){
            var countryId = $('#company_country').val();
            var state = $(this).val();
            $('input#company_city').attr('placeholder', 'Loading...');
            $.ajax({
                url: "/country/getCities?countryId=" + countryId + '&state=' + state,
                context: document.body,
                dataType: 'json'
            }).done(function(data) {
                if(data.cities.length > 0){
                    // ganti input dengan select
                    $('input#company_city').replaceWith('<select id="company_city" class="form-control" name="company_city"></select>');
                    var opt ='<option> Please select state</option>';
                    data.cities.forEach(function(entry) {
                        //populate states into select options
                        if(entry) opt += '<option value="'+entry.city+'">'+entry.city+'</option>';
                    });
                    $('select#company_city').html(opt);
                } else {
                    //kembalikan ke input
                    $('select#company_city').replaceWith('<input class="form-control input-md" type="text" name="company_city" />');
                }
            });
        });

    });
</script>

<script>
    // form validation
$(document).ready(function(){
    jQuery.validator.addMethod("phone", function(phone_number, element) {
        phone_number = phone_number.replace(/\s+/g, "");
        return this.optional(element) || phone_number.length > 9 &&
            phone_number.match(/^\d{3,4}[\s\-]*\d{3,4}[\s\-]*\d{3,4}$|^[\+\(]*([\d\-\+]{6,14})$|^[\d\+\(\)]*\s*\d{3,4}[\-\s]*\d{3,4}$/im);
    }, "Please specify a valid phone number");

    $('form#form1').validate({
        rules: {
            fullname: {
                minlength: 3,
                maxlength:60,
                required: true
            },
            email: {
                minlength: 6,
                maxlength: 254,
                required: true
            },
            phone: {
                phone: true,
                minlength:6,
                maxlength:20
            },
            fax: {
                phone: true,
                minlength:6,
                maxlength:20
            },
            mobile: {
                phone: true,
                minlength:6,
                maxlength:20,
                required: true
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });

});
</script>