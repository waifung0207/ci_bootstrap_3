<?php $this->layout('layouts::login') ?>

<div class="login-box">

	<div class="login-logo"><b><?php echo $site_name; ?></b></div>

	<div class="login-box-body">
		<p class="login-box-msg">Sign in to start your session</p>
		<?php echo $form->open(); ?>
			<?php echo $form->messages(); ?>
			<?php echo $form->bs3_text('Username', 'username', ENVIRONMENT==='development' ? 'admin' : ''); ?>
			<?php echo $form->bs3_password('Password', 'password', ENVIRONMENT==='development' ? 'admin' : ''); ?>
			<?php echo $form->bs3_submit('Sign In'); ?>
		<?php echo $form->close(); ?>
	</div>

</div>