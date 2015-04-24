<div class="login-box">

	<div class="login-logo"><b>Admin Panel</b></div>

	<div class="login-box-body">
		<p class="login-box-msg">Sign in to start your session</p>
		<?php echo $form->render_validation_error(); ?>
		<?php echo $form->render_custom_error(); ?>
		<?php echo $form->render(); ?>
	</div>

</div>