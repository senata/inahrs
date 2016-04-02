<?php $this->load->view('head_m_v'); ?>

<body>

<?php $this->load->view('header_v'); ?>


<div class="container">
    <div class="wrapper">
        <div class="row">

            <!-- <?php $this->load->view('eventreg/_sidemenu_v'); ?> -->

            <div class="col s12 l9">
                <div class="form-subtitle"><span>View Your Invoice</span></div>
                <div>
                    <?php $this->load->view('_notification_v'); ?>
                    <div class="row">
                        <?php if(validation_errors()): ?>
                            <div class="ui-state-error input-field col s12">
                                <?php echo validation_errors(); ?>
                            </div>
                        <?php endif; ?>
                        <?php if(@$error): ?>
                            <div class="ui-state-error input-field col s12">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>

                    </div>
                    <div class="row">
                        <form class="" id="payment-confirmation" action="<?php echo site_url('eventreg/checkinvoice/submit') ?>" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input maxlength="16" length="16"  length="16" id="password" type="text" class="validate" name="transaction_number" value="<?php echo set_value('transaction_number'); ?>">
                                    <label for="password" class="">Transaction Number</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="email" type="email" class="validate" name="email" value="<?php echo set_value('email'); ?>">
                                    <label for="email" class="">Email</label>
                                </div>
                            </div>
                            <div clas="row">
                                <button class="btn waves-effect waves-light" type="submit" name="action" alt="Confirm Payment">View Invoice
                                </button>
                            </div>

                            <div class="progress" style="display: none;">
                                <div class="indeterminate"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('footer_v'); ?>


<script>
    $(document).ready(function(){
        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15 // Creates a dropdown of 15 years to control year
        });
    });
</script>


</body>
</html>
