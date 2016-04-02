<?php
$message = $this->session->flashdata('message');
?>


<?php if(isset($message['success'])): ?>
    <div class="alert alert-success">
        <p>
            <?php echo $message['success']; ?>
        </p>
    </div>
<?php endif; ?>
<?php if(isset($message['error'])): ?>
    <div class="alert alert-danger">
        <p>
            <?php echo $message['error']; ?>
        </p>
    </div>
<?php endif; ?>