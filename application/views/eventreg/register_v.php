<?php $this->load->view('head_v'); ?>
<!-- page specific head contents -->

<!-- page specific javascript files -->
<script src="/assets/event/js/jquery.smartWizard-3.js"></script>

<script src="/assets/event/js/bootstrap-number-input.js"></script>

<!-- page specific css files -->
<link href="/assets/event/css/smart_wizard.css" rel="stylesheet" type="text/css">
<link href="/assets/event/css/vertical-tabs.css" rel="stylesheet" type="text/css">
<link href="/assets/event/css/eventreg_wizard.css" rel="stylesheet" type="text/css">
  <link href="/assets/oxygen/css/main.css" rel="stylesheet">
  <link id="css-preset" href="/assets/oxygen/css/presets/preset2.css" rel="stylesheet">

<style>
    .swMain {
        min-width: 1164px;
    }
    .swMain .stepContainer div.content {
        min-height: 350px;
        width: 1104px;
    }

    .swMain ul.anchor li a {
        width: 152px;
    }


    .actionBar {
        width:1104px;
    }

    .stepContainer {
        min-height: 220px;
    }
    .stepContainer > div {
        min-height: 200px;
    }


    #summary.form-horizontal .control-label {
        text-align: left;
    }

	legend {
		display:block;
	}
</style>

<script>
    var event_id = '<?php echo $this->input->get('event_id');?>';

    <?php if(!$this->input->get('event_id')) echo 'alert("Invalid event_id");'; ?>
</script>

</head>
<body>

<?php $this->load->view('_partials/navbar_topfixed'); ?> 

<section class="main-body">
    <div class="container-fluid">

    <div class="form-subtitle" style="margin-top:20px;"><span>Event Registration</span></div>
    
<?php if($event['open']): ?>
    <table align="center" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <!-- Smart Wizard -->
                <div id="eventreg-wizard" class="swMain">
                    <ul>
                        <li>
                            <a href="#step-1">
                                <!--<span class="stepNumber">1</span>-->
                            <span class="stepDesc">
                                <span><i class="fa fa-user"></i></span>
                                <span>Step 1</span>
                                <span><small>Contact Information</small></span>
                            </span>
                            </a>
                        </li>
                        <li>
                            <a href="#step-2">
                                <!--<span class="stepNumber">2</span>-->
                            <span class="stepDesc">
                                <span><i class="fa fa-group"></i></span>
                                <span>Step 2</span>
                                <span><small>Participants</small></span>
                            </span>
                            </a>
                        </li>
                        <li>
                            <a href="#step-3">
                                <!--<span class="stepNumber">3</span>-->
                            <span class="stepDesc">
                                <span><i class="fa fa-money"></i></span>
                                <span>Step 3</span>
                                <span><small>Registration Fee</small></span>
                            </span>
                            </a>
                        </li>
                        <li>
                            <a href="#step-4">
                                <!--<span class="stepNumber">4</span>-->
                            <span class="stepDesc">
                                <span><i class="fa fa-building-o"></i></span>
                                <span>Step 4</span>
                                <span><small>Accomodation</small></span>
                        </span>
                            </a>
                        </li>
                        <!-- <li>
                            <a href="#step-5">
                            <span class="stepDesc">
                                <span><i class="fa fa-location-arrow"></i></span>
                                <span>Step 5</span>
                                <span><small>Flight Arrangement</small></span>
                            </span>
                            </a>
                        </li>
                        <li>
                            <a href="#step-6">
                            <span class="stepDesc">
                                <span><i class="fa fa-car"></i></span>
                                <span>Step 6</span>
                                <span><small>Car Arrangement</small></span>
                            </span>
                            </a>
                        </li>-->
                        <li>
                            <a href="#step-5">
                                <!--<span class="stepNumber">7</span>-->
                            <span class="stepDesc">
                                <span><i class="fa fa-list-alt"></i></span>
                                <span>Step 5</span>
                                <span><small>Summary</small></span>
                            </span>
                            </a>
                        </li>
                    </ul>
                    <div id="step-1">
                    </div>
                    <div id="step-2">
                    </div>
                    <div id="step-3">
                    </div>
                    <div id="step-4">
                    </div>
<!--                     <div id="step-5">
                    </div>
                    <div id="step-6">
                    </div> -->
                    <div id="step-5">
                    </div>
                </div>
                <!-- End SmartWizard Content -->

            </td>
        </tr>
    </table>

<?php else: ?>
Sorry the registration has been closed
<?php endif; ?>
   </div>
</section>
<?php $this->load->view('footer_v'); ?>

<script type="text/javascript">
$(document).ready(function(){
    var stepUrl = '/eventreg/ajax/register?event_id=' + event_id;
    // Smart Wizard
    $('#eventreg-wizard').smartWizard({
        autoHeight:true,
        contentURL: stepUrl,
        contentURLData: urlData,
        contentCache:false,
        onLeaveStep: onLeaveStepCallback,
        onShowStep: onShowStepCallback,
        onFinish:onFinishCallback
    });


    function urlData(stepNum)
    {
        // kumpulkan form data
        var formObj = {};
        var inputs = $('form:visible').serializeObject();

        /*
        $.each(inputs, function (i, input) {
            if(input.value != '') formObj[input.name] = input.value;
        });
        */


        var defaultData = {step_number: stepNum};
        var data = jQuery.extend(defaultData, inputs);
        return {
            'url': stepUrl,
            'data':data
        };
    }

    function onLeaveStepCallback(obj)
    {
        var result = null;
        $('form:visible').each(function(){
            if($(this).valid()) {
                result = true;
            }
        });
        if(result || $('form:visible').size() == 0) return true;


		var errors = $('.has-error');
		var body = $("html, body");

		  if (errors.length) {
            // if has tab, open it up first
              var tabId = $(errors[0]).closest('.tab-pane').data('tab-id');
              if(tabId !== 'undefined') {
                  $('li.tab-' + tabId + ' a').tab('show');
              }

			body.animate({scrollTop: errors.offset().top - 100}, '500', 'swing', function() {
			   //alert("Finished animating");
			});
		  }
        return false;
    }

    function onShowStepCallback()
    {
        $("#eventreg-wizard").smartWizard('fixHeight');
        return true;
    }

    function onFinishCallback(){
        bootbox.confirm("You will be redirected to our invoice page in which you can print out.<br />Ready to send this form?", function(result) {
            if(result == true) {
                window.location.href = "<?php echo site_url('eventreg/register/submit?event_id='); ?>" + event_id;
            }
        });
    }


});


setInterval(function(){ $("#eventreg-wizard").smartWizard('fixHeight'); }, 100);
</script>

</body>
</html>

