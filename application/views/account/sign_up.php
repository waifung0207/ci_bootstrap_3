<?php $this->layout('layouts::default') ?>

<!-- append scripts to <head> -->
<?php $this->start('scripts_head') ?>
	<script src='https://www.google.com/recaptcha/api.js'></script>
<?php $this->stop() ?>

<?php
/*
<?php echo $form->open(); ?>

	<?php echo $form->field_text('first_name'); ?>
	<?php echo $form->field_text('last_name'); ?>
	<?php echo $form->field_email(); ?>
	<?php echo $form->field_password('password'); ?>
	<?php echo $form->field_password('retype_password'); ?>

	<div class="form-group">
		Have an Account? <a href="account/login">Log In</a>
	</div>

	<?php echo $form->btn_submit('Sign Up'); ?>

<?php echo $form->close(); ?>
*/?>

<?php echo $form->open(); ?>
	
	<?php echo $form->messages(); ?>

	<?php echo $form->bs3_text('First Name', 'first_name'); ?>
	<?php echo $form->bs3_text('Last Name', 'last_name'); ?>
	<?php echo $form->bs3_email('Email'); ?>
	<?php echo $form->bs3_password('Password', 'password'); ?>
	<?php echo $form->bs3_password('Retype Password', 'retype_password'); ?>
	<?php //echo $form->field_recaptcha(); ?>

	<div class="form-group">
		Have an Account? <a href="account/login">Log In</a>
	</div>
	
	<?php echo $form->bs3_submit('Sign Up'); ?>

<?php echo $form->close(); ?>