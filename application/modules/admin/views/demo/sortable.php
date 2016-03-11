<form action="<?php echo current_url(); ?>" method="POST">

	<ul class="sortable list-group">
		<?php for ($i=0; $i<count($entries); $i++): ?>
			<li class="list-group-item">
				<strong><?php echo $entries[$i]; ?></strong>
				<input type="hidden" name="items[]" value="<?php echo $i; ?>" />
			</li>
		<?php endfor; ?>
	</ul>

	<?php echo modules::run('adminlte/widget/btn_submit', 'Save'); ?>

</form>