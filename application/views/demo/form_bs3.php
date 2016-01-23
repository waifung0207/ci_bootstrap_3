<?php // render fields & system message using Form Builder library ?>
<?php echo $form->open(); ?>

	<?php echo $form->messages(); ?>
	<?php echo $form->bs3_text('Name', 'name'); ?>
	<?php echo $form->bs3_Email('Email', 'email'); ?>
	<?php echo $form->bs3_text('Subject', 'subject'); ?>
	<?php echo $form->bs3_textarea('Message', 'message'); ?>
	<p><?php echo $form->field_recaptcha(); ?></p>
	<?php echo $form->bs3_submit(); ?>

<?php echo $form->close(); ?>