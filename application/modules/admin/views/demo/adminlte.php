
<?php echo modules::run('adminlte/widget/box_open', 'Welcome!'); ?>
	<p>Demonstration of functions calling from adminlte module.</p>
	<?php echo modules::run('adminlte/widget/app_btn', 'fa fa-github', 'CI Bootstrap', CI_BOOTSTRAP_REPO); ?>
<?php echo modules::run('adminlte/widget/box_close', 'Box footer here'); ?>