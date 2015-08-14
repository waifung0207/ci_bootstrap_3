<?php $this->layout('layouts::base') ?>

<div class="container">
	<?php $this->insert('partials::navbar') ?>
	<section class="content">
		<?php if (!empty($enable_breadcrumb)): ?>
			<?php $this->insert('partials::breadcrumb') ?>
		<?php endif ?>
		<?=$this->section('content')?>
	</section>
</div>

<div class="footer">
	<div class="container">
		<?php if (ENVIRONMENT=='development'): ?>
			<p class="pull-right text-muted">
				CI Version: <strong><?php echo CI_VERSION; ?></strong>, 
				Elapsed Time: <strong>{elapsed_time}</strong> seconds, 
				Memory Usage: <strong>{memory_usage}</strong>
			</p>
		<?php endif; ?>
		<p class="text-muted">&copy; 2015 All rights reserved.</p>
	</div>
</div>