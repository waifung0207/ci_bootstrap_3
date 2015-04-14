
<footer class="main-footer">

	<?php if (ENVIRONMENT=='development'): ?>
		<div class="pull-right hidden-xs">
			CI Version: <strong><?php echo CI_VERSION; ?></strong>, 
			Elapsed Time: <strong>{elapsed_time}</strong> seconds, 
			Memory Usage: <strong>{memory_usage}</strong>
		</div>
	<?php endif; ?>

	<strong>&copy; 2015 <a href="#"><?php //echo COMPANY_NAME; ?></a></strong> All rights reserved.

</footer>