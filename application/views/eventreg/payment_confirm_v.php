<?php $this->load->view('head_m_v'); ?>
    <link href="/assets/oxygen/css/main.css" rel="stylesheet">
  <link id="css-preset" href="/assets/oxygen/css/presets/preset2.css" rel="stylesheet">
</head>
<body>
<?php $this->load->view('_partials/navbar_topfixed'); ?>


<div class="container">
    <div class="wrapper">
        <div class="row">

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
                        <form class="" id="payment-confirmation" action="<?php echo site_url('eventreg/confirm/submit') ?>" method="post" enctype="multipart/form-data">
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
                            <div class="row">
                                <div class="input-field col s12">
                                    <p>
                                        <input name="transfer_to" value="Bank Mandiri<br>Pokja Electrophysiology & Pacing<br>117.000.631.3845" type="radio" id="test1" checked />
                                        <label for="transfer_to">Bank Mandiri<br>Pokja Electrophysiology & Pacing<br>117.000.631.3845</label>
                                    </p>
                                    <label for="sender_account_name" class="">Transfer To</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="sender_account_name" type="text" class="validate"  name="sender_account_name"  value="<?php echo set_value('sender_account_name'); ?>">
                                    <label for="sender_account_name" class="">Sender Account Name</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="amount" type="number" class="validate"  name="transfer_amount" value="<?php echo set_value('transfer_amount'); ?>">
                                    <label for="amount" class="">Amount Of Transfer</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="transfer_date" type="date" class="datepicker" name="transfer_date" value="<?php echo set_value('transfer_date'); ?>">
                                    <label for="transfer_date" class="">Transfer Date</label>
                                </div>
                            </div>
                            <div class="row upload-transfer">
                                <div class="file-field input-field">
                                    <input class="file-path validate" type="text" />
                                    <div class="btn">
                                        <span>Browse Transfer Scan</span>
                                        <input type="file"  name="transfer_proof" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input type="hidden" name="transfer_proof_tmp" value="" />
                                    <img src="" />
                                </div>
                            </div>
                            <div clas="row">
                                <button class="btn waves-effect waves-light" type="submit" name="action" alt="Confirm Payment">Confirm Payment
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
