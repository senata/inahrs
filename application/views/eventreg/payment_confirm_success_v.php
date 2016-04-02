<?php $this->load->view('head_m_v'); ?>

<body>

<?php $this->load->view('header_v'); ?>


<div class="container">
    <div class="wrapper">
        <div class="row">

            <?php $this->load->view('eventreg/_sidemenu_v'); ?>

            <div class="col s12 l9">
                <div class="form-subtitle"><span>Payment Confirmation</span></div>
                <div>
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
                        <div class="col s12">
                            <div class="row">
                                <div class="input-field col s12">
                                    Thank you for confirming your payment. <br />
                                    We will proceed by checking your payment status.<br />
                                    You will get an email once your payment has been verified.<br />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('footer_v'); ?>


</body>
</html>
