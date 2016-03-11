<?php echo $form->open(); ?>
	
	<?php echo $form->messages(); ?>
	
	<?php echo $form->bs3_password('Password', 'password'); ?>
	<?php echo $form->bs3_password('Retype Password', 'retype_password'); ?>
	<?php echo $form->bs3_submit(); ?>
	
<?php echo $form->close(); ?>