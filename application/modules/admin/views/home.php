<?php $this->layout('layouts::default') ?>

<div class="row">

	<div class="col-md-4">	
		<?php echo box_open('Shortcuts'); ?>
			<?php echo app_btn('user', 'Account', 'account'); ?>
			<?php echo app_btn('sign-out', 'Logout', 'account/logout'); ?>
		<?php echo box_close(); ?>

		<?php echo box_open('Welcome!'); ?>
			<p>Demonstration of functions from adminlte_helper: </p>
			<ul>
				<li>box_open()</li>
				<li>box_close()</li>
				<li>app_btn()</li>
			</ul>
			<?php echo app_btn('github', 'CI Bootstrap', CI_BOOTSTRAP_REPO); ?>
		<?php echo box_close('Box footer here'); ?>
	</div>

	<div class="col-md-4">
		<?php echo info_box('yellow', $count['users'], 'Users', 'users', 'user'); ?>
	</div>

	<div class="col-md-4">
		<?php echo info_box('aqua', $count['admin_users'], 'Admin Users', 'users', 'panel/admin_user'); ?>
	</div>

</div>
