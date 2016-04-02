<?php
$event_id = @$_GET['event_id'];
?>
<header>
  <div style="background: url('/assets/event/images/banner.jpg') no-repeat;height: 250px;box-shadow: 0px 0px 10px 0px #999;">
  	<a href="/index.html"><img src="/assets/event/images/inahrslogo.png" alt="" class="responsive-img"></a>
	<?php if(@$is_logged_in AND @$section == 'iicp') {?>
    <div class="logout">
    	<a href="<?php echo site_url('crashprogram/logout')?>"><i class="mdi-action-account-circle left"></i>LOGOUT</a>
    </div>
	<?php } ?>
  </div>
</header>