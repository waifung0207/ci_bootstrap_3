<?php $this->layout('layouts::login') ?>

<div class="login-box">

	<div class="login-logo"><b><?php echo $site_name; ?></b></div>

	<div class="login-box-body">
		<p class="login-box-msg">Sign in to start your session</p>
		<?php echo $form->render_msg(); ?>
		<?php echo $form->render(); ?>
	</div>

</div>