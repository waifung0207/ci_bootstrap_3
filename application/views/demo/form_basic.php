<?php // render fields & system message using Form Builder library ?>
<?php echo $form->open(); ?>

	<?php echo $form->messages(); ?>

	<table class="table">
		<tr>
			<td><strong>Name: </strong></td>
			<td><?php echo $form->field_text('name'); ?></td>
		</tr>
		<tr>
			<td><strong>Email: </strong></td>
			<td><?php echo $form->field_email('email'); ?></td>
		</tr>
		<tr>
			<td><strong>Subject: </strong></td>
			<td><?php echo $form->field_text('subject'); ?></td>
		</tr>
		<tr>
			<td><strong>Message: </strong></td>
			<td><?php echo $form->field_textarea('message'); ?></td>
		</tr>
		<tr>
			<td><strong>reCAPTCHA: </strong></td>
			<td><?php echo $form->field_recaptcha(); ?></td>
		</tr>
		<tr>
			<td></td>
			<td><?php echo $form->btn_submit(); ?></td>
		</tr>
	</table>

<?php echo $form->close(); ?>
