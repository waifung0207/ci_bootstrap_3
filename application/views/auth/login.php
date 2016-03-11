<?php echo $form->open(); ?>

	<?php echo $form->messages(); ?>
	
	<?php echo $form->bs3_email('Email'); ?>
	<?php echo $form->bs3_password('Password'); ?>

	<div class="checkbox">
		<label>
			<input type="checkbox" name="remember"> Remember me
		</label>
	</div>
	<div class="form-group">
		Don't have Account? <a href="auth/sign_up">Sign Up</a>
	</div>
	<div class="form-group">
		<a href="auth/forgot_password">Forgot password?</a>
	</div>
	<?php echo $form->bs3_submit('Login'); ?>

<?php echo $form->close(); ?>