<div class="container">
	<?php $this->load->view('_partials/navbar'); ?>
	<section class="content">
		<?php $this->load->view('_partials/breadcrumb'); ?>
		<?php $this->load->view($inner_view); ?>
	</section>
</div>

<div class="footer">
	<div class="container">
		<?php if (ENVIRONMENT=='development'): ?>
			<p class="pull-right text-muted">
				CI Bootstrap Version: <strong><?php echo CI_BOOTSTRAP_VERSION; ?></strong>, 
				CI Version: <strong><?php echo CI_VERSION; ?></strong>, 
				Elapsed Time: <strong>{elapsed_time}</strong> seconds, 
				Memory Usage: <strong>{memory_usage}</strong>
			</p>
		<?php endif; ?>
		<p class="text-muted">&copy; <strong><?php echo date('Y'); ?></strong> All rights reserved.</p>
	</div>
</div>