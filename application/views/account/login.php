<?php $this->layout('layouts::default') ?>

<?php echo $form->open(); ?>

	<?php echo $form->messages(); ?>
	
	<?php echo $form->bs3_email('Email'); ?>
	<?php echo $form->bs3_password('Password'); ?>

	<div class="form-group">
		Don't have Account? <a href="account/sign_up">Sign Up</a>
	</div>
	<div class="form-group">
		<a href="account/forgot_password">Forgot password?</a>
	</div>
	<?php echo $form->bs3_submit('Login'); ?>

<?php echo $form->close(); ?>