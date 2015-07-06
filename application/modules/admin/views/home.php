
<div class="row">

	<div class="col-md-4">

		<?php echo box_open('Welcome!'); ?>
			<p>Demonstration of box_open() and box_close() helper functions.</p>
		<?php echo box_close('Box footer here'); ?>

		<?php echo box_open('Shortcuts'); ?>
			<p>Demonstration of app_btn() helper functions.</p>
			<?php if ($user->role=='admin') echo app_btn('users', 'Admin Users', '#', $count['admin_users']); ?>
			<?php echo app_btn('users', 'Users', 'admin/user', $count['users']); ?>
			<?php echo app_btn('user', 'Account', 'admin/account'); ?>
			<?php echo app_btn('sign-out', 'Logout', 'admin/account/logout'); ?>
		<?php echo box_close(); ?>

	</div>

	<?php if ($user->role=='admin') { ?>
	<div class="col-md-4">
		<?php echo info_box('aqua', $count['admin_users'], 'Admin Users', 'users', '#'); ?>
	</div>
	<?php } ?>

	<div class="col-md-4">
		<?php echo info_box('yellow', $count['users'], 'Users', 'users', 'admin/user'); ?>
	</div>

</div>
