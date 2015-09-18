<?php $this->layout('layouts::default') ?>

<?php // append scripts to <head> ?>
<?php $this->start('scripts_head') ?>
	<script src='https://www.google.com/recaptcha/api.js'></script>
<?php $this->stop() ?>

<?php echo $form->open(); ?>
	
	<?php echo $form->messages(); ?>

	<?php echo $form->bs3_text('First Name', 'first_name'); ?>
	<?php echo $form->bs3_text('Last Name', 'last_name'); ?>
	<?php echo $form->bs3_email('Email'); ?>
	<?php echo $form->bs3_password('Password', 'password'); ?>
	<?php echo $form->bs3_password('Retype Password', 'retype_password'); ?>
	<p><?php echo $form->field_recaptcha(); ?></p>

	<div class="form-group">
		Have an Account? <a href="account/login">Log In</a>
	</div>
	
	<?php echo $form->bs3_submit('Sign Up'); ?>

<?php echo $form->close(); ?>