<?php echo $form->open(); ?>

	<?php echo $form->messages(); ?>
	
	<?php echo $form->bs3_email('Email'); ?>
	<?php echo $form->bs3_submit('Submit'); ?>	

<?php echo $form->close(); ?>